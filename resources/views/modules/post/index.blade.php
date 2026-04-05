@extends('layouts.app')
@section('title', 'Daftar Post')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Posts</h4>
            <p class='text-muted mb-0'>Pantau artikel, kategori, author, dan status publish dari panel admin.</p>
        </div>
        <a href='{{ route('posts.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='post-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Post</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='post-table' :url="route('posts.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'post_identity','name'=>'title_id'],['data'=>'category_label','orderable'=>false,'searchable'=>false],['data'=>'status_badge','name'=>'status'],['data'=>'author_label','orderable'=>false,'searchable'=>false],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[5, 'desc']]" />
@endsection
