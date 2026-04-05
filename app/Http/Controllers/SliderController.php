<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        return view('modules.slider.index');
    }
    public function list()
    {
        return datatables()
            ->of(Slider::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.slider.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
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
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/sliders', 'public');
            }

            $slider = Slider::create($data);

            DB::commit();

            return redirect()->route('sliders.show', $slider)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Slider $slider)
    {

        return view('modules.slider.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {

        return view('modules.slider.form', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($slider->image) {
                    Storage::disk('public')->delete($slider->image);
                }

                $data['image'] = $request->file('image')->store('modules/sliders', 'public');
            }

            $slider->update($data);

            DB::commit();

            return redirect()->route('sliders.show', $slider)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Slider $slider)
    {
        DB::beginTransaction();

        try {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $slider->delete();

            DB::commit();

            return redirect()->route('sliders.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}