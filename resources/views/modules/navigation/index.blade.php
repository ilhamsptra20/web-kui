@extends('layouts.app')
@section('title', 'Daftar Navigation')

@section('content')
<div class="row match-height mb-2">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card navigation-stat-card border-0">
            <div class="card-body">
                <span class="navigation-stat-label">Total Menu</span>
                <h2 class="mb-25">{{ number_format($stats['total'] ?? 0) }}</h2>
                <small class="text-muted">Semua item navigasi</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card navigation-stat-card border-0 navigation-stat-card-admin">
            <div class="card-body">
                <span class="navigation-stat-label">Admin</span>
                <h2 class="mb-25">{{ number_format($stats['admin'] ?? 0) }}</h2>
                <small class="text-muted">Sidebar internal</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card navigation-stat-card border-0 navigation-stat-card-marketing">
            <div class="card-body">
                <span class="navigation-stat-label">Marketing</span>
                <h2 class="mb-25">{{ number_format($stats['marketing'] ?? 0) }}</h2>
                <small class="text-muted">Navbar dan footer</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="card navigation-stat-card border-0 navigation-stat-card-active">
            <div class="card-body">
                <span class="navigation-stat-label">Active</span>
                <h2 class="mb-25">{{ number_format($stats['active'] ?? 0) }}</h2>
                <small class="text-muted">Item yang tampil</small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">Navigation Builder</h4>
            <p class="text-muted mb-0">Kelola sidebar admin, navbar marketing, dan footer marketing dari satu tempat.</p>
        </div>
        <a href="{{ route('navigations.create') }}" class="btn btn-primary mt-1 mt-md-0">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="navigation-table">
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
        ['data' => 'area_badge'],
        ['data' => 'location_badge'],
        ['data' => 'type_badge'],
        ['data' => 'parent_label'],
        ['data' => 'sort_order'],
        ['data' => 'status_badge'],
        ['data' => 'action'],
    ]"
    :order="[6, 'asc']"
/>
@endsection

@push('styles')
    <style>
        .navigation-stat-card {
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
            border-radius: 18px;
        }

        .navigation-stat-card .card-body {
            padding: 1.35rem 1.4rem;
        }

        .navigation-stat-label {
            display: inline-block;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6c757d;
            margin-bottom: .55rem;
        }

        .navigation-stat-card-admin {
            background: linear-gradient(135deg, rgba(115, 103, 240, .08), rgba(115, 103, 240, .18));
        }

        .navigation-stat-card-marketing {
            background: linear-gradient(135deg, rgba(40, 199, 111, .08), rgba(40, 199, 111, .18));
        }

        .navigation-stat-card-active {
            background: linear-gradient(135deg, rgba(255, 159, 67, .08), rgba(255, 159, 67, .18));
        }

        .navigation-list-icon {
            min-width: 1.25rem;
            color: #7367f0;
        }
    </style>
@endpush
