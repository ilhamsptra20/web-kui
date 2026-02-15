@props([
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,
    'floating' => false,
    'required' => false,
    'value' => '',
    'divider' => false // Opsi buat nambahin garis pemisah icon
])

@php
    $baseClass = $floating ? 'form-label-group' : 'form-group';
    // Tambahin class divider kalau di-set true
    $hasIconClass = $icon ? 'position-relative has-icon-left' : '';
    $dividerClass = ($icon && $divider) ? 'input-divider-left' : '';
@endphp

<div class="{{ $baseClass }} {{ $hasIconClass }} {{ $dividerClass }}">
    {{-- Kalau BUKAN floating, label taruh di paling ATAS --}}
    @if(!$floating && $label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <div class="controls">
        <input 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror {{ $attributes->get('class') }}" 
            {{-- Kalau floating, placeholder wajib ada string-nya buat trigger animasi --}}
            placeholder="{{ $floating ? ($placeholder ?: $label) : $placeholder }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->except('class') }}
        >

        {{-- Icon ditaruh di dalam container setelah input --}}
        @if($icon)
            <div class="form-control-position">
                <i class="feather icon-{{ $icon }}"></i>
            </div>
        @endif

        {{-- Kalau FLOATING, label HARUS ditaruh di bawah input & icon supaya transisi CSS-nya bener --}}
        @if($floating && $label)
            <label for="{{ $name }}">{{ $label }}</label>
        @endif
    </div>

    @error($name)
        <div class="invalid-feedback" style="display: block;">
            <small>{{ $message }}</small>
        </div>
    @enderror
</div>