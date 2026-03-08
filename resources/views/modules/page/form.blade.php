@php $isEdit = isset($page); @endphp
@extends('layouts.app')
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Page')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('pages.update', $page->id) : route('pages.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='title_id' label='Title Id' :value="$page->title_id ?? ''" floating divider />
        <x-form.input name='title_en' label='Title En' :value="$page->title_en ?? ''" floating divider />
        <x-form.input name='title_ar' label='Title Ar' :value="$page->title_ar ?? ''" floating divider />
        <x-form.textarea name='content_id' label='Content Id'>{{ $page->content_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_en' label='Content En'>{{ $page->content_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_ar' label='Content Ar'>{{ $page->content_ar ?? '' }}</x-form.textarea>
        <x-form.switch name='status' label='Status' :checked="$page->status ?? false" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('pages.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection