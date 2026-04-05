<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingService
{
    private const CACHE_KEY = 'settings.resolved.map';

    public function syncGroup(string $group, array $items): Collection
    {
        $normalizedGroup = $this->normalizeGroup($group);
        $existingSettings = Setting::query()
            ->whereIn('id', collect($items)->pluck('id')->filter()->all())
            ->get()
            ->keyBy('id');
        $usedKeys = Setting::query()
            ->when($existingSettings->isNotEmpty(), fn ($query) => $query->whereNotIn('id', $existingSettings->keys()->all()))
            ->pluck('key')
            ->filter()
            ->values()
            ->all();

        $savedSettings = collect();

        foreach (array_values($items) as $item) {
            $setting = isset($item['id']) ? $existingSettings->get($item['id']) : null;
            $setting ??= new Setting();

            $previousType = $setting->type;
            $previousValue = $setting->value;

            $setting->fill([
                'group' => $normalizedGroup,
                'label' => trim((string) ($item['label'] ?? '')),
                'key' => $this->resolveKey($item, $setting, $usedKeys),
                'type' => $item['type'] ?? Setting::TYPE_TEXT,
                'value' => $this->resolveValue($normalizedGroup, $item, $setting),
            ]);
            $setting->save();

            if ($previousType === Setting::TYPE_IMAGE && $setting->type !== Setting::TYPE_IMAGE) {
                $this->deleteStoredImage($previousValue);
            }

            $savedSettings->push($setting);
        }

        $this->clearCache();

        return $savedSettings;
    }

    public function delete(Setting $setting): void
    {
        if ($setting->type === Setting::TYPE_IMAGE) {
            $this->deleteStoredImage($setting->value);
        }

        $setting->delete();

        $this->clearCache();
    }

    public function mapForEditor(Setting $setting): array
    {
        return [
            'id' => $setting->id,
            'label' => $setting->label,
            'key' => $setting->key,
            'type' => $setting->type,
            'value' => $setting->formValue(),
            'existing_value' => $setting->type === Setting::TYPE_IMAGE ? $setting->value : null,
            'image_url' => $setting->type === Setting::TYPE_IMAGE ? $setting->imageUrl() : null,
        ];
    }

    public function normalizeGroup(string $group): string
    {
        return trim($group) !== '' ? trim($group) : 'General';
    }

    public function isReady(): bool
    {
        return Schema::hasTable('settings')
            && Schema::hasColumns('settings', ['key', 'type', 'value']);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->resolvedSettings()[$key] ?? $default;
    }

    public function only(array $defaults): array
    {
        $resolvedSettings = $this->resolvedSettings();

        return collect($defaults)
            ->mapWithKeys(fn (mixed $default, string $key) => [$key => $resolvedSettings[$key] ?? $default])
            ->all();
    }

    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    private function resolveValue(string $group, array $item, ?Setting $setting = null): ?string
    {
        $type = $item['type'] ?? Setting::TYPE_TEXT;

        if ($type === Setting::TYPE_IMAGE) {
            $uploadedFile = $item['image'] ?? null;

            if ($uploadedFile instanceof UploadedFile) {
                $path = $uploadedFile->store('settings/' . Str::slug($group), 'public');

                if ($setting?->type === Setting::TYPE_IMAGE) {
                    $this->deleteStoredImage($setting->value);
                }

                return $path;
            }

            return $item['existing_value'] ?? $setting?->value;
        }

        if ($setting?->type === Setting::TYPE_IMAGE) {
            $this->deleteStoredImage($setting->value);
        }

        $rawValue = $item['value'] ?? null;

        if ($type === Setting::TYPE_LIST) {
            return $this->serializeListValue($rawValue);
        }

        if ($type === Setting::TYPE_TEXT) {
            return filled($rawValue) ? trim((string) $rawValue) : null;
        }

        return filled($rawValue) ? (string) $rawValue : null;
    }

    private function serializeListValue(mixed $rawValue): ?string
    {
        $items = collect(preg_split('/\r\n|\r|\n/', (string) $rawValue))
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();

        if ($items === []) {
            return null;
        }

        return json_encode($items, JSON_UNESCAPED_UNICODE);
    }

    private function deleteStoredImage(?string $path): void
    {
        if (blank($path) || Str::startsWith($path, ['http://', 'https://', '//', 'data:'])) {
            return;
        }

        Storage::disk('public')->delete(ltrim($path, '/'));
    }

    private function resolveKey(array $item, Setting $setting, array &$usedKeys): string
    {
        if ($setting->exists && filled($setting->key)) {
            $usedKeys[] = $setting->key;

            return $setting->key;
        }

        $baseKey = Str::limit((string) ($item['generated_key'] ?? ''), 100, '');

        if ($baseKey === '') {
            $baseKey = 'setting';
        }

        $key = $baseKey;
        $suffix = 2;

        while (in_array($key, $usedKeys, true)) {
            $key = Str::limit($baseKey, 96, '') . '_' . $suffix;
            $suffix++;
        }

        $usedKeys[] = $key;

        return $key;
    }

    private function resolvedSettings(): array
    {
        if (! $this->isReady()) {
            return [];
        }

        return Cache::rememberForever(self::CACHE_KEY, function (): array {
            return Setting::query()
                ->orderBy('group')
                ->orderBy('label')
                ->get()
                ->mapWithKeys(function (Setting $setting): array {
                    return [$setting->key => $this->resolveSettingOutput($setting)];
                })
                ->all();
        });
    }

    private function resolveSettingOutput(Setting $setting): mixed
    {
        return match ($setting->type) {
            Setting::TYPE_IMAGE => $setting->imageUrl(),
            Setting::TYPE_LIST => $setting->listItems(),
            default => $setting->value,
        };
    }
}
