<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Support\Admin\AdminTable;
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
            ->of(Category::query()->withCount('posts')->latest())
            ->addIndexColumn()
            ->addColumn('category_identity', fn (Category $row): string => AdminTable::stack($row->trans('title') ?: '-', $row->title_en ? 'EN: '.$row->title_en : null))
            ->addColumn('post_count', fn (Category $row): string => (string) $row->posts_count)
            ->addColumn('updated_at_label', fn (Category $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.category.action', compact('row'))->render())
            ->rawColumns(['category_identity', 'updated_at_label', 'action'])
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
            // Set category_id of related posts to null
            $category->posts()->update(['category_id' => null]);

            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('categories.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
