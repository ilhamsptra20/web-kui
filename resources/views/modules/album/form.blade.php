@php $isEdit = isset($album); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('albums.update', $album->id) : route('albums.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name_id' label='Name Id' :value="$album->name_id ?? ''" floating divider />
        <x-form.input name='name_en' label='Name En' :value="$album->name_en ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$album->image ?? null" rounded='circle' />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('albums.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection