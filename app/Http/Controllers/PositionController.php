<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PositionController extends Controller
{
    public function index()
    {
        return view('modules.position.index');
    }

    public function list()
    {
        return datatables()->of(Position::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.position.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.position.form');
    }

    public function store(StorePositionRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            Position::create($data);
            DB::commit();
            return redirect()->route('positions.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Position store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $position = Position::findOrFail($id);

            return view('modules.position.form', compact('position'));
        } catch(\Throwable $e) {
            Log::warning('Position edit error',['id'=>$id]);
            return redirect()->route('positions.index')->with('error','Data not found');
        }
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $position = Position::findOrFail($id);
            $position->update($data);
            DB::commit();
            return redirect()->route('positions.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Position update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $position = Position::findOrFail($id);
            $position->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Position delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}