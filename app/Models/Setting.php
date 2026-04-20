<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Setting extends BaseUuidModel
{
    public const LOCALE_ID = 'id';

    public const LOCALE_EN = 'en';

    public const LOCALE_AR = 'ar';

    public const TYPE_TEXT = 'text';

    public const TYPE_LONGTEXT = 'longtext';

    public const TYPE_IMAGE = 'image';

    public const TYPE_LIST = 'list';

    protected $fillable = [
        'group',
        'label',
        'key',
        'type',
        'value',
        'value_id',
        'value_en',
        'value_ar',
    ];

    public static function localeOptions(): array
    {
        return [
            self::LOCALE_ID => 'Indonesia',
            self::LOCALE_EN => 'English',
            self::LOCALE_AR => 'Arabic',
        ];
    }

    public static function typeOptions(): array
    {
        return [
            self::TYPE_TEXT => 'Text',
            self::TYPE_LONGTEXT => 'Long Text',
            self::TYPE_IMAGE => 'Image',
            self::TYPE_LIST => 'List',
        ];
    }

    public static function typeValues(): array
    {
        return array_keys(self::typeOptions());
    }

    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    public function formValue(?string $locale = null): ?string
    {
        if ($this->type === self::TYPE_LIST) {
            return implode(PHP_EOL, $this->listItems($locale));
        }

        return $this->localizedValue($locale);
    }

    public function listItems(?string $locale = null): array
    {
        $value = $this->localizedValue($locale);

        if (blank($value)) {
            return [];
        }

        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return collect($decoded)
                ->map(fn ($item) => trim((string) $item))
                ->filter()
                ->values()
                ->all();
        }

        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }

    public function localizedValue(?string $locale = null): ?string
    {
        if ($this->type === self::TYPE_IMAGE) {
            return $this->value;
        }

        $locale = $locale ?: app()->getLocale();
        $column = 'value_'.$locale;

        if (array_key_exists($column, $this->attributes) && filled($this->attributes[$column])) {
            return $this->attributes[$column];
        }

        if (array_key_exists('value_id', $this->attributes) && filled($this->attributes['value_id'])) {
            return $this->attributes['value_id'];
        }

        return $this->value;
    }

    public function translatedValues(): array
    {
        return collect(self::localeOptions())
            ->mapWithKeys(fn (string $label, string $locale): array => [$locale => $this->formValue($locale)])
            ->all();
    }

    public function imageUrl(): ?string
    {
        return self::resolveImageUrl($this->value);
    }

    public static function resolveImageUrl(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//', 'data:', '/'])) {
            return $value;
        }

        $storageUrl = Storage::disk('public')->url(ltrim($value, '/'));

        return parse_url($storageUrl, PHP_URL_PATH) ?: $storageUrl;
    }
}
