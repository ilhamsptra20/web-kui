<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Support\Admin\AdminTable;
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
            ->of(Slider::query()->orderByRaw('`order` asc')->latest())
            ->addIndexColumn()
            ->addColumn('slider_identity', fn (Slider $row): string => AdminTable::image(\App\Models\Setting::resolveImageUrl($row->image), $row->title_id ?: '-', $row->subtitle_id ?: null))
            ->addColumn('cta_label', fn (Slider $row): string => AdminTable::stack($row->btn_text_id ?: '-', $row->btn_url ?: 'Tanpa URL'))
            ->addColumn('order_label', fn (Slider $row): string => (string) ($row->order ?? 0))
            ->addColumn('updated_at_label', fn (Slider $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.slider.action', compact('row'))->render())
            ->rawColumns(['slider_identity', 'cta_label', 'updated_at_label', 'action'])
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

            return redirect()->route('sliders.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
