<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreAgendaRequest, UpdateAgendaRequest};
use App\Services\Contracts\AgendaServiceInterface;


class AgendaController extends Controller 
{
    protected $service;

    public function __construct(AgendaServiceInterface $service) 
    { 
        $this->service = $service; 
    }

    public function index() 
    { 
        return view('modules.agenda.index'); 
    }

    public function list() 
    {
        return datatables()->of($this->service->listTable())->addIndexColumn()
            ->addColumn('action', fn($row) => view('modules.agenda.action', compact('row'))->render())
            ->rawColumns(['action'])->toJson();
    }

    public function create() 
    { 
        return view('modules.agenda.form');
    }

    public function store(StoreAgendaRequest $r) 
    {
        $data = $r->validated();
        $this->service->store($data);
        return redirect()->route('agendas.index');
    }

    public function edit($id) 
    { 
        $agenda = $this->service->find($id); 
        return view('modules.agenda.form', compact('agenda'));
    }

    public function update(UpdateAgendaRequest $r, $id) 
    {
        $data = $r->validated();
        $this->service->update($id, $data);
        return redirect()->route('agendas.index');
    }

    public function destroy($id) 
    { 
        $this->service->delete($id); 
        return back(); 
    }
}