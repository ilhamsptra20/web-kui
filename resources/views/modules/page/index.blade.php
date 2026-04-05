@extends('layouts.app')
@section('title', 'Daftar Page')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Pages</h4>
            <p class='text-muted mb-0'>Kelola halaman statis, slug, status publish, dan author yang terakhir mengubahnya.</p>
        </div>
        <a href='{{ route('pages.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='page-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Page</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='page-table' :url="route('pages.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'page_identity','name'=>'title_id'],['data'=>'author_label','orderable'=>false,'searchable'=>false],['data'=>'status_badge','name'=>'status'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[4, 'desc']]" />
@endsection
