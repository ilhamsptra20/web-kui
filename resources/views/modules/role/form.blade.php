@php $isEdit = isset($role); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Role')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">{{ $isEdit ? 'Edit Role' : 'Create Role' }}</h4>
            <p class="text-muted mb-0">Kelola kumpulan permission yang akan ditempel ke user.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary mt-1 mt-lg-0">Back</a>
    </div>
    <div class="card-body pt-2">
        <form action="{{ $isEdit ? route('roles.update', $role) : route('roles.store') }}" method="POST" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

            @include('modules.role.fields', ['showMode' => false])

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Data</button>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary ml-1">Back</a>
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
@endsection
