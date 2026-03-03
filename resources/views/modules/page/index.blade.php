@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Page</h4>
        <a href='{{ route('pages.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='page-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title En</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='page-table' :url="route('pages.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'title_en'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection