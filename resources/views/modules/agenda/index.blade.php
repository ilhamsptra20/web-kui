@extends('layouts.app')
@section('title', 'Daftar Agenda')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Agenda</h4>
            <p class='text-muted mb-0'>Pantau jadwal kegiatan, lokasi, dan status agenda yang tampil di website.</p>
        </div>
        <a href='{{ route('agendas.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='agenda-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Agenda</th>
                        <th>Jadwal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='agenda-table' :url="route('agendas.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'agenda_identity','name'=>'name_id'],['data'=>'schedule_label','name'=>'start_date'],['data'=>'location_label','name'=>'location_id'],['data'=>'status_badge','orderable'=>false,'searchable'=>false],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[2, 'desc']]" />
@endsection
