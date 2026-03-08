<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Http\Requests\StoreLembagaRequest;
use App\Http\Requests\UpdateLembagaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class LembagaController extends Controller
{
    public function index()
    {
        return view('modules.lembaga.index');
    }

    public function list()
    {
        return datatables()->of(Lembaga::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.lembaga.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.lembaga.form');
    }

    public function store(StoreLembagaRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/lembagas','public');
                }

            Lembaga::create($data);
            DB::commit();
            return redirect()->route('lembagas.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Lembaga store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $lembaga = Lembaga::findOrFail($id);

            return view('modules.lembaga.form', compact('lembaga'));
        } catch(\Throwable $e) {
            Log::warning('Lembaga edit error',['id'=>$id]);
            return redirect()->route('lembagas.index')->with('error','Data not found');
        }
    }

    public function update(UpdateLembagaRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/lembagas','public');
                }

            $lembaga = Lembaga::findOrFail($id);
            $lembaga->update($data);
            DB::commit();
            return redirect()->route('lembagas.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Lembaga update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $lembaga = Lembaga::findOrFail($id);
            $lembaga->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Lembaga delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}