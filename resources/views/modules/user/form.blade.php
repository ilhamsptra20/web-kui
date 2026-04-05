@php $isEdit = isset($user); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' User')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">{{ $isEdit ? 'Edit User' : 'Create User' }}</h4>
            <p class="text-muted mb-0">Kelola akun administrator dan operator internal dari panel ini.</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mt-1 mt-lg-0">Back</a>
    </div>
    <div class="card-body pt-2">
        <form action="{{ $isEdit ? route('users.update', $user) : route('users.store') }}" method="POST" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

            @include('modules.user.fields', ['showMode' => false])

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Data</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary ml-1">Back</a>
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
