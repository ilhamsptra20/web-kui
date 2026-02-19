@php $isEdit = isset($video); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('videos.update', $video->id) : route('videos.store') }}" method='POST' enctype="multipart/form-data" novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='title_id' label='Title Id' :value="$video->title_id ?? ''" floating divider />
        <x-form.input name='video_url' label='Video Url' :value="$video->video_url ?? ''" floating divider />
        <x-form.photo-upload label='Thumbnail' name='thumbnail' :value="$video->thumbnail ?? null" rounded='circle' />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('videos.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection