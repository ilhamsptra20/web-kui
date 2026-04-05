<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        return view('modules.setting.index');
    }
    public function list()
    {
        return datatables()
            ->of(Setting::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.setting.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.setting.form');
    }

    public function store(StoreSettingRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $setting = Setting::create($data);

            DB::commit();

            return redirect()->route('settings.show', $setting)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Setting $setting)
    {

        return view('modules.setting.show', compact('setting'));
    }

    public function edit(Setting $setting)
    {

        return view('modules.setting.form', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $setting->update($data);

            DB::commit();

            return redirect()->route('settings.show', $setting)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Setting $setting)
    {
        DB::beginTransaction();

        try {

            $setting->delete();

            DB::commit();

            return redirect()->route('settings.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}