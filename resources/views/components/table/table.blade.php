@props(['id' => 'ajax-datatables'])

<div class="table-responsive">
    <table id="{{ $id }}" {{ $attributes->merge(['class' => 'table table-bordered table-striped w-100']) }}>
        <thead>
            {{ $thead }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>