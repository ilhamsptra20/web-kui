@php $isEdit = isset($slider); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Slider')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('sliders.update', $slider->id) : route('sliders.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='subtitle_id' label='Subtitle Id' :value="$slider->subtitle_id ?? ''" floating divider />
        <x-form.input name='subtitle_en' label='Subtitle En' :value="$slider->subtitle_en ?? ''" floating divider />
        <x-form.input name='subtitle_ar' label='Subtitle Ar' :value="$slider->subtitle_ar ?? ''" floating divider />
        <x-form.input name='title_id' label='Title Id' :value="$slider->title_id ?? ''" floating divider />
        <x-form.input name='title_en' label='Title En' :value="$slider->title_en ?? ''" floating divider />
        <x-form.input name='title_ar' label='Title Ar' :value="$slider->title_ar ?? ''" floating divider />
        <x-form.input name='description_id' label='Description Id' :value="$slider->description_id ?? ''" floating divider />
        <x-form.input name='description_en' label='Description En' :value="$slider->description_en ?? ''" floating divider />
        <x-form.input name='description_ar' label='Description Ar' :value="$slider->description_ar ?? ''" floating divider />
        <x-form.input name='btn_text_id' label='Btn Text Id' :value="$slider->btn_text_id ?? ''" floating divider />
        <x-form.input name='btn_text_en' label='Btn Text En' :value="$slider->btn_text_en ?? ''" floating divider />
        <x-form.input name='btn_text_ar' label='Btn Text Ar' :value="$slider->btn_text_ar ?? ''" floating divider />
        <x-form.input name='btn_url' label='Btn Url' :value="$slider->btn_url ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$slider->image ?? null" required />
        <x-form.input name='order' label='Order' :value="$slider->order ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('sliders.index') }}' class='btn btn-outline-secondary'>Back</a>
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