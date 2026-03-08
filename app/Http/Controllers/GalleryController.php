<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class GalleryController extends Controller
{
    public function index()
    {
        return view('modules.gallery.index');
    }

    public function list()
    {
        return datatables()->of(Gallery::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.gallery.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {
        $albums = \App\Models\Album::query()->orderBy('name_id')->get();

        return view('modules.gallery.form', compact('albums'));
    }

    public function store(StoreGalleryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/galleries','public');
                }

            Gallery::create($data);
            DB::commit();
            return redirect()->route('galleries.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Gallery store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
        $albums = \App\Models\Album::query()->orderBy('name_id')->get();

            return view('modules.gallery.form', compact('gallery','albums'));
        } catch(\Throwable $e) {
            Log::warning('Gallery edit error',['id'=>$id]);
            return redirect()->route('galleries.index')->with('error','Data not found');
        }
    }

    public function update(UpdateGalleryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/galleries','public');
                }

            $gallery = Gallery::findOrFail($id);
            $gallery->update($data);
            DB::commit();
            return redirect()->route('galleries.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Gallery update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Gallery delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}