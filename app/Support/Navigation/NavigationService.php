<?php

namespace App\Support\Navigation;

use App\Models\Navigation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class NavigationService
{
    private const CACHE_MARKETING_NAVBAR = 'navigation.marketing.navbar';

    private const CACHE_MARKETING_FOOTER = 'navigation.marketing.footer';

    public function adminSidebar(): array
    {
        return config('admin-sidebar.items', []);
    }

    public function marketingNavbar(): array
    {
        if (! $this->canUseDatabase()) {
            return $this->defaultMarketingNavbar();
        }

        return Cache::rememberForever($this->cacheKey(self::CACHE_MARKETING_NAVBAR), function (): array {
            $items = $this->rootItems(Navigation::LOCATION_NAVBAR);

            if ($items->isEmpty()) {
                return $this->defaultMarketingNavbar();
            }

            return $items
                ->map(fn (Navigation $navigation): array => $this->mapMarketingItem($navigation))
                ->all();
        });
    }

    public function marketingFooter(): array
    {
        if (! $this->canUseDatabase()) {
            return $this->defaultMarketingFooter();
        }

        return Cache::rememberForever($this->cacheKey(self::CACHE_MARKETING_FOOTER), function (): array {
            $items = $this->rootItems(Navigation::LOCATION_FOOTER);

            if ($items->isEmpty()) {
                return $this->defaultMarketingFooter();
            }

            return $items
                ->map(fn (Navigation $navigation): array => $this->mapMarketingItem($navigation))
                ->all();
        });
    }

    public function parentOptions(?Navigation $except = null): array
    {
        return $this->parentNavigations($except)
            ->mapWithKeys(fn (Navigation $item): array => [
                $item->id => sprintf(
                    '%s / %s',
                    Navigation::locationOptions()[$item->location] ?? $item->location,
                    $item->trans('title') ?? '-'
                ),
            ])
            ->all();
    }

    public function parentNavigations(?Navigation $except = null): Collection
    {
        if (! $this->canUseDatabase()) {
            return collect();
        }

        $query = Navigation::query()
            ->where('area', Navigation::AREA_MARKETING)
            ->where('type', Navigation::TYPE_LINK)
            ->ordered();

        if ($except) {
            $query->where('id', '!=', $except->getKey());
        }

        return $query->get();
    }

    public function clearCache(): void
    {
        foreach ($this->supportedLocales() as $locale) {
            try {
                Cache::forget($this->cacheKey(self::CACHE_MARKETING_NAVBAR, $locale));
                Cache::forget($this->cacheKey(self::CACHE_MARKETING_FOOTER, $locale));
            } catch (\Throwable $e) {
                report($e);
            }
        }
    }

    private function canUseDatabase(): bool
    {
        try {
            return Schema::hasTable('navigations');
        } catch (\Throwable) {
            return false;
        }
    }

    private function rootItems(string $location): Collection
    {
        return Navigation::query()
            ->where('area', Navigation::AREA_MARKETING)
            ->where('location', $location)
            ->whereNull('parent_id')
            ->active()
            ->ordered()
            ->with([
                'childrenRecursive' => fn ($query) => $query->active()->ordered(),
            ])
            ->get();
    }

    private function mapMarketingItem(Navigation $navigation): array
    {
        $children = $navigation->childrenRecursive
            ->filter(fn (Navigation $child): bool => $child->type === Navigation::TYPE_LINK)
            ->map(fn (Navigation $child): array => $this->mapMarketingItem($child))
            ->values();

        return [
            'title' => $navigation->trans('title') ?? '-',
            'url' => $navigation->resolvedUrl(),
            'target' => $navigation->open_in_new_tab ? '_blank' : '_self',
            'children' => $children->all(),
        ];
    }

    private function defaultMarketingNavbar(): array
    {
        return $this->mapMarketingConfigItems(config('navigator.marketing.navbar', []));
    }

    private function defaultMarketingFooter(): array
    {
        return $this->mapMarketingConfigItems(config('navigator.marketing.footer', []));
    }

    private function mapMarketingConfigItems(array $items): array
    {
        return collect($items)
            ->map(function (array $item): array {
                return [
                    'title' => $this->localizedTitle($item),
                    'url' => $this->resolveConfigUrl($item),
                    'target' => $item['target'] ?? '_self',
                    'children' => $this->mapMarketingConfigItems($item['children'] ?? []),
                ];
            })
            ->all();
    }

    private function resolveConfigUrl(array $item): string
    {
        return Navigation::normalizeUrl($item['url'] ?? null);
    }

    private function localizedTitle(array $item): string
    {
        $locale = app()->getLocale();
        $localized = $item["title_{$locale}"] ?? null;

        if (filled($localized)) {
            return $localized;
        }

        return $item['title_id'] ?? $item['title_en'] ?? $item['title'] ?? '-';
    }

    private function cacheKey(string $base, ?string $locale = null): string
    {
        return $base.'.'.($locale ?: app()->getLocale()).'.v6';
    }

    private function supportedLocales(): array
    {
        return collect(['id', 'en', 'ar', config('app.locale'), app()->getLocale()])
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
