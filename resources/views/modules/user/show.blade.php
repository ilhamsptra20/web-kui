@extends('layouts.app')
@section('title', 'Detail User')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
        <div>
            <h4 class="card-title mb-25">Detail User</h4>
            <p class="text-muted mb-0">Lihat data akun internal tanpa membuka mode edit.</p>
        </div>
        <div class="mt-1 mt-lg-0 d-flex">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary mr-1">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
    <div class="card-body pt-2">
        @include('modules.user.fields', ['showMode' => true])
    </div>
</div>
@endsection
