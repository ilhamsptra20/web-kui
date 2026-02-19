<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StorePositionRequest, UpdatePositionRequest};
use App\Services\Contracts\PositionServiceInterface;


class PositionController extends Controller 
{
    protected $service;

    public function __construct(PositionServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.position.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.position.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.position.form');
    }

    public function store(StorePositionRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('positions.index');
    }

    public function edit($id) 
    { 
        $position = $this->service->find($id); 
        return view('modules.position.form', compact('position'));
    }

    public function update(UpdatePositionRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('positions.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}