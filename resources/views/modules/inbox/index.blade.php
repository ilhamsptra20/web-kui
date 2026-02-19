@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Inbox</h4>
        <a href='{{ route('inboxes.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='inbox-table'>
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
<x-table.datatable-script id='inbox-table' :url="route('inboxes.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'name'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection