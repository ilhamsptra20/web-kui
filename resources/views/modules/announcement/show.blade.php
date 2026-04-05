@extends('layouts.app')
@section('title', 'Detail Announcement')

@section('content')
<div class='card'>
    <div class='card-header d-flex justify-content-between align-items-center'>
        <h4 class='card-title mb-0'>Detail Announcement</h4>
        <div class='d-flex'>
            <a href='{{ route('announcements.edit', $announcement) }}' class='btn btn-primary mr-1'>Edit</a>
            <a href='{{ route('announcements.index') }}' class='btn btn-outline-secondary'>Back</a>
        </div>
    </div>
    <div class='card-body'>
        @include('modules.announcement.fields', ['showMode' => true])

    </div>
</div>
@endsection
