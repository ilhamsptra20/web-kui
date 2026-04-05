@extends('layouts.app')
@section('title', 'Daftar Role')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">Manage Roles</h4>
            <p class="text-muted mb-0">Atur kumpulan permission dan tempelkan ke user melalui role.</p>
        </div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary mt-1 mt-lg-0">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="role-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Users</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<x-table.datatable-script
    id="role-table"
    :url="route('roles.list')"
    :columns="[
        ['data' => 'DT_RowIndex'],
        ['data' => 'role_identity'],
        ['data' => 'status_badge'],
        ['data' => 'user_count'],
        ['data' => 'permission_count'],
        ['data' => 'action'],
    ]"
    :order="[1, 'asc']"
/>
@endsection
