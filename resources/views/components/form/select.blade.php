@props(['name', 'label' => null, 'multiple' => false])

<div class="form-group">
    @if($label) 
        <label for="{{ $name }}">{{ $label }}</label> 
    @endif
    
    <select name="{{ $name }}" 
        id="{{ $name }}" 
        {{ $multiple ? 'multiple' : '' }} 
        {{ $attributes->merge(['class' => 'select2 form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>
        {{ $slot }}
    </select>

    @error($name)
        <span class="invalid-feedback" role="alert" style="display: block;">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@pushonce('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/select/select2.min.css') }}">
    <style>
        /* Biar border Select2 jadi merah pas error */
        .is-invalid + .select2-container .select2-selection {
            border-color: #ea5455 !important;
        }
    </style>
@endpushonce

@pushonce('scripts')
    <script src="{{ asset('assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Kita pakai inisialisasi yang lebih aman biar gak bentrok
            $('.select2').each(function() {
                $(this).select2({
                    dropdownAutoWidth: true,
                    width: '100%'
                });
            });
        });
    </script>
@endpushonce