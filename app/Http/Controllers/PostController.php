<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('modules.post.index');
    }

    public function list()
    {
        return datatables()->of(Post::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.post.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {
        $categories = \App\Models\Category::query()->orderBy('title')->get();

        return view('modules.post.form', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
                $data['user_id'] = Auth::id();
                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/posts','public');
                }

            Post::create($data);
            DB::commit();
            return redirect()->route('posts.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Post store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
        $categories = \App\Models\Category::query()->orderBy('title')->get();

            return view('modules.post.form', compact('post','categories'));
        } catch(\Throwable $e) {
            Log::warning('Post edit error',['id'=>$id]);
            return redirect()->route('posts.index')->with('error','Data not found');
        }
    }

    public function update(UpdatePostRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
                $data['user_id'] = Auth::id();
                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/posts','public');
                }

            $post = Post::findOrFail($id);
            $post->update($data);
            DB::commit();
            return redirect()->route('posts.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Post update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Post delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}