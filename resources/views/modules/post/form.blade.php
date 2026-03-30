@php $isEdit = isset($post); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Post')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('posts.update', $post->id) : route('posts.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.select name='category_id' label='Category Id' required>
            <option value='' selected>Select Category Id</option>
            @foreach($categories as $item)
                <option value='{{ $item->id }}' {{ (old('category_id', $post->category_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item->trans('title') }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='title_id' label='Title Id' :value="$post->title_id ?? ''" required floating divider />
        <x-form.input name='title_en' label='Title En' :value="$post->title_en ?? ''" floating divider />
        <x-form.input name='title_ar' label='Title Ar' :value="$post->title_ar ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$post->image ?? null" />
        <x-form.textarea name='content_id' label='Content Id' required>{{ $post->content_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_en' label='Content En'>{{ $post->content_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_ar' label='Content Ar'>{{ $post->content_ar ?? '' }}</x-form.textarea>
        <label class='form-label'>Status</label>
        <div class='d-flex gap-3'>
            @foreach(["draft","published"] as $opt)
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='status' value='{{ $opt }}'
                        {{ old('status', $post->status ?? '') == $opt ? 'checked' : '' }}>
                    <label class='form-check-label'>{{ ucfirst($opt) }}</label>
                </div>
            @endforeach
        </div>
        <x-form.input name='meta_title' label='Meta Title' :value="$post->meta_title ?? ''" floating divider />
        <x-form.input name='meta_description' label='Meta Description' :value="$post->meta_description ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('posts.index') }}' class='btn btn-outline-secondary'>Back</a>
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