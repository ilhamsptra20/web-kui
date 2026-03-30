<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Http\Requests\StoreSocialMediaRequest;
use App\Http\Requests\UpdateSocialMediaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SocialMediaController extends Controller
{
    public function index()
    {
        return view('modules.social_media.index');
    }

    public function list()
    {
        return datatables()->of(SocialMedia::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.social_media.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.social_media.form');
    }

    public function store(StoreSocialMediaRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            SocialMedia::create($data);
            DB::commit();
            return redirect()->route('social_media.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('SocialMedia store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $social_media = SocialMedia::findOrFail($id);

            return view('modules.social_media.form', compact('social_media'));
        } catch(\Throwable $e) {
            Log::warning('SocialMedia edit error',['id'=>$id]);
            return redirect()->route('social_media.index')->with('error','Data not found');
        }
    }

    public function update(UpdateSocialMediaRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $social_media = SocialMedia::findOrFail($id);
            $social_media->update($data);
            DB::commit();
            return redirect()->route('social_media.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('SocialMedia update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $social_media = SocialMedia::findOrFail($id);
            $social_media->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('SocialMedia delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}