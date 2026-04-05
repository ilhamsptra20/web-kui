<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        return view('modules.category.index');
    }
    public function list()
    {
        return datatables()
            ->of(Category::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.category.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
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

            $category = Category::create($data);

            DB::commit();

            return redirect()->route('categories.show', $category)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Category $category)
    {

        return view('modules.category.show', compact('category'));
    }

    public function edit(Category $category)
    {

        return view('modules.category.form', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $category->update($data);

            DB::commit();

            return redirect()->route('categories.show', $category)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {

            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}