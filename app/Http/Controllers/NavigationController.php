<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNavigationRequest;
use App\Http\Requests\UpdateNavigationRequest;
use App\Models\Navigation;
use App\Support\Navigation\NavigationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NavigationController extends Controller
{
    public function __construct(private readonly NavigationService $navigationService)
    {
    }

    public function index()
    {
        $stats = [
            'total' => 0,
            'admin' => 0,
            'marketing' => 0,
            'active' => 0,
        ];

        if (Schema::hasTable('navigations')) {
            $stats['total'] = Navigation::query()->count();
            $stats['admin'] = Navigation::query()->where('area', Navigation::AREA_ADMIN)->count();
            $stats['marketing'] = Navigation::query()->where('area', Navigation::AREA_MARKETING)->count();
            $stats['active'] = Navigation::query()->where('is_active', true)->count();
        }

        return view('modules.navigation.index', compact('stats'));
    }

    public function list()
    {
        if (! Schema::hasTable('navigations')) {
            return datatables()->of(collect())->toJson();
        }

        return datatables()
            ->of(Navigation::query()->with('parent')->select('navigations.*'))
            ->addIndexColumn()
            ->addColumn('title', function (Navigation $row): string {
                $icon = $row->icon ? "<i class=\"{$row->icon} mr-50\"></i>" : '';
                $destination = $row->route_name ?: ($row->url ?: '-');
                $meta = e($destination);
                $title = e($row->trans('title') ?? '-');

                return "<div class=\"d-flex align-items-start\">
                            <div class=\"navigation-list-icon mr-1\">{$icon}</div>
                            <div>
                                <div class=\"font-weight-semibold\">{$title}</div>
                                <small class=\"text-muted\">{$meta}</small>
                            </div>
                        </div>";
            })
            ->addColumn('parent_label', fn (Navigation $row): string => e($row->parent?->trans('title') ?? '-'))
            ->addColumn('area_badge', function (Navigation $row): string {
                $class = $row->area === Navigation::AREA_ADMIN ? 'badge-light-primary' : 'badge-light-success';
                $label = e(Navigation::areaOptions()[$row->area] ?? $row->area);

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('location_badge', function (Navigation $row): string {
                $class = match ($row->location) {
                    Navigation::LOCATION_SIDEBAR => 'badge-light-primary',
                    Navigation::LOCATION_NAVBAR => 'badge-light-warning',
                    Navigation::LOCATION_FOOTER => 'badge-light-info',
                    default => 'badge-light-secondary',
                };
                $label = e(Navigation::locationOptions()[$row->location] ?? $row->location);

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('type_badge', function (Navigation $row): string {
                $class = $row->type === Navigation::TYPE_HEADER ? 'badge-light-dark' : 'badge-light-secondary';
                $label = e(Navigation::typeOptions()[$row->type] ?? $row->type);

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('status_badge', function (Navigation $row): string {
                $class = $row->is_active ? 'badge-success' : 'badge-secondary';
                $label = $row->is_active ? 'Active' : 'Inactive';

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('action', fn (Navigation $row): string => view('modules.navigation.action', compact('row'))->render())
            ->rawColumns(['title', 'area_badge', 'location_badge', 'type_badge', 'status_badge', 'action'])
            ->toJson();
    }

    public function create()
    {
        return view('modules.navigation.form', $this->formData());
    }

    public function store(StoreNavigationRequest $request)
    {
        DB::beginTransaction();

        try {
            $navigation = Navigation::create($this->normalizeData($request->validated()));

            DB::commit();

            return redirect()->route('navigations.show', $navigation)->with('success', 'Navigation berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal membuat navigation.');
        }
    }

    public function show(Navigation $navigation)
    {
        $navigation->load('parent');

        return view('modules.navigation.show', $this->formData($navigation));
    }

    public function edit(Navigation $navigation)
    {
        $navigation->load('parent');

        return view('modules.navigation.form', $this->formData($navigation));
    }

    public function update(UpdateNavigationRequest $request, Navigation $navigation)
    {
        DB::beginTransaction();

        try {
            $navigation->update($this->normalizeData($request->validated(), $navigation));

            DB::commit();

            return redirect()->route('navigations.show', $navigation)->with('success', 'Navigation berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal memperbarui navigation.');
        }
    }

    public function destroy(Navigation $navigation)
    {
        DB::beginTransaction();

        try {
            $navigation->children()->update(['parent_id' => null]);
            $navigation->delete();

            DB::commit();

            return redirect()->route('navigations.index')->with('success', 'Navigation berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('navigations.index')->with('error', 'Gagal menghapus navigation: ' . $e->getMessage());
        }
    }

    private function formData(?Navigation $navigation = null): array
    {
        return [
            'navigation' => $navigation,
            'areaOptions' => Navigation::areaOptions(),
            'locationOptions' => Navigation::locationOptions(),
            'typeOptions' => Navigation::typeOptions(),
            'parentNavigations' => $this->navigationService->parentNavigations($navigation),
            'iconOptions' => collect(config('feather-icons', []))
                ->mapWithKeys(fn (string $icon): array => ["feather icon-{$icon}" => $icon])
                ->all(),
        ];
    }

    private function normalizeData(array $data, ?Navigation $navigation = null): array
    {
        $data['area'] = $data['area'] ?? Navigation::AREA_ADMIN;
        $data['location'] = $data['area'] === Navigation::AREA_ADMIN
            ? Navigation::LOCATION_SIDEBAR
            : ($data['location'] ?? Navigation::LOCATION_NAVBAR);
        $data['type'] = $data['area'] === Navigation::AREA_MARKETING
            ? Navigation::TYPE_LINK
            : ($data['type'] ?? Navigation::TYPE_LINK);
        $data['parent_id'] = blank($data['parent_id'] ?? null) ? null : $data['parent_id'];
        $data['url'] = blank($data['url'] ?? null) ? null : $data['url'];
        $data['route_name'] = blank($data['route_name'] ?? null) ? null : $data['route_name'];
        $data['icon'] = blank($data['icon'] ?? null) ? null : $data['icon'];
        $data['badge_text'] = blank($data['badge_text'] ?? null) ? null : $data['badge_text'];
        $data['badge_class'] = blank($data['badge_class'] ?? null) ? null : $data['badge_class'];
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['open_in_new_tab'] = (bool) ($data['open_in_new_tab'] ?? false);

        if (($data['type'] ?? null) === Navigation::TYPE_HEADER) {
            $data['parent_id'] = null;
            $data['url'] = null;
            $data['route_name'] = null;
            $data['badge_text'] = null;
            $data['badge_class'] = null;
            $data['icon'] = null;
            $data['open_in_new_tab'] = false;
        }

        if (($data['area'] ?? null) === Navigation::AREA_MARKETING) {
            $data['badge_text'] = null;
            $data['badge_class'] = null;
            $data['icon'] = null;
        }

        if ($navigation && ($data['parent_id'] ?? null) === $navigation->id) {
            $data['parent_id'] = null;
        }

        return $data;
    }
}
