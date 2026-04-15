<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Http\Requests\StoreInboxRequest;
use App\Http\Requests\UpdateInboxRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;

class InboxController extends Controller
{
    public function index()
    {
        return view('modules.inbox.index');
    }
    public function list()
    {
        return datatables()
            ->of(Inbox::query()->latest())
            ->addIndexColumn()
            ->addColumn('sender_identity', fn (Inbox $row): string => AdminTable::stack($row->name ?: '-', $row->email ?: null))
            ->addColumn('message_preview', fn (Inbox $row): string => AdminTable::stack($row->subject ?: 'Tanpa Subjek', AdminTable::limit($row->message, 80)))
            ->addColumn('status_badge', fn (Inbox $row): string => AdminTable::boolean((bool) $row->is_read, 'Sudah Dibaca', 'Belum Dibaca'))
            ->addColumn('received_at_label', fn (Inbox $row): string => AdminTable::dateTime($row->created_at))
            ->addColumn('action', fn ($row) => view('modules.inbox.action', compact('row'))->render())
            ->rawColumns(['sender_identity', 'message_preview', 'status_badge', 'received_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.inbox.form');
    }

    public function store(StoreInboxRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $inbox = Inbox::create($data);

            DB::commit();

            return redirect()->route('inboxes.show', $inbox)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Inbox $inbox)
    {
        if (! $inbox->is_read) {
            $inbox->forceFill(['is_read' => true])->save();
        }

        return view('modules.inbox.show', compact('inbox'));
    }

    public function edit(Inbox $inbox)
    {

        return view('modules.inbox.form', compact('inbox'));
    }

    public function update(UpdateInboxRequest $request, Inbox $inbox)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $inbox->update($data);

            DB::commit();

            return redirect()->route('inboxes.show', $inbox)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Inbox $inbox)
    {
        DB::beginTransaction();

        try {

            $inbox->delete();

            DB::commit();

            return redirect()->route('inboxes.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('inboxes.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
