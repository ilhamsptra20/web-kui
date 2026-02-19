@php $isEdit = isset($position); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('positions.update', $position->id) : route('positions.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name_id' label='Name Id' :value="$position->name_id ?? ''" floating divider />
        <x-form.input name='name_en' label='Name En' :value="$position->name_en ?? ''" floating divider />
        <x-form.input name='name_ar' label='Name Ar' :value="$position->name_ar ?? ''" floating divider />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('positions.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection