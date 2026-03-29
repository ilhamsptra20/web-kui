<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SettingController extends Controller
{
    public function index()
    {
        return view('modules.setting.index');
    }

    public function list()
    {
        return datatables()->of(Setting::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.setting.action',compact('row'))->render())->rawColumns(['action'])->toJson();
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


            Setting::create($data);
            DB::commit();
            return redirect()->route('settings.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Setting store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $setting = Setting::findOrFail($id);

            return view('modules.setting.form', compact('setting'));
        } catch(\Throwable $e) {
            Log::warning('Setting edit error',['id'=>$id]);
            return redirect()->route('settings.index')->with('error','Data not found');
        }
    }

    public function update(UpdateSettingRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $setting = Setting::findOrFail($id);
            $setting->update($data);
            DB::commit();
            return redirect()->route('settings.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Setting update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $setting = Setting::findOrFail($id);
            $setting->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Setting delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}