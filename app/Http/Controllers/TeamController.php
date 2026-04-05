<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        return view('modules.team.index');
    }
    public function list()
    {
        return datatables()
            ->of(Team::query()->with('position')->latest())
            ->addIndexColumn()
            ->addColumn('team_identity', fn (Team $row): string => AdminTable::image(\App\Models\Setting::resolveImageUrl($row->image), $row->name ?: '-', $row->npp ? 'NPP: '.$row->npp : null))
            ->addColumn('position_label', fn (Team $row): string => e($row->position?->trans('name') ?: '-'))
            ->addColumn('updated_at_label', fn (Team $row): string => AdminTable::dateTime($row->updated_at))
            ->addColumn('action', fn ($row) => view('modules.team.action', compact('row'))->render())
            ->rawColumns(['team_identity', 'updated_at_label', 'action'])
            ->toJson();
    }

    public function create()
    {
        $positions = \App\Models\Position::query()->latest()->get();
        return view('modules.team.form', compact('positions'));
    }

    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('modules/teams', 'public');
            }

            $team = Team::create($data);

            DB::commit();

            return redirect()->route('teams.show', $team)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Team $team)
    {
        $positions = \App\Models\Position::query()->latest()->get();
        return view('modules.team.show', compact('team', 'positions'));
    }

    public function edit(Team $team)
    {
        $positions = \App\Models\Position::query()->latest()->get();
        return view('modules.team.form', compact('team', 'positions'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                if ($team->image) {
                    Storage::disk('public')->delete($team->image);
                }

                $data['image'] = $request->file('image')->store('modules/teams', 'public');
            }

            $team->update($data);

            DB::commit();

            return redirect()->route('teams.show', $team)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Team $team)
    {
        DB::beginTransaction();

        try {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }

            $team->delete();

            DB::commit();

            return redirect()->route('teams.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}
