@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Agenda</h4>
        <a href='{{ route('agendas.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='agenda-table'>
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
<x-table.datatable-script id='agenda-table' :url="route('agendas.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'slug'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection