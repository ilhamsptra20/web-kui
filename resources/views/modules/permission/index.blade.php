@extends('layouts.app')
@section('title', 'Daftar Permission')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">Manage Permissions</h4>
            <p class="text-muted mb-0">Kelola kunci akses per module. Role akan menarik permission dari sini.</p>
        </div>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary mt-1 mt-lg-0">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="permission-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Permission</th>
                        <th>Group</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<x-table.datatable-script
    id="permission-table"
    :url="route('permissions.list')"
    :columns="[
        ['data' => 'DT_RowIndex'],
        ['data' => 'permission_identity'],
        ['data' => 'group_badge'],
        ['data' => 'status_badge'],
        ['data' => 'role_count'],
        ['data' => 'action'],
    ]"
    :order="[2, 'asc']"
/>
@endsection
