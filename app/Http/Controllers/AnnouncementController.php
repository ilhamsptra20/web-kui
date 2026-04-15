<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Support\Admin\AdminTable;
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
            ->of(Announcement::query()->latest())
            ->addIndexColumn()
            ->addColumn('announcement_identity', fn (Announcement $row): string => AdminTable::stack($row->trans('title') ?: '-', AdminTable::limit(strip_tags($row->trans('content') ?: ''), 75)))
            ->addColumn('status_badge', fn (Announcement $row): string => AdminTable::boolean((bool) $row->is_active, 'Aktif', 'Nonaktif'))
            ->addColumn('attachment_badge', fn (Announcement $row): string => $row->hasFile() ? AdminTable::badge('Ada Lampiran', 'info') : AdminTable::badge('Tanpa Lampiran', 'secondary'))
            ->addColumn('updated_at_label', fn (Announcement $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.announcement.action', compact('row'))->render())
            ->rawColumns(['announcement_identity', 'status_badge', 'attachment_badge', 'updated_at_label', 'action'])
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

            return redirect()->route('announcements.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
