<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function index()
    {
        return view('modules.position.index');
    }
    public function list()
    {
        return datatables()
            ->of(Position::query())
            ->addIndexColumn()

            ->addColumn('action', fn ($row) => view('modules.position.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
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

            $position = Position::create($data);

            DB::commit();

            return redirect()->route('positions.show', $position)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Position $position)
    {

        return view('modules.position.show', compact('position'));
    }

    public function edit(Position $position)
    {

        return view('modules.position.form', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $position->update($data);

            DB::commit();

            return redirect()->route('positions.show', $position)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Position $position)
    {
        DB::beginTransaction();

        try {

            $position->delete();

            DB::commit();

            return redirect()->route('positions.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}