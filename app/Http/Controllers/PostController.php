<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Support\RichText\RichTextSanitizer;

class PostController extends Controller
{
    public function index()
    {
        return view('modules.post.index');
    }
    public function list()
    {
        return datatables()
            ->of(Post::query()->with(['category', 'user'])->latest())
            ->addIndexColumn()
            ->addColumn('post_identity', fn (Post $row): string => AdminTable::image(\App\Models\Setting::resolveImageUrl($row->image), $row->trans('title') ?: '-', $row->slug ? 'Slug: '.$row->slug : null))
            ->addColumn('category_label', fn (Post $row): string => e($row->category?->trans('title') ?: '-'))
            ->addColumn('status_badge', fn (Post $row): string => AdminTable::badge($row->status === 'published' ? 'Published' : 'Draft', $row->status === 'published' ? 'success' : 'secondary'))
            ->addColumn('author_label', fn (Post $row): string => e($row->user?->name ?: '-'))
            ->addColumn('updated_at_label', fn (Post $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.post.action', compact('row'))->render())
            ->rawColumns(['post_identity', 'status_badge', 'updated_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {
        $categories = \App\Models\Category::query()->latest()->get();
        return view('modules.post.form', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $sanitizer = app(RichTextSanitizer::class);
            $data['content_id'] = $sanitizer->sanitize($data['content_id'] ?? null);
            $data['content_en'] = $sanitizer->sanitize($data['content_en'] ?? null);
            $data['content_ar'] = $sanitizer->sanitize($data['content_ar'] ?? null);
            $data['user_id'] = Auth::id();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/posts', 'public');
            }

            $post = Post::create($data);

            DB::commit();

            return redirect()->route('posts.show', $post)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Post $post)
    {
        $categories = \App\Models\Category::query()->latest()->get();
        return view('modules.post.show', compact('post', 'categories'));
    }

    public function edit(Post $post)
    {
        $categories = \App\Models\Category::query()->latest()->get();
        return view('modules.post.form', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $sanitizer = app(RichTextSanitizer::class);
            $data['content_id'] = $sanitizer->sanitize($data['content_id'] ?? null);
            $data['content_en'] = $sanitizer->sanitize($data['content_en'] ?? null);
            $data['content_ar'] = $sanitizer->sanitize($data['content_ar'] ?? null);
            $data['user_id'] = Auth::id();
            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }

                $data['image'] = $request->file('image')->store('modules/posts', 'public');
            }

            $post->update($data);

            DB::commit();

            return redirect()->route('posts.show', $post)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Post $post)
    {
        DB::beginTransaction();

        try {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $post->delete();

            DB::commit();

            return redirect()->route('posts.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}
