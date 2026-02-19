@php $isEdit = isset($team); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('teams.update', $team->id) : route('teams.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.select name='position_id' label='Position Id'>
            <option value='' required selected>Select Position Id</option>
            @foreach($positions as $item)
                <option value='{{ $item->id }}' {{ (old('position_id', $team->position_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='npp' label='Npp' :value="$team->npp ?? ''" floating divider />
        <x-form.input name='name' label='Name' :value="$team->name ?? ''" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$team->image ?? null" rounded='circle' />
        <x-form.textarea name='bio_id' label='Bio Id'>{{ $team->bio_id ?? '' }}</x-form.textarea>

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('teams.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection