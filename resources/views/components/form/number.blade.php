@props(['name', 'label' => null, 'min' => 0, 'max' => 100, 'step' => 1])

<div class="form-group">
    @if($label) <label>{{ $label }}</label> @endif
    <div class="input-group">
        <input type="number" name="{{ $name }}" class="touchspin" 
            data-bts-min="{{ $min }}" data-bts-max="{{ $max }}" data-bts-step="{{ $step }}" {{ $attributes }}>
    </div>
</div>

@pushonce('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">
@endpushonce

@pushonce('scripts')
    <script src="{{ asset('assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script>
        $(".touchspin").TouchSpin({ buttondown_class: "btn btn-primary", buttonup_class: "btn btn-primary" });
    </script>
@endpushonce