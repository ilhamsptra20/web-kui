<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StorePageRequest, UpdatePageRequest};
use App\Services\Contracts\PageServiceInterface;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller 
{
    protected $service;

    public function __construct(PageServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.page.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.page.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.page.form');
    }

    public function store(StorePageRequest $r) 
    {
        $data = $r->validated();
        $data['user_id'] = Auth::id();
        $this->service->store($data);
        return redirect()->route('pages.index');
    }

    public function edit($id) 
    { 
        $page = $this->service->find($id); 
        return view('modules.page.form', compact('page'));
    }

    public function update(UpdatePageRequest $r, $id) 
    {
        $data = $r->validated();
        $data['user_id'] = Auth::id();
        $this->service->update($id, $data);
        return redirect()->route('pages.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}