@extends('layouts.app')
@section('title', 'Daftar Position')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Positions</h4>
            <p class='text-muted mb-0'>Atur jabatan atau peran tim dan lihat jumlah anggota yang menggunakannya.</p>
        </div>
        <a href='{{ route('positions.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='position-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Position</th>
                        <th>Teams</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='position-table' :url="route('positions.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'position_identity','name'=>'name_id'],['data'=>'team_count','name'=>'teams_count'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
