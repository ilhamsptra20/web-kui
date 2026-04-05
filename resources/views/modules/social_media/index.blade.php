@extends('layouts.app')
@section('title', 'Daftar SocialMedia')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Social Media</h4>
            <p class='text-muted mb-0'>Kelola kanal sosial resmi KUI beserta icon class dan tautannya.</p>
        </div>
        <a href='{{ route('social_media.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='social_media-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Platform</th>
                        <th>Link</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='social_media-table' :url="route('social_media.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'social_identity','name'=>'name'],['data'=>'link_label','name'=>'link'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'desc']]" />
@endsection
