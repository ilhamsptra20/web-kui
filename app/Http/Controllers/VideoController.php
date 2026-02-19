<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreVideoRequest, UpdateVideoRequest};
use App\Services\Contracts\VideoServiceInterface;


class VideoController extends Controller 
{
    protected $service;

    public function __construct(VideoServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.video.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.video.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.video.form');
    }

    public function store(StoreVideoRequest $r) 
    {
        $data = $r->validated();
        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('modules/videos', 'public');
        }
        $this->service->store($data);
        return redirect()->route('videos.index');
    }

    public function edit($id) 
    { 
        $video = $this->service->find($id); 
        return view('modules.video.form', compact('video'));
    }

    public function update(UpdateVideoRequest $r, $id) 
    {
        $data = $r->validated();
        if ($r->hasFile('thumbnail')) {
            $data['thumbnail'] = $r->file('thumbnail')->store('modules/videos', 'public');
        }
        $this->service->update($id, $data);
        return redirect()->route('videos.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}