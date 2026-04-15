<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Support\RichText\RichTextSanitizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            ->addColumn('page_identity', fn (Page $row): string => AdminTable::stack(
                $row->trans('title') ?: '-',
                trim(implode(' | ', array_filter([
                    ucfirst($row->type ?: Page::TYPE_TEXT),
                    $row->slug ? 'Slug: '.$row->slug : null,
                ])))
            ))
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
            [$data, $fileToDelete] = $this->preparePageData($request, $data);
            $data['user_id'] = Auth::id();

            $page = Page::create($data);

            DB::commit();
            $this->deleteStoredFile($fileToDelete);

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
            [$data, $fileToDelete] = $this->preparePageData($request, $data, $page);
            $data['user_id'] = Auth::id();

            $page->update($data);

            DB::commit();
            $this->deleteStoredFile($fileToDelete);

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
            $fileToDelete = $page->file_path;

            $page->delete();

            DB::commit();
            $this->deleteStoredFile($fileToDelete);

            return redirect()->route('pages.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('pages.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    private function preparePageData(FormRequest $request, array $data, ?Page $page = null): array
    {
        $fileToDelete = null;
        $data['type'] = $data['type'] ?? Page::TYPE_TEXT;

        unset($data['file_upload']);

        if ($data['type'] === Page::TYPE_FILE) {
            $data['content_id'] = null;
            $data['content_en'] = null;
            $data['content_ar'] = null;

            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $fileToDelete = $page?->file_path;

                $data['file_path'] = $file->store('modules/pages', 'public');
                $data['file_name'] = $file->getClientOriginalName();
                $data['file_mime'] = $file->getMimeType();
                $data['file_size'] = $file->getSize();
            }

            return [$data, $fileToDelete];
        }

        $sanitizer = app(RichTextSanitizer::class);
        $data['content_id'] = $sanitizer->sanitize($data['content_id'] ?? null);
        $data['content_en'] = $sanitizer->sanitize($data['content_en'] ?? null);
        $data['content_ar'] = $sanitizer->sanitize($data['content_ar'] ?? null);

        $fileToDelete = $page?->file_path;
        $data['file_path'] = null;
        $data['file_name'] = null;
        $data['file_mime'] = null;
        $data['file_size'] = null;

        return [$data, $fileToDelete];
    }

    private function deleteStoredFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
