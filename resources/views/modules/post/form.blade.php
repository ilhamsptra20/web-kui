@php $isEdit = isset($post); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('posts.update', $post->id) : route('posts.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.select name='category_id' label='Category Id'>
            <option value='' required selected>Select Category Id</option>
            @foreach($categories as $item)
                <option value='{{ $item->id }}' {{ (old('category_id', $post->category_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='title_id' label='Title Id' :value="$post->title_id ?? ''" floating divider />
        <x-form.input name='title_en' label='Title En' :value="$post->title_en ?? ''" floating divider />
        <x-form.input name='title_ar' label='Title Ar' :value="$post->title_ar ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$post->image ?? null" rounded='circle' />
        <x-form.textarea name='content_id' label='Content Id'>{{ $post->content_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_en' label='Content En'>{{ $post->content_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_ar' label='Content Ar'>{{ $post->content_ar ?? '' }}</x-form.textarea>
        <x-form.input name='status' label='Status' :value="$post->status ?? ''" floating divider />
        <x-form.input name='meta_title' label='Meta Title' :value="$post->meta_title ?? ''" floating divider />
        <x-form.input name='meta_description' label='Meta Description' :value="$post->meta_description ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('posts.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection