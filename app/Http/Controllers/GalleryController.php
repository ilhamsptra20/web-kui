<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreGalleryRequest, UpdateGalleryRequest};
use App\Services\Contracts\GalleryServiceInterface;


class GalleryController extends Controller 
{
    protected $service;

    public function __construct(GalleryServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.gallery.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.gallery.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        $albums = \App\Models\Album::all();
        return view('modules.gallery.form', compact('albums'));
    }

    public function store(StoreGalleryRequest $r) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/galleries', 'public');
        }
        $this->service->store($data);
        return redirect()->route('galleries.index');
    }

    public function edit($id) 
    { 
        $gallery = $this->service->find($id); 
        $albums = \App\Models\Album::all();
        return view('modules.gallery.form', compact('gallery', 'albums'));
    }

    public function update(UpdateGalleryRequest $r, $id) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/galleries', 'public');
        }
        $this->service->update($id, $data);
        return redirect()->route('galleries.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}