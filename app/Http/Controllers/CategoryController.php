<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Services\Contracts\CategoryServiceInterface;


class CategoryController extends Controller 
{
    protected $service;

    public function __construct(CategoryServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.category.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.category.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.category.form');
    }

    public function store(StoreCategoryRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('categories.index');
    }

    public function edit($id) 
    { 
        $category = $this->service->find($id); 
        return view('modules.category.form', compact('category'));
    }

    public function update(UpdateCategoryRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('categories.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}