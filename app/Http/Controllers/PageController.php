<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Support\RichText\RichTextSanitizer;

class PageController extends Controller
{
    public function index()
    {
        return view('modules.page.index');
    }
    public function list()
    {
        return datatables()
            ->of(Page::query()->with('user')->latest())
            ->addIndexColumn()
            ->addColumn('page_identity', fn (Page $row): string => AdminTable::stack($row->trans('title') ?: '-', $row->slug ? 'Slug: '.$row->slug : null))
            ->addColumn('author_label', fn (Page $row): string => e($row->user?->name ?: '-'))
            ->addColumn('status_badge', fn (Page $row): string => AdminTable::boolean((bool) $row->status, 'Published', 'Draft'))
            ->addColumn('updated_at_label', fn (Page $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.page.action', compact('row'))->render())
            ->rawColumns(['page_identity', 'status_badge', 'updated_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.page.form');
    }

    public function store(StorePageRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $sanitizer = app(RichTextSanitizer::class);
            $data['content_id'] = $sanitizer->sanitize($data['content_id'] ?? null);
            $data['content_en'] = $sanitizer->sanitize($data['content_en'] ?? null);
            $data['content_ar'] = $sanitizer->sanitize($data['content_ar'] ?? null);
            $data['user_id'] = Auth::id();

            $page = Page::create($data);

            DB::commit();

            return redirect()->route('pages.show', $page)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Page $page)
    {

        return view('modules.page.show', compact('page'));
    }

    public function edit(Page $page)
    {

        return view('modules.page.form', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $sanitizer = app(RichTextSanitizer::class);
            $data['content_id'] = $sanitizer->sanitize($data['content_id'] ?? null);
            $data['content_en'] = $sanitizer->sanitize($data['content_en'] ?? null);
            $data['content_ar'] = $sanitizer->sanitize($data['content_ar'] ?? null);
            $data['user_id'] = Auth::id();

            $page->update($data);

            DB::commit();

            return redirect()->route('pages.show', $page)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Page $page)
    {
        DB::beginTransaction();

        try {

            $page->delete();

            DB::commit();

            return redirect()->route('pages.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}
