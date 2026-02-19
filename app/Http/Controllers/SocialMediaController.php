<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreSocialMediaRequest, UpdateSocialMediaRequest};
use App\Services\Contracts\SocialMediaServiceInterface;


class SocialMediaController extends Controller 
{
    protected $service;

    public function __construct(SocialMediaServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.social_media.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.social_media.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.social_media.form');
    }

    public function store(StoreSocialMediaRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('social_media.index');
    }

    public function edit($id) 
    { 
        $social_media = $this->service->find($id); 
        return view('modules.social_media.form', compact('social_media'));
    }

    public function update(UpdateSocialMediaRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('social_media.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}