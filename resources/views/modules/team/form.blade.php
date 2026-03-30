@php $isEdit = isset($team); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Team')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('teams.update', $team->id) : route('teams.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.select name='position_id' label='Position Id' required>
            <option value='' selected>Select Position Id</option>
            @foreach($positions as $item)
                <option value='{{ $item->id }}' {{ (old('position_id', $team->position_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='npp' label='Npp' :value="$team->npp ?? ''" floating divider />
        <x-form.input name='name' label='Name' :value="$team->name ?? ''" required floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$team->image ?? null" required />
        <x-form.textarea name='bio_id' label='Bio Id'>{{ $team->bio_id ?? '' }}</x-form.textarea>

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('teams.index') }}' class='btn btn-outline-secondary'>Back</a>
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