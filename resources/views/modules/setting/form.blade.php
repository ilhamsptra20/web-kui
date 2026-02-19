@php $isEdit = isset($setting); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('settings.update', $setting->id) : route('settings.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='key' label='Key' :value="$setting->key ?? ''" floating divider />
        <x-form.textarea name='value' label='Value'>{{ $setting->value ?? '' }}</x-form.textarea>

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('settings.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection