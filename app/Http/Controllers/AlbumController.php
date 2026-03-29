<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AlbumController extends Controller
{
    public function index()
    {
        return view('modules.album.index');
    }

    public function list()
    {
        return datatables()->of(Album::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.album.action',compact('row'))->render())->rawColumns(['action'])->toJson();
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

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/albums','public');
                }

            Album::create($data);
            DB::commit();
            return redirect()->route('albums.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Album store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $album = Album::findOrFail($id);

            return view('modules.album.form', compact('album'));
        } catch(\Throwable $e) {
            Log::warning('Album edit error',['id'=>$id]);
            return redirect()->route('albums.index')->with('error','Data not found');
        }
    }

    public function update(UpdateAlbumRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/albums','public');
                }

            $album = Album::findOrFail($id);
            $album->update($data);
            DB::commit();
            return redirect()->route('albums.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Album update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $album = Album::findOrFail($id);
            $album->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Album delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}