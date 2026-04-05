<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        return view('modules.gallery.index');
    }
    public function list()
    {
        return datatables()
            ->of(Gallery::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.gallery.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        $albums = \App\Models\Album::query()->latest()->get();
        return view('modules.gallery.form', compact('albums'));
    }

    public function store(StoreGalleryRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/galleries', 'public');
            }

            $gallery = Gallery::create($data);

            DB::commit();

            return redirect()->route('galleries.show', $gallery)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Gallery $gallery)
    {
        $albums = \App\Models\Album::query()->latest()->get();
        return view('modules.gallery.show', compact('gallery', 'albums'));
    }

    public function edit(Gallery $gallery)
    {
        $albums = \App\Models\Album::query()->latest()->get();
        return view('modules.gallery.form', compact('gallery', 'albums'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($gallery->image) {
                    Storage::disk('public')->delete($gallery->image);
                }

                $data['image'] = $request->file('image')->store('modules/galleries', 'public');
            }

            $gallery->update($data);

            DB::commit();

            return redirect()->route('galleries.show', $gallery)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Gallery $gallery)
    {
        DB::beginTransaction();

        try {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $gallery->delete();

            DB::commit();

            return redirect()->route('galleries.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}