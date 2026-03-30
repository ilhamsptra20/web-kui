@php $isEdit = isset($agenda); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Agenda')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('agendas.update', $agenda->id) : route('agendas.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name_id' label='Name Id' :value="$agenda->name_id ?? ''" required floating divider />
        <x-form.textarea name='description_id' label='Description Id'>{{ $agenda->description_id ?? '' }}</x-form.textarea>
        <x-form.input name='location_id' label='Location Id' :value="$agenda->location_id ?? ''" floating divider />
        <x-form.datepicker name='start_date' label='Start Date' :value="$agenda->start_date ?? ''" required />
        <x-form.datepicker name='end_date' label='End Date' :value="$agenda->end_date ?? ''" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('agendas.index') }}' class='btn btn-outline-secondary'>Back</a>
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