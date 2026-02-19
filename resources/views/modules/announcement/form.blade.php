@php $isEdit = isset($announcement); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('announcements.update', $announcement->id) : route('announcements.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='title_id' label='Title Id' :value="$announcement->title_id ?? ''" floating divider />
        <x-form.input name='title_en' label='Title En' :value="$announcement->title_en ?? ''" floating divider />
        <x-form.textarea name='content_id' label='Content Id'>{{ $announcement->content_id ?? '' }}</x-form.textarea>
        <x-form.input name='file_path' label='File Path' :value="$announcement->file_path ?? ''" floating divider />
        <x-form.switch name='is_active' label='Is Active' :checked="$announcement->is_active ?? false" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('announcements.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection