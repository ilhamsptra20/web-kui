<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Support\Admin\AdminTable;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function index()
    {
        return view('modules.agenda.index');
    }
    public function list()
    {
        return datatables()
            ->of(Agenda::query()->latest('start_date'))
            ->addIndexColumn()
            ->addColumn('agenda_identity', fn (Agenda $row): string => AdminTable::stack($row->trans('name') ?: '-', $row->slug ? 'Slug: '.$row->slug : null))
            ->addColumn('schedule_label', function (Agenda $row): string {
                $date = $row->start_date?->format('d M Y') ?? '-';

                if ($row->end_date && $row->start_date?->format('d M Y') !== $row->end_date?->format('d M Y')) {
                    $date .= ' - '.$row->end_date->format('d M Y');
                }

                $time = $row->start_date?->format('H:i') ?? '-';

                if ($row->end_date) {
                    $time .= ' - '.$row->end_date->format('H:i');
                }

                return AdminTable::stack($date, $time);
            })
            ->addColumn('location_label', fn (Agenda $row): string => e($row->trans('location') ?: '-'))
            ->addColumn('status_badge', function (Agenda $row): string {
                if ($row->isOngoing()) {
                    return AdminTable::badge('Berlangsung', 'success');
                }

                if ($row->isUpcoming()) {
                    return AdminTable::badge('Akan Datang', 'primary');
                }

                return AdminTable::badge('Selesai', 'secondary');
            })
            ->addColumn('action', fn ($row) => view('modules.agenda.action', compact('row'))->render())
            ->rawColumns(['agenda_identity', 'schedule_label', 'status_badge', 'action'])
            ->toJson();
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

            $agenda = Agenda::create($data);

            DB::commit();

            return redirect()->route('agendas.show', $agenda)->with('success', 'Data created');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show(Agenda $agenda)
    {

        return view('modules.agenda.show', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {

        return view('modules.agenda.form', compact('agenda'));
    }

    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $agenda->update($data);

            DB::commit();

            return redirect()->route('agendas.show', $agenda)->with('success', 'Data updated');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy(Agenda $agenda)
    {
        DB::beginTransaction();

        try {

            $agenda->delete();

            DB::commit();

            return redirect()->route('agendas.index')->with('success', 'Data deleted');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Delete failed');
        }
    }
}
