<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreAlbumRequest, UpdateAlbumRequest};
use App\Services\Contracts\AlbumServiceInterface;


class AlbumController extends Controller 
{
    protected $service;

    public function __construct(AlbumServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.album.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.album.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.album.form');
    }

    public function store(StoreAlbumRequest $r) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/albums', 'public');
        }
        $this->service->store($data);
        return redirect()->route('albums.index');
    }

    public function edit($id) 
    { 
        $album = $this->service->find($id); 
        return view('modules.album.form', compact('album'));
    }

    public function update(UpdateAlbumRequest $r, $id) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/albums', 'public');
        }
        $this->service->update($id, $data);
        return redirect()->route('albums.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}