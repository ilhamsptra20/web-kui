@php $isEdit = isset($announcement); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Announcement')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('announcements.update', $announcement->id) : route('announcements.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='title_id' label='Title Id' :value="$announcement->title_id ?? ''" required floating divider />
        <x-form.input name='title_en' label='Title En' :value="$announcement->title_en ?? ''" floating divider />
        <x-form.textarea name='content_id' label='Content Id' required>{{ $announcement->content_id ?? '' }}</x-form.textarea>
        <x-form.input name='file_path' label='File Path' :value="$announcement->file_path ?? ''" floating divider />
        <x-form.switch name='is_active' label='Is Active' :checked="$announcement->is_active ?? false" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('announcements.index') }}' class='btn btn-outline-secondary'>Back</a>
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