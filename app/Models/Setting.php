<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Setting extends BaseUuidModel
{
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
    ];

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

    public function formValue(): ?string
    {
        if ($this->type === self::TYPE_LIST) {
            return implode(PHP_EOL, $this->listItems());
        }

        return $this->value;
    }

    public function listItems(): array
    {
        if (blank($this->value)) {
            return [];
        }

        $decoded = json_decode($this->value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return collect($decoded)
                ->map(fn ($item) => trim((string) $item))
                ->filter()
                ->values()
                ->all();
        }

        return collect(preg_split('/\r\n|\r|\n/', (string) $this->value))
            ->map(fn ($item) => trim((string) $item))
            ->filter()
            ->values()
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
