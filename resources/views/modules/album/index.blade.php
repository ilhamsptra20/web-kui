@extends('layouts.app')
@section('title', 'Daftar Album')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Albums</h4>
            <p class='text-muted mb-0'>Kelola album galeri beserta cover dan jumlah item yang ada di dalamnya.</p>
        </div>
        <a href='{{ route('albums.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='album-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Album</th>
                        <th>Gallery</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='album-table' :url="route('albums.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'album_identity','name'=>'name_id'],['data'=>'gallery_count','name'=>'galleries_count'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
