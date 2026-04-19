<?php

namespace Database\Seeders;

use App\Models\Navigation;
use App\Support\Navigation\NavigationService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NavigationSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('navigations')) {
            return;
        }

        Navigation::query()
            ->where('area', Navigation::AREA_MARKETING)
            ->delete();

        $this->seedMarketing(config('navigator.marketing.navbar', []), Navigation::LOCATION_NAVBAR);
        $this->seedMarketing(config('navigator.marketing.footer', []), Navigation::LOCATION_FOOTER);

        app(NavigationService::class)->clearCache();
    }

    private function seedMarketing(array $items, string $location, ?string $parentId = null): void
    {
        foreach (array_values($items) as $index => $item) {
            $navigation = Navigation::create([
                'id' => (string) Str::uuid(),
                'parent_id' => $parentId,
                'area' => Navigation::AREA_MARKETING,
                'location' => $location,
                'type' => Navigation::TYPE_LINK,
                'module_key' => $item['module_key'] ?? $this->guessModuleKey($item),
                'title_id' => $item['title_id'] ?? $item['title'] ?? '-',
                'title_en' => $item['title_en'] ?? $item['title'] ?? null,
                'title_ar' => $item['title_ar'] ?? null,
                'url' => $item['url'] ?? null,
                'route_name' => $item['route_name'] ?? null,
                'icon' => $item['icon'] ?? null,
                'badge_text' => $item['badge']['text'] ?? null,
                'badge_class' => $item['badge']['class'] ?? null,
                'sort_order' => ($index + 1) * 10,
                'is_active' => $item['is_active'] ?? true,
                'open_in_new_tab' => ($item['target'] ?? '_self') === '_blank',
            ]);

            if (! empty($item['children']) && is_array($item['children'])) {
                $this->seedMarketing($item['children'], $location, $navigation->id);
            }
        }
    }

    private function guessModuleKey(array $item): ?string
    {
        $routeName = $item['route_name'] ?? null;

        if (! $routeName) {
            return null;
        }

        foreach (config('navigator.modules', []) as $key => $module) {
            if (($module['route_name'] ?? null) === $routeName) {
                return $key;
            }
        }

        return null;
    }
}
