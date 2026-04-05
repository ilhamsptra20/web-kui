@extends('layouts.app')
@section('title', 'Daftar Category')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Categories</h4>
            <p class='text-muted mb-0'>Kelompokkan artikel dan pantau jumlah post yang terhubung ke tiap kategori.</p>
        </div>
        <a href='{{ route('categories.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='category-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Posts</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='category-table' :url="route('categories.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'category_identity','name'=>'title_id'],['data'=>'post_count','name'=>'posts_count'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
