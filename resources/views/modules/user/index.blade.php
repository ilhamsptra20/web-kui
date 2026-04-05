@extends('layouts.app')
@section('title', 'Daftar User')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">Manage User</h4>
            <p class="text-muted mb-0">Buat, lihat, ubah, dan hapus akun internal yang bisa masuk ke panel admin.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary mt-1 mt-lg-0">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<x-table.datatable-script
    id="user-table"
    :url="route('users.list')"
    :columns="[
        ['data' => 'DT_RowIndex'],
        ['data' => 'user_identity'],
        ['data' => 'roles_badge'],
        ['data' => 'verified_badge'],
        ['data' => 'joined_at'],
        ['data' => 'action'],
    ]"
    :order="[4, 'desc']"
/>
@endsection
