@extends('layouts.app')
@section('title', 'Detail Navigation')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header navigation-page-header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
            <div>
                <div class="navigation-page-kicker">Inspect navigation item</div>
                <h3 class="mb-25">Detail Navigation</h3>
                <p class="mb-0 text-muted">Lihat konteks penempatan menu dan preview tampilannya sebelum lo ubah.</p>
            </div>
            <div class="mt-1 mt-lg-0 d-flex">
                <a href="{{ route('navigations.edit', $navigation) }}" class="btn btn-primary mr-1">Edit</a>
                <a href="{{ route('navigations.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body pt-2">
        @include('modules.navigation.fields', ['showMode' => true])
    </div>
</div>
@endsection

@push('styles')
    <style>
        .navigation-page-header {
            background:
                radial-gradient(circle at top right, rgba(115, 103, 240, .14), transparent 36%),
                linear-gradient(180deg, rgba(115, 103, 240, .04), rgba(115, 103, 240, 0));
            border-bottom: 1px solid rgba(115, 103, 240, .08);
        }

        .navigation-page-kicker {
            display: inline-block;
            margin-bottom: .55rem;
            padding: .35rem .65rem;
            border-radius: 999px;
            background: rgba(115, 103, 240, .12);
            color: #7367f0;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }
    </style>
@endpush
