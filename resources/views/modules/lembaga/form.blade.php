@php $isEdit = isset($lembaga); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Lembaga')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('lembagas.update', $lembaga->id) : route('lembagas.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name_id' label='Name Id' :value="$lembaga->name_id ?? ''" floating divider />
        <x-form.textarea name='description_id' label='Description Id'>{{ $lembaga->description_id ?? '' }}</x-form.textarea>
        <x-form.photo-upload label='Image' name='image' :value="$lembaga->image ?? null" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('lembagas.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection