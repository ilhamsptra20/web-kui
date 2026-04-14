<?php

namespace App\Models;

use App\Support\Navigation\NavigationService;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslation;

class Page extends BaseUuidModel
{
    use HasSlug, HasTranslation;

    public const TYPE_TEXT = 'text';

    public const TYPE_FILE = 'file';

    protected $fillable = [
        'user_id',
        'title_id',
        'title_en',
        'title_ar',
        'slug',
        'type',
        'content_id',
        'content_en',
        'content_ar',
        'file_path',
        'file_name',
        'file_mime',
        'file_size',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'file_size' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        $clearNavigationCache = static function (): void {
            app(NavigationService::class)->clearCache();
        };

        static::saved($clearNavigationCache);
        static::deleted($clearNavigationCache);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', true)
            ->whereNotNull('slug');
    }

    public function isText(): bool
    {
        return ($this->type ?: self::TYPE_TEXT) === self::TYPE_TEXT;
    }

    public function isFile(): bool
    {
        return $this->type === self::TYPE_FILE;
    }

    public function hasFile(): bool
    {
        return filled($this->file_path);
    }

    public function fileUrl(): ?string
    {
        if (! $this->hasFile()) {
            return null;
        }

        $path = ltrim((string) $this->file_path, '/');

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        if (str_starts_with($path, 'storage/')) {
            return '/'.$path;
        }

        return '/storage/'.$path;
    }

    public function fileDisplayName(): string
    {
        return $this->file_name ?: basename((string) $this->file_path) ?: 'File halaman';
    }

    public function fileExtension(): string
    {
        return strtolower(pathinfo((string) $this->file_path, PATHINFO_EXTENSION));
    }

    public function isImageFile(): bool
    {
        return str_starts_with((string) $this->file_mime, 'image/')
            || in_array($this->fileExtension(), ['jpg', 'jpeg', 'png', 'webp'], true);
    }

    public function isPdfFile(): bool
    {
        return $this->file_mime === 'application/pdf'
            || $this->fileExtension() === 'pdf';
    }

    public function readableFileSize(): ?string
    {
        if (! $this->file_size) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = (float) $this->file_size;
        $unitIndex = 0;

        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }

        return number_format($size, $unitIndex === 0 ? 0 : 1).' '.$units[$unitIndex];
    }

    public function fileIcon(): string
    {
        if ($this->isPdfFile()) {
            return 'ri-file-pdf-line';
        }

        if ($this->isImageFile()) {
            return 'ri-image-line';
        }

        return 'ri-attachment-2';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_id')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
