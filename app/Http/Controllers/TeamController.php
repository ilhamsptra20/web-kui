<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreTeamRequest, UpdateTeamRequest};
use App\Services\Contracts\TeamServiceInterface;


class TeamController extends Controller 
{
    protected $service;

    public function __construct(TeamServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.team.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.team.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        $positions = \App\Models\Position::all();
        return view('modules.team.form', compact('positions'));
    }

    public function store(StoreTeamRequest $r) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/teams', 'public');
        }
        $this->service->store($data);
        return redirect()->route('teams.index');
    }

    public function edit($id) 
    { 
        $team = $this->service->find($id); 
        $positions = \App\Models\Position::all();
        return view('modules.team.form', compact('team', 'positions'));
    }

    public function update(UpdateTeamRequest $r, $id) 
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('modules/teams', 'public');
        }
        $this->service->update($id, $data);
        return redirect()->route('teams.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}