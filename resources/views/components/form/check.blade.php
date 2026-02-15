@props([
    'type' => 'checkbox', 
    'name', 
    'label', 
    'color' => 'primary', 
    'checked' => false
])

@php
    // Cek apakah ada error untuk field ini (handle array name juga misal: hobi[])
    $errorName = str_replace(['[', ']'], ['', ''], $name);
    $isInvalid = $errors->has($errorName);
@endphp

<div class="form-group {{ $isInvalid ? 'is-invalid' : '' }} mb-1">
    <div class="vs-{{ $type }}-con vs-{{ $type }}-{{ $color }}">
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            {{ $checked ? 'checked' : '' }} 
            {{ $attributes->merge(['class' => $isInvalid ? 'is-invalid' : '']) }}
        >
        <span class="vs-{{ $type }}">
            @if($type == 'checkbox')
                <span class="vs-checkbox--check">
                    <i class="vs-icon feather icon-check"></i>
                </span>
            @else
                <span class="vs-radio--border"></span>
                <span class="vs-radio--circle"></span>
            @endif
        </span>
        <span class="{{ $isInvalid ? 'text-danger' : '' }}">{{ $label }}</span>
    </div>

    {{-- Pesan Error --}}
    @error($errorName)
        <div class="help-block mt-25">
            <small class="text-danger">{{ $message }}</small>
        </div>
    @enderror
</div>

@pushonce('styles')
<style>
    /* Fix dikit biar kalo error, border checkbox/radionya ikutan merah (opsional) */
    .is-invalid .vs-checkbox--check { border-color: #ea5455 !important; }
    .is-invalid .vs-radio--border { border-color: #ea5455 !important; }
    .mt-25 { margin-top: 0.25rem; }
</style>
@endpushonce