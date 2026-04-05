@extends('layouts.app')
@section('title', 'Detail Album')

@section('content')
<div class='card'>
    <div class='card-header d-flex justify-content-between align-items-center'>
        <h4 class='card-title mb-0'>Detail Album</h4>
        <div class='d-flex'>
            <a href='{{ route('albums.edit', $album) }}' class='btn btn-primary mr-1'>Edit</a>
            <a href='{{ route('albums.index') }}' class='btn btn-outline-secondary'>Back</a>
        </div>
    </div>
    <div class='card-body'>
        @include('modules.album.fields', ['showMode' => true])

    </div>
</div>
@endsection
