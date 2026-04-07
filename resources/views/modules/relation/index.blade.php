@extends('layouts.app')
@section('title', 'Daftar Relation')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Relation</h4>
            <p class='text-muted mb-0'>Kelola data Relation dari panel admin dengan ringkasan yang lebih informatif.</p>
        </div>
        <a href='{{ route('relations.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='relation-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='relation-table' :url="route('relations.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'record_identity','name'=>'title'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[2, 'desc']]" />
@endsection