@php $isEdit = isset($social_media); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('social-media.update', $social_media->id) : route('social-media.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name' label='Name' :value="$social_media->name ?? ''" floating divider />
        <x-form.input name='icon' label='Icon' :value="$social_media->icon ?? ''" floating divider />
        <x-form.input name='link' label='Link' :value="$social_media->link ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('social-media.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection