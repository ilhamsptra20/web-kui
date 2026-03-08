<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{
    public function index()
    {
        return view('modules.category.index');
    }

    public function list()
    {
        return datatables()->of(Category::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.category.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.category.form');
    }

    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            Category::create($data);
            DB::commit();
            return redirect()->route('categories.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Category store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);

            return view('modules.category.form', compact('category'));
        } catch(\Throwable $e) {
            Log::warning('Category edit error',['id'=>$id]);
            return redirect()->route('categories.index')->with('error','Data not found');
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $category = Category::findOrFail($id);
            $category->update($data);
            DB::commit();
            return redirect()->route('categories.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Category update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Category delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}