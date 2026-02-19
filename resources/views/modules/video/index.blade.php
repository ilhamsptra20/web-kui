@extends('layouts.app')

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
                        <th>Video Url</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='video-table' :url="route('videos.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'video_url'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection