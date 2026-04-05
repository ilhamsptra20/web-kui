@extends('layouts.app')
@section('title', 'Detail Inbox')

@section('content')
<div class='card'>
    <div class='card-header d-flex justify-content-between align-items-center'>
        <h4 class='card-title mb-0'>Detail Inbox</h4>
        <div class='d-flex'>
            <a href='{{ route('inboxes.edit', $inbox) }}' class='btn btn-primary mr-1'>Edit</a>
            <a href='{{ route('inboxes.index') }}' class='btn btn-outline-secondary'>Back</a>
        </div>
    </div>
    <div class='card-body'>
        @include('modules.inbox.fields', ['showMode' => true])

    </div>
</div>
@endsection
