<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AnnouncementController extends Controller
{
    public function index()
    {
        return view('modules.announcement.index');
    }

    public function list()
    {
        return datatables()->of(Announcement::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.announcement.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.announcement.form');
    }

    public function store(StoreAnnouncementRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            Announcement::create($data);
            DB::commit();
            return redirect()->route('announcements.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Announcement store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);

            return view('modules.announcement.form', compact('announcement'));
        } catch(\Throwable $e) {
            Log::warning('Announcement edit error',['id'=>$id]);
            return redirect()->route('announcements.index')->with('error','Data not found');
        }
    }

    public function update(UpdateAnnouncementRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $announcement = Announcement::findOrFail($id);
            $announcement->update($data);
            DB::commit();
            return redirect()->route('announcements.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Announcement update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $announcement = Announcement::findOrFail($id);
            $announcement->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Announcement delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}