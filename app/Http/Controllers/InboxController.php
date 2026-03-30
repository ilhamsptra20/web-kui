<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Http\Requests\StoreInboxRequest;
use App\Http\Requests\UpdateInboxRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class InboxController extends Controller
{
    public function index()
    {
        return view('modules.inbox.index');
    }

    public function list()
    {
        return datatables()->of(Inbox::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.inbox.action',compact('row'))->render())->rawColumns(['action'])->toJson();
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


            Inbox::create($data);
            DB::commit();
            return redirect()->route('inboxes.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Inbox store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $inbox = Inbox::findOrFail($id);

            return view('modules.inbox.form', compact('inbox'));
        } catch(\Throwable $e) {
            Log::warning('Inbox edit error',['id'=>$id]);
            return redirect()->route('inboxes.index')->with('error','Data not found');
        }
    }

    public function update(UpdateInboxRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $inbox = Inbox::findOrFail($id);
            $inbox->update($data);
            DB::commit();
            return redirect()->route('inboxes.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Inbox update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $inbox = Inbox::findOrFail($id);
            $inbox->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Inbox delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}