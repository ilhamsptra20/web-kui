@php $isEdit = isset($video); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Video')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('videos.update', $video->id) : route('videos.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='title_id' label='Title Id' :value="$video->title_id ?? ''" required floating divider />
        <x-form.input name='video_url' label='Video Url' :value="$video->video_url ?? ''" required floating divider />
        <x-form.photo-upload label='Thumbnail' name='thumbnail' :value="$video->thumbnail ?? null" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('videos.index') }}' class='btn btn-outline-secondary'>Back</a>
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