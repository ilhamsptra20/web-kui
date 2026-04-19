<?php

namespace App\Models;

use App\Support\Navigation\NavigationService;
use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;

class Navigation extends BaseUuidModel
{
    use HasTranslation;

    public const AREA_ADMIN = 'admin';

    public const AREA_MARKETING = 'marketing';

    public const LOCATION_SIDEBAR = 'sidebar';

    public const LOCATION_NAVBAR = 'navbar';

    public const LOCATION_FOOTER = 'footer';

    public const TYPE_HEADER = 'header';

    public const TYPE_LINK = 'link';

    protected $fillable = [
        'parent_id',
        'area',
        'location',
        'type',
        'module_key',
        'title_id',
        'title_en',
        'title_ar',
        'url',
        'route_name',
        'icon',
        'badge_text',
        'badge_class',
        'sort_order',
        'is_active',
        'open_in_new_tab',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'open_in_new_tab' => 'boolean',
    ];

    protected static function booted(): void
    {
        $clear = static function (): void {
            app(NavigationService::class)->clearCache();
        };

        static::saved($clear);
        static::deleted($clear);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title_id');
    }

    public static function areaOptions(): array
    {
        return [
            self::AREA_MARKETING => 'Marketing',
        ];
    }

    public static function locationOptions(): array
    {
        return [
            self::LOCATION_NAVBAR => 'Navbar',
            self::LOCATION_FOOTER => 'Footer',
        ];
    }

    public static function typeOptions(): array
    {
        return [
            self::TYPE_LINK => 'Link',
        ];
    }

    public function resolvedUrl(): string
    {
        if ($this->route_name && Route::has($this->route_name)) {
            try {
                return route($this->route_name, [], false);
            } catch (\Throwable) {
                //
            }
        }

        return self::normalizeUrl($this->url);
    }

    public static function normalizeUrl(?string $url): string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return '#';
        }

        if (
            $url === '#'
            || str_starts_with($url, '#')
            || str_starts_with($url, '/')
            || str_starts_with($url, 'http://')
            || str_starts_with($url, 'https://')
            || str_starts_with($url, 'mailto:')
            || str_starts_with($url, 'tel:')
        ) {
            return $url;
        }

        return '/'.ltrim($url, '/');
    }
}
