<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StorePostRequest, UpdatePostRequest};
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller 
{
    protected $service;

    public function __construct(PostServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.post.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.post.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        $categories = \App\Models\Category::all();
        return view('modules.post.form', compact('categories'));
    }

    public function store(StorePostRequest $r) 
    {
        $data = $r->validated();
        $data['user_id'] = Auth::id();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/posts', 'public');
        }
        $this->service->store($data);
        return redirect()->route('posts.index');
    }

    public function edit($id) 
    { 
        $post = $this->service->find($id); 
        $categories = \App\Models\Category::all();
        return view('modules.post.form', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $r, $id) 
    {
        $data = $r->validated();
        $data['user_id'] = Auth::id();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/posts', 'public');
        }
        $this->service->update($id, $data);
        return redirect()->route('posts.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}