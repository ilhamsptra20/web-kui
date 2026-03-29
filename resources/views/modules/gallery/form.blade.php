@php $isEdit = isset($gallery); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Gallery')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('galleries.update', $gallery->id) : route('galleries.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.select name='album_id' label='Album Id' required>
            <option value='' selected>Select Album Id</option>
            @foreach($albums as $item)
                <option value='{{ $item->id }}' {{ (old('album_id', $gallery->album_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='title_id' label='Title Id' :value="$gallery->title_id ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$gallery->image ?? null" required />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('galleries.index') }}' class='btn btn-outline-secondary'>Back</a>
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