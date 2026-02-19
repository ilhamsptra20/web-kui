@php $isEdit = isset($inbox); @endphp
@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-body'>
        <form action="{{ $isEdit ? route('inboxes.update', $inbox->id) : route('inboxes.store') }}" method='POST'  novalidate>
            @csrf
            @if($isEdit) @method('PUT') @endif

        <x-form.input name='name' label='Name' :value="$inbox->name ?? ''" floating divider />
        <x-form.input name='email' label='Email' :value="$inbox->email ?? ''" floating divider />
        <x-form.input name='subject' label='Subject' :value="$inbox->subject ?? ''" floating divider />
        <x-form.textarea name='message' label='Message'>{{ $inbox->message ?? '' }}</x-form.textarea>
        <x-form.switch name='is_read' label='Is Read' :checked="$inbox->is_read ?? false" />

            <div class='mt-3'>
                <button type='submit' class='btn btn-primary'>Save Data</button>
                <a href='{{ route('inboxes.index') }}' class='btn btn-outline-secondary'>Back</a>
            </div>
        </form>
    </div>
</div>
@endsection