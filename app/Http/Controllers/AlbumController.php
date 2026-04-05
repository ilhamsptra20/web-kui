<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        return view('modules.album.index');
    }
    public function list()
    {
        return datatables()
            ->of(Album::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.album.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.album.form');
    }

    public function store(StoreAlbumRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/albums', 'public');
            }

            $album = Album::create($data);

            DB::commit();

            return redirect()->route('albums.show', $album)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Album $album)
    {

        return view('modules.album.show', compact('album'));
    }

    public function edit(Album $album)
    {

        return view('modules.album.form', compact('album'));
    }

    public function update(UpdateAlbumRequest $request, Album $album)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($album->image) {
                    Storage::disk('public')->delete($album->image);
                }

                $data['image'] = $request->file('image')->store('modules/albums', 'public');
            }

            $album->update($data);

            DB::commit();

            return redirect()->route('albums.show', $album)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Album $album)
    {
        DB::beginTransaction();

        try {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }

            $album->delete();

            DB::commit();

            return redirect()->route('albums.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}