@props([
    'name', 
    'label' => null, 
    'color' => 'primary', 
    'size' => '', 
    'checked' => false,
    'icon' => null, // Bisa diisi nama icon, misal 'check'
    'iconRight' => null,
    'on' => null,
    'off' => null,
    'inline' => true
])

<div class="form-group">
    {{-- Container utama switch --}}
    <div class="custom-control custom-switch {{ $inline ? 'custom-control-inline' : '' }} {{ $size ? 'switch-'.$size : '' }} custom-switch-{{ $color }}">
        
        <input type="checkbox" 
            class="custom-control-input" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            {{ $checked ? 'checked' : '' }}
            {{ $attributes }}>
        
        <label class="custom-control-label" for="{{ $name }}">
            {{-- Slot untuk Teks (On/Off) --}}
            @if($on || $off)
                <span class="switch-text-left">{{ $on }}</span>
                <span class="switch-text-right">{{ $off }}</span>
            @endif

            {{-- Slot untuk Icon (feather icon) --}}
            @if($icon || $iconRight)
                <span class="switch-icon-left"><i class="feather icon-{{ $icon }}"></i></span>
                <span class="switch-icon-right"><i class="feather icon-{{ $iconRight ?: $icon }}"></i></span>
            @endif
        </label>
        
        {{-- Label teks di samping switch (menggunakan class switch-label sesuai template) --}}
        @if($label)
            <span class="switch-label cursor-pointer" onclick="document.getElementById('{{ $name }}').click()">
                {{ $label }}
            </span>
        @endif
    </div>
</div>

@pushonce('styles')
<style>
    .switch-label { margin-left: 0.5rem; vertical-align: middle; }
    .cursor-pointer { cursor: pointer; }
    /* Menghindari label bootstrap default menabrak layout */
    .custom-switch .custom-control-label::before { cursor: pointer; }
</style>
@endpushonce

@pushonce('scripts')
    <script src="assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="assets/vendors/js/extensions/tether.min.js"></script>
    <script src="assets/vendors/js/extensions/shepherd.min.js"></script>

    <script src="assets/js/scripts/pages/dashboard-analytics.js"></script>
@endpushonce

