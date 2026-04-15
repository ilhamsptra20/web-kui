<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Http\Requests\StoreLembagaRequest;
use App\Http\Requests\UpdateLembagaRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LembagaController extends Controller
{
    public function index()
    {
        return view('modules.lembaga.index');
    }
    public function list()
    {
        return datatables()
            ->of(Lembaga::query()->latest())
            ->addIndexColumn()
            ->addColumn('lembaga_identity', fn (Lembaga $row): string => AdminTable::image(\App\Models\Setting::resolveImageUrl($row->image), $row->trans('name') ?: '-', $row->slug ? 'Slug: '.$row->slug : null))
            ->addColumn('description_preview', fn (Lembaga $row): string => AdminTable::limit(strip_tags($row->trans('description') ?: ''), 90))
            ->addColumn('updated_at_label', fn (Lembaga $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.lembaga.action', compact('row'))->render())
            ->rawColumns(['lembaga_identity', 'updated_at_label', 'action'])
            ->toJson();
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
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/lembagas', 'public');
            }

            $lembaga = Lembaga::create($data);

            DB::commit();

            return redirect()->route('lembagas.show', $lembaga)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Lembaga $lembaga)
    {

        return view('modules.lembaga.show', compact('lembaga'));
    }

    public function edit(Lembaga $lembaga)
    {

        return view('modules.lembaga.form', compact('lembaga'));
    }

    public function update(UpdateLembagaRequest $request, Lembaga $lembaga)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($lembaga->image) {
                    Storage::disk('public')->delete($lembaga->image);
                }

                $data['image'] = $request->file('image')->store('modules/lembagas', 'public');
            }

            $lembaga->update($data);

            DB::commit();

            return redirect()->route('lembagas.show', $lembaga)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Lembaga $lembaga)
    {
        DB::beginTransaction();

        try {
            if ($lembaga->image) {
                Storage::disk('public')->delete($lembaga->image);
            }

            $lembaga->delete();

            DB::commit();

            return redirect()->route('lembagas.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return redirect()->route('lembagas.index')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
