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
    private const CACHE_KEY_PREFIX = 'settings.resolved.map.';

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
        $supportsLocalizedValues = $this->supportsLocalizedValues();

        foreach (array_values($items) as $item) {
            $setting = isset($item['id']) ? $existingSettings->get($item['id']) : null;
            $setting ??= new Setting();

            $previousType = $setting->type;
            $previousValue = $setting->value;

            $type = $item['type'] ?? Setting::TYPE_TEXT;
            $payload = [
                'group' => $normalizedGroup,
                'label' => trim((string) ($item['label'] ?? '')),
                'key' => $this->resolveKey($item, $setting, $usedKeys),
                'type' => $type,
                'value' => $this->resolveValue($normalizedGroup, $item, $setting),
            ];

            if ($supportsLocalizedValues) {
                $payload = array_merge($payload, $this->resolveLocalizedValues($item, $setting, $type));
            }

            $setting->fill($payload);
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
            'translations' => $setting->translatedValues(),
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
        Cache::forget('settings.resolved.map');

        foreach ($this->supportedLocales() as $locale) {
            Cache::forget($this->cacheKey($locale));
        }
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

        $rawValue = $item['value_id'] ?? $item['value'] ?? null;

        if ($type === Setting::TYPE_LIST) {
            return $this->serializeListValue($rawValue);
        }

        if ($type === Setting::TYPE_TEXT) {
            return filled($rawValue) ? trim((string) $rawValue) : null;
        }

        return filled($rawValue) ? (string) $rawValue : null;
    }

    private function resolveLocalizedValues(array $item, ?Setting $setting, string $type): array
    {
        if ($type === Setting::TYPE_IMAGE) {
            return [
                'value_id' => null,
                'value_en' => null,
                'value_ar' => null,
            ];
        }

        return [
            'value_id' => $this->normalizeLocalizedValue($item['value_id'] ?? $setting?->value_id ?? $setting?->value, $type),
            'value_en' => $this->normalizeLocalizedValue($item['value_en'] ?? $setting?->value_en, $type),
            'value_ar' => $this->normalizeLocalizedValue($item['value_ar'] ?? $setting?->value_ar, $type),
        ];
    }

    private function normalizeLocalizedValue(mixed $value, string $type): ?string
    {
        if ($type === Setting::TYPE_LIST) {
            return $this->serializeListValue($value);
        }

        if ($type === Setting::TYPE_TEXT) {
            return filled($value) ? trim((string) $value) : null;
        }

        return filled($value) ? (string) $value : null;
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

        return Cache::rememberForever($this->cacheKey(app()->getLocale()), function (): array {
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
            Setting::TYPE_LIST => $setting->listItems(app()->getLocale()),
            default => $setting->localizedValue(app()->getLocale()),
        };
    }

    private function supportsLocalizedValues(): bool
    {
        return Schema::hasTable('settings')
            && Schema::hasColumns('settings', ['value_id', 'value_en', 'value_ar']);
    }

    private function cacheKey(string $locale): string
    {
        return self::CACHE_KEY_PREFIX.$locale;
    }

    private function supportedLocales(): array
    {
        return collect(array_keys(Setting::localeOptions()))
            ->push(config('app.locale'))
            ->push(app()->getLocale())
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
