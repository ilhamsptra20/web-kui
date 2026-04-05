@extends('layouts.app')
@section('title', 'Detail Navigation')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Detail Navigation</h4>
        <div class="d-flex">
            <a href="{{ route('navigations.edit', $navigation) }}" class="btn btn-primary mr-1">Edit</a>
            <a href="{{ route('navigations.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
    <div class="card-body">
        @include('modules.navigation.fields', ['showMode' => true])
    </div>
</div>
@endsection
