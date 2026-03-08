<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AgendaController extends Controller
{
    public function index()
    {
        return view('modules.agenda.index');
    }

    public function list()
    {
        return datatables()->of(Agenda::query())->addIndexColumn()->addColumn('action', fn($row)=>view('modules.agenda.action',compact('row'))->render())->rawColumns(['action'])->toJson();
    }

    public function create()
    {

        return view('modules.agenda.form');
    }

    public function store(StoreAgendaRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            Agenda::create($data);
            DB::commit();
            return redirect()->route('agendas.index')->with('success','Data created');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Agenda store error',['message'=>$e->getMessage(),'data'=>$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit($id)
    {
        try {
            $agenda = Agenda::findOrFail($id);

            return view('modules.agenda.form', compact('agenda'));
        } catch(\Throwable $e) {
            Log::warning('Agenda edit error',['id'=>$id]);
            return redirect()->route('agendas.index')->with('error','Data not found');
        }
    }

    public function update(UpdateAgendaRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();


            $agenda = Agenda::findOrFail($id);
            $agenda->update($data);
            DB::commit();
            return redirect()->route('agendas.index')->with('success','Data updated');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Agenda update error',['id'=>$id,'message'=>$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable $e) {
            DB::rollBack();
            Log::error('Agenda delete error',['id'=>$id]);
            return back()->with('error','Delete failed');
        }
    }
}