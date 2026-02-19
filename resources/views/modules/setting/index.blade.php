@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Setting</h4>
        <a href='{{ route('settings.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='setting-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Key</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='setting-table' :url="route('settings.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'key'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection