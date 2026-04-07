<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use App\Http\Requests\StoreRelationRequest;
use App\Http\Requests\UpdateRelationRequest;
use Illuminate\Support\Facades\DB;
use App\Support\Admin\AdminTable;

class RelationController extends Controller
{
    public function index()
    {
        return view('modules.relation.index');
    }
    public function list()
    {
        return datatables()
            ->of(Relation::query()->latest())
            ->addIndexColumn()
            ->addColumn('record_identity', fn ($row) => AdminTable::stack($row->title ?: '-', null))

            ->addColumn('updated_at_label', fn ($row) => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.relation.action', compact('row'))->render())
            ->rawColumns(['record_identity', 'updated_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {

        return view('modules.relation.form');
    }

    public function store(StoreRelationRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $relation = Relation::create($data);

            DB::commit();

            return redirect()->route('relations.show', $relation)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Relation $relation)
    {

        return view('modules.relation.show', compact('relation'));
    }

    public function edit(Relation $relation)
    {

        return view('modules.relation.form', compact('relation'));
    }

    public function update(UpdateRelationRequest $request, Relation $relation)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $relation->update($data);

            DB::commit();

            return redirect()->route('relations.show', $relation)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Relation $relation)
    {
        DB::beginTransaction();

        try {

            $relation->delete();

            DB::commit();

            return redirect()->route('relations.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}