@extends('layouts.app')
@section('title', 'Detail Relation')

@section('content')
<div class='card'>
    <div class='card-header d-flex justify-content-between align-items-center'>
        <h4 class='card-title mb-0'>Detail Relation</h4>
        <div class='d-flex'>
            <a href='{{ route('relations.edit', $relation) }}' class='btn btn-primary mr-1'>Edit</a>
            <a href='{{ route('relations.index') }}' class='btn btn-outline-secondary'>Back</a>
        </div>
    </div>
    <div class='card-body'>
        @include('modules.relation.fields', ['showMode' => true])

    </div>
</div>
@endsection
