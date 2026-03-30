<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SliderController extends Controller
{
    public function index()
    {
        return view('modules.slider.index');
    }

    public function list()
    {
        return datatables()->of(Slider::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.slider.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.slider.form');
    }

    public function store(StoreSliderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/sliders','public');
                }

            Slider::create($data);
            DB::commit();
            return redirect()->route('sliders.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Slider store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            return view('modules.slider.form', compact('slider'));
        } catch(\Throwable $e) {
            Log::warning('Slider edit error',['id'=>$id]);
            return redirect()->route('sliders.index')->with('error','Data not found');
        }
    }

    public function update(UpdateSliderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/sliders','public');
                }

            $slider = Slider::findOrFail($id);
            $slider->update($data);
            DB::commit();
            return redirect()->route('sliders.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Slider update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $slider = Slider::findOrFail($id);
            $slider->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Slider delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}