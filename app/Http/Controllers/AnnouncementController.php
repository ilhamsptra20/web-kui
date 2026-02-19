<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreAnnouncementRequest, UpdateAnnouncementRequest};
use App\Services\Contracts\AnnouncementServiceInterface;


class AnnouncementController extends Controller 
{
    protected $service;

    public function __construct(AnnouncementServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.announcement.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.announcement.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.announcement.form');
    }

    public function store(StoreAnnouncementRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('announcements.index');
    }

    public function edit($id) 
    { 
        $announcement = $this->service->find($id); 
        return view('modules.announcement.form', compact('announcement'));
    }

    public function update(UpdateAnnouncementRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('announcements.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}