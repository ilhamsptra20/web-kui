@extends('layouts.app')
@section('title', 'Daftar Video')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Video</h4>
        <a href='{{ route('videos.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='video-table'>
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
<x-table.datatable-script id='video-table' :url="route('videos.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'title_en'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection