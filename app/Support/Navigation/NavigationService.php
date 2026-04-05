<?php

namespace App\Support\Navigation;

use App\Models\Navigation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class NavigationService
{
    private const CACHE_ADMIN_SIDEBAR = 'navigation.admin.sidebar';

    private const CACHE_MARKETING_NAVBAR = 'navigation.marketing.navbar';

    private const CACHE_MARKETING_FOOTER = 'navigation.marketing.footer';

    public function adminSidebar(): array
    {
        if (! $this->canUseDatabase()) {
            return config('navigator.sidebar', []);
        }

        $items = $this->rootItems(Navigation::AREA_ADMIN, Navigation::LOCATION_SIDEBAR);

        if ($items->isEmpty()) {
            return config('navigator.sidebar', []);
        }

        return Cache::rememberForever(self::CACHE_ADMIN_SIDEBAR, fn (): array => $items
            ->map(fn (Navigation $navigation): array => $this->mapAdminItem($navigation))
            ->all());
    }

    public function marketingNavbar(): array
    {
        if (! $this->canUseDatabase()) {
            return $this->defaultMarketingNavbar();
        }

        $items = $this->rootItems(Navigation::AREA_MARKETING, Navigation::LOCATION_NAVBAR);

        if ($items->isEmpty()) {
            return $this->defaultMarketingNavbar();
        }

        return Cache::rememberForever(self::CACHE_MARKETING_NAVBAR, fn (): array => $items
            ->map(fn (Navigation $navigation): array => $this->mapMarketingItem($navigation))
            ->all());
    }

    public function marketingFooter(): array
    {
        if (! $this->canUseDatabase()) {
            return $this->defaultMarketingFooter();
        }

        $items = $this->rootItems(Navigation::AREA_MARKETING, Navigation::LOCATION_FOOTER);

        if ($items->isEmpty()) {
            return $this->defaultMarketingFooter();
        }

        return Cache::rememberForever(self::CACHE_MARKETING_FOOTER, fn (): array => $items
            ->map(fn (Navigation $navigation): array => $this->mapMarketingItem($navigation))
            ->all());
    }

    public function parentOptions(?Navigation $except = null): array
    {
        if (! $this->canUseDatabase()) {
            return [];
        }

        $query = Navigation::query()
            ->whereNull('parent_id')
            ->ordered();

        if ($except) {
            $query->where('id', '!=', $except->getKey());
        }

        return $query
            ->get()
            ->mapWithKeys(fn (Navigation $item): array => [
                $item->id => sprintf(
                    '%s / %s / %s',
                    Navigation::areaOptions()[$item->area] ?? $item->area,
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
            ->ordered();

        if ($except) {
            $query->where('id', '!=', $except->getKey());
        }

        return $query->get();
    }

    public function clearCache(): void
    {
        Cache::forget(self::CACHE_ADMIN_SIDEBAR);
        Cache::forget(self::CACHE_MARKETING_NAVBAR);
        Cache::forget(self::CACHE_MARKETING_FOOTER);
    }

    private function canUseDatabase(): bool
    {
        try {
            return Schema::hasTable('navigations');
        } catch (\Throwable) {
            return false;
        }
    }

    private function rootItems(string $area, string $location)
    {
        return Navigation::query()
            ->where('area', $area)
            ->where('location', $location)
            ->whereNull('parent_id')
            ->active()
            ->ordered()
            ->with([
                'childrenRecursive' => fn ($query) => $query->active()->ordered(),
            ])
            ->get();
    }

    private function mapAdminItem(Navigation $navigation): array
    {
        if ($navigation->type === Navigation::TYPE_HEADER) {
            return [
                'header' => $navigation->trans('title') ?? '-',
            ];
        }

        $item = [
            'title' => $navigation->trans('title') ?? '-',
            'icon' => $navigation->icon ?: 'feather icon-circle',
            'url' => $navigation->resolvedUrl(),
            'target' => $navigation->open_in_new_tab ? '_blank' : '_self',
            'submenu' => $navigation->childrenRecursive
                ->reject(fn (Navigation $child): bool => $child->type === Navigation::TYPE_HEADER)
                ->map(fn (Navigation $child): array => $this->mapAdminLink($child))
                ->values()
                ->all(),
        ];

        if ($navigation->badge_text) {
            $item['badge'] = [
                'class' => $navigation->badge_class ?: 'badge-primary',
                'text' => $navigation->badge_text,
            ];
        }

        return $item;
    }

    private function mapAdminLink(Navigation $navigation): array
    {
        $item = [
            'title' => $navigation->trans('title') ?? '-',
            'icon' => $navigation->icon ?: 'feather icon-circle',
            'url' => $navigation->resolvedUrl(),
            'target' => $navigation->open_in_new_tab ? '_blank' : '_self',
            'submenu' => $navigation->childrenRecursive
                ->reject(fn (Navigation $child): bool => $child->type === Navigation::TYPE_HEADER)
                ->map(fn (Navigation $child): array => $this->mapAdminLink($child))
                ->values()
                ->all(),
        ];

        if ($navigation->badge_text) {
            $item['badge'] = [
                'class' => $navigation->badge_class ?: 'badge-primary',
                'text' => $navigation->badge_text,
            ];
        }

        return $item;
    }

    private function mapMarketingItem(Navigation $navigation): array
    {
        return [
            'title' => $navigation->trans('title') ?? '-',
            'url' => $navigation->resolvedUrl(),
            'route_name' => $navigation->route_name,
            'target' => $navigation->open_in_new_tab ? '_blank' : '_self',
            'children' => $navigation->childrenRecursive
                ->filter(fn (Navigation $child): bool => $child->type === Navigation::TYPE_LINK)
                ->map(fn (Navigation $child): array => $this->mapMarketingItem($child))
                ->values()
                ->all(),
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
        $locale = app()->getLocale();

        return collect($items)
            ->map(function (array $item) use ($locale): array {
                $title = $item["title_{$locale}"] ?? $item['title'] ?? $item['title_id'] ?? '-';

                return [
                    'title' => $title,
                    'url' => $item['url'] ?? '#',
                    'route_name' => $item['route_name'] ?? null,
                    'target' => $item['target'] ?? '_self',
                    'children' => $this->mapMarketingConfigItems($item['children'] ?? []),
                ];
            })
            ->all();
    }
}
