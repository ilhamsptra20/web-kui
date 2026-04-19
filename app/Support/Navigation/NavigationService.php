<?php

namespace App\Support\Navigation;

use App\Models\Navigation;
use App\Models\Agenda;
use App\Models\Album;
use App\Models\Announcement;
use App\Models\Page;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
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

        if ($navigation->module_key) {
            $children = $children
                ->concat($this->moduleItems($navigation->module_key))
                ->unique(fn (array $child): string => $child['url'] ?? '#')
                ->values();
        }

        return [
            'title' => $navigation->trans('title') ?? '-',
            'url' => $navigation->resolvedUrl(),
            'route_name' => $navigation->route_name,
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
                $children = collect($this->mapMarketingConfigItems($item['children'] ?? []));
                $moduleKey = $item['module_key'] ?? null;

                if ($moduleKey) {
                    $children = $children
                        ->concat($this->moduleItems($moduleKey))
                        ->unique(fn (array $child): string => $child['url'] ?? '#')
                        ->values();
                }

                return [
                    'title' => $this->localizedTitle($item),
                    'url' => $this->resolveConfigUrl($item),
                    'route_name' => $item['route_name'] ?? null,
                    'module_key' => $moduleKey,
                    'target' => $item['target'] ?? '_self',
                    'children' => $children->all(),
                ];
            })
            ->all();
    }

    private function moduleItems(string $moduleKey): array
    {
        return match ($moduleKey) {
            'pages' => $this->pageItems(),
            'posts' => $this->postItems(),
            'albums_galleries' => $this->albumItems(),
            'agendas' => $this->agendaItems(),
            'announcements' => $this->announcementItems(),
            'teams' => $this->teamItems(),
            default => [],
        };
    }

    private function pageItems(): array
    {
        try {
            if (! Schema::hasTable('pages')) {
                return [];
            }

            return Page::query()
                ->published()
                ->orderBy('title_id')
                ->get()
                ->map(fn (Page $page): array => [
                    'title' => $page->trans('title') ?: $page->title_id ?: 'Halaman KUI',
                    'url' => route('pages.show-marketing', $page, false),
                    'route_name' => null,
                    'target' => $page->isPdfFile() ? '_blank' : '_self',
                    'children' => [],
                ])
                ->all();
        } catch (\Throwable) {
            return [];
        }
    }

    private function postItems(): array
    {
        try {
            if (! Schema::hasTable('posts')) {
                return [];
            }

            return Post::query()
                ->where('status', 'published')
                ->whereNotNull('slug')
                ->latest()
                ->get()
                ->map(fn (Post $post): array => [
                    'title' => $post->trans('title') ?: $post->title_id ?: 'Artikel',
                    'url' => route('article.show-marketing', $post->slug, false),
                    'route_name' => null,
                    'target' => '_self',
                    'children' => [],
                ])
                ->all();
        } catch (\Throwable) {
            return [];
        }
    }

    private function albumItems(): array
    {
        try {
            if (! Schema::hasTable('albums')) {
                return [];
            }

            return Album::query()
                ->whereNotNull('slug')
                ->latest()
                ->get()
                ->map(fn (Album $album): array => [
                    'title' => $album->trans('name') ?: $album->name_id ?: 'Album',
                    'url' => route('gallery.show-marketing', $album->slug, false),
                    'route_name' => null,
                    'target' => '_self',
                    'children' => [],
                ])
                ->all();
        } catch (\Throwable) {
            return [];
        }
    }

    private function agendaItems(): array
    {
        try {
            if (! Schema::hasTable('agendas')) {
                return [];
            }

            return Agenda::query()
                ->whereNotNull('slug')
                ->orderBy('start_date')
                ->get()
                ->map(fn (Agenda $agenda): array => [
                    'title' => $agenda->trans('name') ?: $agenda->name_id ?: 'Agenda',
                    'url' => route('event.show-marketing', $agenda->slug, false),
                    'route_name' => null,
                    'target' => '_self',
                    'children' => [],
                ])
                ->all();
        } catch (\Throwable) {
            return [];
        }
    }

    private function announcementItems(): array
    {
        try {
            if (! Schema::hasTable('announcements')) {
                return [];
            }

            return Announcement::query()
                ->active()
                ->latest()
                ->get()
                ->map(fn (Announcement $announcement): array => [
                    'title' => $announcement->trans('title') ?: $announcement->title_id ?: 'Pengumuman',
                    'url' => route('announcements.marketing.show', $announcement->id, false),
                    'route_name' => null,
                    'target' => '_self',
                    'children' => [],
                ])
                ->all();
        } catch (\Throwable) {
            return [];
        }
    }

    private function teamItems(): array
    {
        try {
            if (! Schema::hasTable('teams')) {
                return [];
            }

            return Team::query()
                ->whereNotNull('slug')
                ->orderBy('name')
                ->get()
                ->map(fn (Team $team): array => [
                    'title' => $team->name ?: 'Team',
                    'url' => route('team.show-marketing', $team->slug, false),
                    'route_name' => null,
                    'target' => '_self',
                    'children' => [],
                ])
                ->all();
        } catch (\Throwable) {
            return [];
        }
    }

    private function resolveConfigUrl(array $item): string
    {
        $routeName = $item['route_name'] ?? null;

        if ($routeName && Route::has($routeName)) {
            try {
                return route($routeName, [], false);
            } catch (\Throwable) {
                //
            }
        }

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
        return $base.'.'.($locale ?: app()->getLocale()).'.v4';
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
