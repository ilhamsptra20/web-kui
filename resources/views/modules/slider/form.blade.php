@php $isEdit = isset($slider); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('sliders.update', $slider->id) : route('sliders.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='title_id' label='Title Id' :value="$slider->title_id ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$slider->image ?? null" rounded='circle' />
        <x-form.input name='link' label='Link' :value="$slider->link ?? ''" floating divider />
        <x-form.input name='order' label='Order' :value="$slider->order ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('sliders.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection