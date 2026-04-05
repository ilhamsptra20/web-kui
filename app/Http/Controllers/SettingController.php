<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSettingGroupRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{
    public function __construct(private readonly SettingService $settingService)
    {
    }

    public function index(Request $request)
    {
        $groups = collect();
        $schemaReady = $this->builderSchemaReady();

        if ($schemaReady) {
            $groups = Setting::query()
                ->select('group', DB::raw('COUNT(*) as total'))
                ->groupBy('group')
                ->orderBy('group')
                ->get();
        }

        $activeGroup = $this->settingService->normalizeGroup(
            (string) $request->query('group', old('group', $groups->first()->group ?? 'General'))
        );

        if ($groups->where('group', $activeGroup)->isEmpty()) {
            $groups->push((object) ['group' => $activeGroup, 'total' => 0]);
        }

        $settings = $schemaReady
            ? Setting::query()->group($activeGroup)->orderBy('label')->orderBy('key')->get()
            : collect();

        return view('modules.setting.index', [
            'schemaReady' => $schemaReady,
            'groups' => $groups->sortBy('group')->values(),
            'activeGroup' => $activeGroup,
            'settings' => $settings,
            'typeOptions' => Setting::typeOptions(),
            'settingItems' => $settings
                ->map(fn (Setting $setting): array => $this->settingService->mapForEditor($setting))
                ->all(),
        ]);
    }

    public function create()
    {
        return redirect()->route('settings.index');
    }

    public function show(Setting $setting)
    {
        return redirect()->route('settings.index', ['group' => $setting->group]);
    }

    public function edit(Setting $setting)
    {
        return redirect()->route('settings.index', ['group' => $setting->group]);
    }

    public function publish(SaveSettingGroupRequest $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();
            $group = $this->settingService->normalizeGroup($validated['group']);

            $this->settingService->syncGroup($group, $validated['items'] ?? []);

            DB::commit();

            return redirect()->route('settings.index', ['group' => $group])->with('success', 'Setting group berhasil dipublish.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Gagal menyimpan setting group.');
        }
    }

    public function destroy(Setting $setting)
    {
        DB::beginTransaction();

        try {
            $group = $setting->group;
            $this->settingService->delete($setting);

            DB::commit();

            return redirect()->route('settings.index', ['group' => $group])->with('success', 'Setting berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Gagal menghapus setting.');
        }
    }

    private function builderSchemaReady(): bool
    {
        return Schema::hasTable('settings')
            && Schema::hasColumn('settings', 'group')
            && Schema::hasColumn('settings', 'label')
            && Schema::hasColumn('settings', 'type');
    }
}
