@php $isEdit = isset($gallery); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('galleries.update', $gallery->id) : route('galleries.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.select name='album_id' label='Album Id'>
            <option value='' required selected>Select Album Id</option>
            @foreach($albums as $item)
                <option value='{{ $item->id }}' {{ (old('album_id', $gallery->album_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='title_id' label='Title Id' :value="$gallery->title_id ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$gallery->image ?? null" rounded='circle' />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('galleries.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection