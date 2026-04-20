@php $isEdit = isset($navigation); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Navigation')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header navigation-page-header">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between w-100">
            <div>
                <div class="navigation-page-kicker">{{ $isEdit ? 'Update navigation item' : 'Create navigation item' }}</div>
                <h3 class="mb-25">{{ $isEdit ? 'Edit Navigation' : 'Navigation Builder' }}</h3>
            </div>
            <div class="mt-1 mt-lg-0 d-flex">
                <a href="{{ route('navigations.index') }}" class="btn btn-outline-secondary">Back To List</a>
            </div>
        </div>
    </div>
    <div class="card-body pt-2">
        <form action="{{ $isEdit ? route('navigations.update', $navigation) : route('navigations.store') }}" method="POST" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

            @include('modules.navigation.fields', ['showMode' => false])

            <div class="mt-3 d-flex flex-wrap align-items-center">
                <button type="submit" class="btn btn-primary">Save Data</button>
                <a href="{{ route('navigations.index') }}" class="btn btn-outline-secondary ml-1">Back</a>
            </div>
        </form>
    </div>
</div>

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    });
</script>
@endif

<script>
(() => {
    const form = document.querySelector('form[novalidate]');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');

            Swal.fire({
                icon: 'warning',
                title: 'Form Tidak Lengkap',
                text: 'Harap isi semua field yang wajib diisi.',
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Oke, saya perbaiki'
            });

            return;
        }

        form.classList.add('was-validated');
    });
})();
</script>
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
