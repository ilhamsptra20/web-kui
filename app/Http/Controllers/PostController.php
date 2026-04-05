<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
            ->of(Post::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.post.action', compact('row'))->render())
            ->rawColumns(['action'])
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