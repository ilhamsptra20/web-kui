@extends('layouts.app')
@section('title', 'Daftar Navigation')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Navigation</h4>
        <a href="{{ route('navigations.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <div class="card-body">
        <div class="alert alert-light-info">
            Module ini mengatur menu admin sidebar, marketing navbar, dan marketing footer dari database.
        </div>
        <div class="table-responsive">
            <table class="table" id="navigation-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Area</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Parent</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<x-table.datatable-script
    id="navigation-table"
    :url="route('navigations.list')"
    :columns="[
        ['data' => 'DT_RowIndex'],
        ['data' => 'title'],
        ['data' => 'area_label'],
        ['data' => 'location_label'],
        ['data' => 'type_label'],
        ['data' => 'parent_label'],
        ['data' => 'sort_order'],
        ['data' => 'status_badge'],
        ['data' => 'action'],
    ]"
    :order="[6, 'asc']"
/>
@endsection
