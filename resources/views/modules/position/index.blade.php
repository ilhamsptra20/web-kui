@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Position</h4>
        <a href='{{ route('positions.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='position-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name En</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='position-table' :url="route('positions.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'name_en'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection