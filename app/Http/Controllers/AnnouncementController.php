<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('modules.announcement.index');
    }
    public function list()
    {
        return datatables()
            ->of(Announcement::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.announcement.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
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

            $announcement = Announcement::create($data);

            DB::commit();

            return redirect()->route('announcements.show', $announcement)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Announcement $announcement)
    {

        return view('modules.announcement.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {

        return view('modules.announcement.form', compact('announcement'));
    }

    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $announcement->update($data);

            DB::commit();

            return redirect()->route('announcements.show', $announcement)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Announcement $announcement)
    {
        DB::beginTransaction();

        try {

            $announcement->delete();

            DB::commit();

            return redirect()->route('announcements.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}