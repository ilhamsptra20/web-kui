@extends('layouts.app')
@section('title', 'Daftar Video')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Videos</h4>
            <p class='text-muted mb-0'>Lihat thumbnail video, judul, dan tautan sumber tanpa harus buka edit form.</p>
        </div>
        <a href='{{ route('videos.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='video-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Video</th>
                        <th>Link</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='video-table' :url="route('videos.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'video_identity','name'=>'title_id'],['data'=>'video_link','name'=>'video_url'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
