@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Announcement</h4>
        <a href='{{ route('announcements.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='announcement-table'>
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
<x-table.datatable-script id='announcement-table' :url="route('announcements.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'title_en'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection