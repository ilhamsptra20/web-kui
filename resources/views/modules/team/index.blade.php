@extends('layouts.app')
@section('title', 'Daftar Team')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Team</h4>
            <p class='text-muted mb-0'>Tampilkan anggota tim, posisi jabatan, foto, dan identitas internal secara lebih jelas.</p>
        </div>
        <a href='{{ route('teams.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='team-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Team</th>
                        <th>Position</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='team-table' :url="route('teams.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'team_identity','name'=>'name'],['data'=>'position_label','orderable'=>false,'searchable'=>false],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
