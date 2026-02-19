@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Team</h4>
        <a href='{{ route('teams.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='team-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='team-table' :url="route('teams.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'name'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection