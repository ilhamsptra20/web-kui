@extends('layouts.app')
@section('title', 'Detail Agenda')

@section('content')
<div class='card'>
    <div class='card-header d-flex justify-content-between align-items-center'>
        <h4 class='card-title mb-0'>Detail Agenda</h4>
        <div class='d-flex'>
            <a href='{{ route('agendas.edit', $agenda) }}' class='btn btn-primary mr-1'>Edit</a>
            <a href='{{ route('agendas.index') }}' class='btn btn-outline-secondary'>Back</a>
        </div>
    </div>
    <div class='card-body'>
        @include('modules.agenda.fields', ['showMode' => true])

    </div>
</div>
@endsection
