@extends('layouts.app')
@section('title', 'Daftar Inbox')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Inbox</h4>
            <p class='text-muted mb-0'>Tinjau pesan masuk, status baca, dan identitas pengirim dari form kontak.</p>
        </div>
        <a href='{{ route('inboxes.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='inbox-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengirim</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Diterima</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='inbox-table' :url="route('inboxes.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'sender_identity','name'=>'name'],['data'=>'message_preview','name'=>'subject'],['data'=>'status_badge','name'=>'is_read'],['data'=>'received_at_label','name'=>'created_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[4, 'desc']]" />
@endsection
