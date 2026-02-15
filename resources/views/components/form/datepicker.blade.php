@props(['name', 'label' => null, 'type' => 'date'])

<div class="form-group">
    @if($label) 
        <label for="{{ $name }}">{{ $label }}</label> 
    @endif
    
    <div class="position-relative">
        <input type="text" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            {{ $attributes->merge(['class' => 'form-control ' . ($type == 'date' ? 'pickadate' : 'pickatime')]) }}
            placeholder="{{ $label }}"
            autocomplete="off">
    </div>
</div>

@pushonce('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <style>
        .picker {
            position: absolute !important;
            z-index: 2000 !important;
        }

        .picker--opened .picker__holder {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpushonce


@pushonce('scripts')
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{ asset('assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    
    {{-- <script src="{{ asset('assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script> --}}

    <script>
        $(document).ready(function() {
            $('.pickadate').pickadate({ format: 'yyyy-mm-dd' });
            $('.pickatime').pickatime();
        });
    </script>
@endpushonce

