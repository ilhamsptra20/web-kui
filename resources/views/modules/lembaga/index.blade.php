@extends('layouts.app')
@section('title', 'Daftar Lembaga')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Lembaga</h4>
            <p class='text-muted mb-0'>Kelola profil mitra, institusi, atau lembaga yang terhubung dengan KUI.</p>
        </div>
        <a href='{{ route('lembagas.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='lembaga-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lembaga</th>
                        <th>Deskripsi</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='lembaga-table' :url="route('lembagas.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'lembaga_identity','name'=>'name_id'],['data'=>'description_preview','name'=>'description_id'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
