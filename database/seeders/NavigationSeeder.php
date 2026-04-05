<?php

namespace Database\Seeders;

use App\Models\Navigation;
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

        Navigation::query()->delete();

        $this->seedAdminSidebar(config('navigator.sidebar', []));
        $this->seedMarketing(config('navigator.marketing.navbar', []), Navigation::LOCATION_NAVBAR);
        $this->seedMarketing(config('navigator.marketing.footer', []), Navigation::LOCATION_FOOTER);
    }

    private function seedAdminSidebar(array $items, ?string $parentId = null): void
    {
        foreach (array_values($items) as $index => $item) {
            $navigation = Navigation::create([
                'id' => (string) Str::uuid(),
                'parent_id' => $parentId,
                'area' => Navigation::AREA_ADMIN,
                'location' => Navigation::LOCATION_SIDEBAR,
                'type' => isset($item['header']) ? Navigation::TYPE_HEADER : Navigation::TYPE_LINK,
                'title_id' => $item['title_id'] ?? $item['title'] ?? $item['header'] ?? '-',
                'title_en' => $item['title_en'] ?? $item['title'] ?? $item['header'] ?? null,
                'title_ar' => $item['title_ar'] ?? null,
                'url' => isset($item['header']) ? null : ($item['url'] ?? null),
                'route_name' => $item['route_name'] ?? null,
                'icon' => $item['icon'] ?? null,
                'badge_text' => $item['badge']['text'] ?? null,
                'badge_class' => $item['badge']['class'] ?? null,
                'sort_order' => ($index + 1) * 10,
                'is_active' => $item['is_active'] ?? true,
                'open_in_new_tab' => ($item['target'] ?? '_self') === '_blank',
            ]);

            if (! empty($item['submenu']) && is_array($item['submenu'])) {
                $this->seedAdminSidebar($item['submenu'], $navigation->id);
            }
        }
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
}
