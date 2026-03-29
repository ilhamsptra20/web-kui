<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('modules.page.index');
    }

    public function list()
    {
        return datatables()->of(Page::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.page.action',compact('row'))->render())->rawColumns(['action'])->toJson();
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
                $data['user_id'] = Auth::id();

            Page::create($data);
            DB::commit();
            return redirect()->route('pages.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Page store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $page = Page::findOrFail($id);

            return view('modules.page.form', compact('page'));
        } catch(\Throwable $e) {
            Log::warning('Page edit error',['id'=>$id]);
            return redirect()->route('pages.index')->with('error','Data not found');
        }
    }

    public function update(UpdatePageRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
                $data['user_id'] = Auth::id();

            $page = Page::findOrFail($id);
            $page->update($data);
            DB::commit();
            return redirect()->route('pages.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Page update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $page = Page::findOrFail($id);
            $page->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Page delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}