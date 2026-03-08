<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TeamController extends Controller
{
    public function index()
    {
        return view('modules.team.index');
    }

    public function list()
    {
        return datatables()->of(Team::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.team.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {
        $positions = \App\Models\Position::query()->orderBy('name_id')->get();

        return view('modules.team.form', compact('positions'));
    }

    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/teams','public');
                }

            Team::create($data);
            DB::commit();
            return redirect()->route('teams.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Team store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $team = Team::findOrFail($id);
        $positions = \App\Models\Position::query()->orderBy('name_id')->get();

            return view('modules.team.form', compact('team','positions'));
        } catch(\Throwable $e) {
            Log::warning('Team edit error',['id'=>$id]);
            return redirect()->route('teams.index')->with('error','Data not found');
        }
    }

    public function update(UpdateTeamRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

                if($request->hasFile('image')){
                    $data['image'] = $request->file('image')->store('modules/teams','public');
                }

            $team = Team::findOrFail($id);
            $team->update($data);
            DB::commit();
            return redirect()->route('teams.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Team update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $team = Team::findOrFail($id);
            $team->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Team delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}