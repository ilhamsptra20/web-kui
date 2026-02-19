<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreSettingRequest, UpdateSettingRequest};
use App\Services\Contracts\SettingServiceInterface;


class SettingController extends Controller 
{
    protected $service;

    public function __construct(SettingServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.setting.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.setting.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.setting.form');
    }

    public function store(StoreSettingRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('settings.index');
    }

    public function edit($id) 
    { 
        $setting = $this->service->find($id); 
        return view('modules.setting.form', compact('setting'));
    }

    public function update(UpdateSettingRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('settings.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}