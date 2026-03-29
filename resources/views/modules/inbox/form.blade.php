@php $isEdit = isset($inbox); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Inbox')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('inboxes.update', $inbox->id) : route('inboxes.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name' label='Name' :value="$inbox->name ?? ''" required floating divider />
        <x-form.input name='email' label='Email' :value="$inbox->email ?? ''" required floating divider />
        <x-form.input name='subject' label='Subject' :value="$inbox->subject ?? ''" floating divider />
        <x-form.textarea name='message' label='Message' required>{{ $inbox->message ?? '' }}</x-form.textarea>
        <x-form.switch name='is_read' label='Is Read' :checked="$inbox->is_read ?? false" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('inboxes.index') }}' class='btn btn-outline-secondary'>Back</a>
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