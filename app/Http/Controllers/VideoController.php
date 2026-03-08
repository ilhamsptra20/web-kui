<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class VideoController extends Controller
{
    public function index()
    {
        return view('modules.video.index');
    }

    public function list()
    {
        return datatables()->of(Video::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.video.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.video.form');
    }

    public function store(StoreVideoRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('thumbnail')){
                    $data['thumbnail'] = $request->file('thumbnail')->store('modules/videos','public');
                }

            Video::create($data);
            DB::commit();
            return redirect()->route('videos.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Video store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $video = Video::findOrFail($id);

            return view('modules.video.form', compact('video'));
        } catch(\Throwable $e) {
            Log::warning('Video edit error',['id'=>$id]);
            return redirect()->route('videos.index')->with('error','Data not found');
        }
    }

    public function update(UpdateVideoRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('thumbnail')){
                    $data['thumbnail'] = $request->file('thumbnail')->store('modules/videos','public');
                }

            $video = Video::findOrFail($id);
            $video->update($data);
            DB::commit();
            return redirect()->route('videos.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Video update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::findOrFail($id);
            $video->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Video delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}