@php $isEdit = isset($position); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Position')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('positions.update', $position->id) : route('positions.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name_id' label='Name Id' :value="$position->name_id ?? ''" required floating divider />
        <x-form.input name='name_en' label='Name En' :value="$position->name_en ?? ''" floating divider />
        <x-form.input name='name_ar' label='Name Ar' :value="$position->name_ar ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('positions.index') }}' class='btn btn-outline-secondary'>Back</a>
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
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
            Swal.fire({
                icon: 'warning',
                title: 'Form Tidak Lengkap',
                text: 'Harap isi semua field yang wajib diisi.',
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Oke, saya perbaiki'
            });
        } else {
            form.classList.add('was-validated');
        }
    });
})();
</script>
@endsection