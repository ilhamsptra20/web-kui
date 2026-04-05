@extends('layouts.app')
@section('title', 'Daftar Announcement')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Announcements</h4>
            <p class='text-muted mb-0'>Tinjau pengumuman aktif, lampiran, dan waktu update sebelum tampil ke publik.</p>
        </div>
        <a href='{{ route('announcements.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='announcement-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Announcement</th>
                        <th>Status</th>
                        <th>Lampiran</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='announcement-table' :url="route('announcements.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'announcement_identity','name'=>'title_id'],['data'=>'status_badge','name'=>'is_active'],['data'=>'attachment_badge','orderable'=>false,'searchable'=>false],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[4, 'desc']]" />
@endsection
