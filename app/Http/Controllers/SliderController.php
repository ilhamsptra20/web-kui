<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreSliderRequest, UpdateSliderRequest};
use App\Services\Contracts\SliderServiceInterface;


class SliderController extends Controller 
{
    protected $service;

    public function __construct(SliderServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.slider.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.slider.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.slider.form');
    }

    public function store(StoreSliderRequest $r) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/sliders', 'public');
        }
        $this->service->store($data);
        return redirect()->route('sliders.index');
    }

    public function edit($id) 
    { 
        $slider = $this->service->find($id); 
        return view('modules.slider.form', compact('slider'));
    }

    public function update(UpdateSliderRequest $r, $id) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/sliders', 'public');
        }
        $this->service->update($id, $data);
        return redirect()->route('sliders.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}