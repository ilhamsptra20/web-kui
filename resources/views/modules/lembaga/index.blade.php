@extends('layouts.app')
@section('title', 'Daftar Lembaga')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Lembaga</h4>
        <a href='{{ route('lembagas.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='lembaga-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='lembaga-table' :url="route('lembagas.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'slug'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection