@extends('layouts.app')
@section('title', 'Daftar Gallery')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Gallery</h4>
            <p class='text-muted mb-0'>Lihat preview gambar, album induk, dan update terakhir untuk tiap item galeri.</p>
        </div>
        <a href='{{ route('galleries.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='gallery-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gallery</th>
                        <th>Album</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='gallery-table' :url="route('galleries.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'gallery_identity','name'=>'title_id'],['data'=>'album_label','orderable'=>false,'searchable'=>false],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
