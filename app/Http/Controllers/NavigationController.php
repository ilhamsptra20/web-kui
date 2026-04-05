<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNavigationRequest;
use App\Http\Requests\UpdateNavigationRequest;
use App\Models\Navigation;
use App\Support\Navigation\NavigationService;
use Illuminate\Support\Facades\DB;

class NavigationController extends Controller
{
    public function __construct(private readonly NavigationService $navigationService)
    {
    }

    public function index()
    {
        return view('modules.navigation.index');
    }

    public function list()
    {
        return datatables()
            ->of(Navigation::query()->with('parent')->select('navigations.*'))
            ->addIndexColumn()
            ->addColumn('title', fn (Navigation $row): string => e($row->trans('title') ?? '-'))
            ->addColumn('parent_label', fn (Navigation $row): string => e($row->parent?->trans('title') ?? '-'))
            ->addColumn('area_label', fn (Navigation $row): string => e(Navigation::areaOptions()[$row->area] ?? $row->area))
            ->addColumn('location_label', fn (Navigation $row): string => e(Navigation::locationOptions()[$row->location] ?? $row->location))
            ->addColumn('type_label', fn (Navigation $row): string => e(Navigation::typeOptions()[$row->type] ?? $row->type))
            ->addColumn('status_badge', function (Navigation $row): string {
                $class = $row->is_active ? 'badge-success' : 'badge-secondary';
                $label = $row->is_active ? 'Active' : 'Inactive';

                return "<span class=\"badge {$class}\">{$label}</span>";
            })
            ->addColumn('action', fn (Navigation $row): string => view('modules.navigation.action', compact('row'))->render())
            ->rawColumns(['status_badge', 'action'])
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

            return back()->with('error', 'Gagal menghapus navigation.');
        }
    }

    private function formData(?Navigation $navigation = null): array
    {
        return [
            'navigation' => $navigation,
            'areaOptions' => Navigation::areaOptions(),
            'locationOptions' => Navigation::locationOptions(),
            'typeOptions' => Navigation::typeOptions(),
            'parentOptions' => $this->navigationService->parentOptions($navigation),
        ];
    }

    private function normalizeData(array $data, ?Navigation $navigation = null): array
    {
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
            $data['url'] = null;
            $data['route_name'] = null;
            $data['badge_text'] = null;
            $data['badge_class'] = null;
            $data['open_in_new_tab'] = false;
        }

        if ($navigation && ($data['parent_id'] ?? null) === $navigation->id) {
            $data['parent_id'] = null;
        }

        return $data;
    }
}
