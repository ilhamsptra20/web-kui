<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreInboxRequest, UpdateInboxRequest};
use App\Services\Contracts\InboxServiceInterface;


class InboxController extends Controller 
{
    protected $service;

    public function __construct(InboxServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.inbox.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.inbox.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.inbox.form');
    }

    public function store(StoreInboxRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('inboxes.index');
    }

    public function edit($id) 
    { 
        $inbox = $this->service->find($id); 
        return view('modules.inbox.form', compact('inbox'));
    }

    public function update(UpdateInboxRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('inboxes.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}