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
            'navbar' => 0,
            'footer' => 0,
            'active' => 0,
        ];

        if (Schema::hasTable('navigations')) {
            $baseQuery = Navigation::query()->where('area', Navigation::AREA_MARKETING);

            $stats['total'] = (clone $baseQuery)->count();
            $stats['navbar'] = (clone $baseQuery)->where('location', Navigation::LOCATION_NAVBAR)->count();
            $stats['footer'] = (clone $baseQuery)->where('location', Navigation::LOCATION_FOOTER)->count();
            $stats['active'] = (clone $baseQuery)->where('is_active', true)->count();
        }

        return view('modules.navigation.index', compact('stats'));
    }

    public function list()
    {
        if (! Schema::hasTable('navigations')) {
            return datatables()->of(collect())->toJson();
        }

        return datatables()
            ->of(Navigation::query()
                ->with('parent')
                ->where('area', Navigation::AREA_MARKETING)
                ->select('navigations.*'))
            ->addIndexColumn()
            ->addColumn('title', function (Navigation $row): string {
                $meta = e($row->url ?: '-');
                $title = e($row->trans('title') ?? '-');

                return "<div class=\"d-flex align-items-start\">
                            <div class=\"navigation-list-icon mr-1\"><i class=\"feather icon-menu\"></i></div>
                            <div>
                                <div class=\"font-weight-semibold\">{$title}</div>
                                <small class=\"text-muted\">{$meta}</small>
                            </div>
                        </div>";
            })
            ->addColumn('parent_label', fn (Navigation $row): string => e($row->parent?->trans('title') ?? '-'))
            ->addColumn('location_badge', function (Navigation $row): string {
                $class = match ($row->location) {
                    Navigation::LOCATION_NAVBAR => 'badge-light-warning',
                    Navigation::LOCATION_FOOTER => 'badge-light-info',
                    default => 'badge-light-secondary',
                };
                $label = e(Navigation::locationOptions()[$row->location] ?? $row->location);

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('destination', function (Navigation $row): string {
                $destination = e($row->url ?: '-');

                return "<span class=\"badge badge-light-secondary\">{$destination}</span>";
            })
            ->addColumn('status_badge', function (Navigation $row): string {
                $class = $row->is_active ? 'badge-success' : 'badge-secondary';
                $label = $row->is_active ? 'Active' : 'Inactive';

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('action', fn (Navigation $row): string => view('modules.navigation.action', compact('row'))->render())
            ->rawColumns(['title', 'location_badge', 'destination', 'status_badge', 'action'])
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
        $this->abortIfNotMarketing($navigation);
        $navigation->load('parent');

        return view('modules.navigation.show', $this->formData($navigation));
    }

    public function edit(Navigation $navigation)
    {
        $this->abortIfNotMarketing($navigation);
        $navigation->load('parent');

        return view('modules.navigation.form', $this->formData($navigation));
    }

    public function update(UpdateNavigationRequest $request, Navigation $navigation)
    {
        $this->abortIfNotMarketing($navigation);
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
        $this->abortIfNotMarketing($navigation);
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
            'locationOptions' => Navigation::locationOptions(),
            'parentNavigations' => $this->navigationService->parentNavigations($navigation),
        ];
    }

    private function normalizeData(array $data, ?Navigation $navigation = null): array
    {
        $data['area'] = Navigation::AREA_MARKETING;
        $data['location'] = $data['location'] ?? Navigation::LOCATION_NAVBAR;
        $data['type'] = Navigation::TYPE_LINK;
        $data['parent_id'] = blank($data['parent_id'] ?? null) ? null : $data['parent_id'];
        $data['url'] = blank($data['url'] ?? null) ? '#' : $data['url'];
        $data['icon'] = null;
        $data['badge_text'] = null;
        $data['badge_class'] = null;
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['open_in_new_tab'] = (bool) ($data['open_in_new_tab'] ?? false);

        if ($navigation && ($data['parent_id'] ?? null) === $navigation->id) {
            $data['parent_id'] = null;
        }

        return $data;
    }

    private function abortIfNotMarketing(Navigation $navigation): void
    {
        abort_unless($navigation->area === Navigation::AREA_MARKETING, 404);
    }

}
