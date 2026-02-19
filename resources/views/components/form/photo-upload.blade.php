@props([
    'label' => 'Photo',
    'name' => 'photo',
    'value' => null,
    'readonly' => false,
    'size' => 150,
    'rounded' => 'xl', // circle | xl | none
])

@php
    $previewId = $name . '_preview';
    $inputId = $name . '_input';

    $roundedClass = match($rounded) {
        'circle' => 'rounded',
        'none' => '',
        default => 'rounded-' . $rounded,
    };

    $imageSrc = $value 
        ? asset('storage/' . $value) 
        : 'https://via.placeholder.com/'.$size.'?text=Upload';
@endphp

<div class="mb-4">

    <label class="d-block mb-2 fw-semibold">{{ $label }}</label>

    <div class="position-relative d-inline-block">

        <img
            id="{{ $previewId }}"
            src="{{ $imageSrc }}"
            class="{{ $roundedClass }} border"
            style="width:{{ $size }}px; height:{{ $size }}px; object-fit:cover; cursor:{{ $readonly ? 'default' : 'pointer' }};"
            alt="Photo Preview"
        >

        @unless($readonly)
            <input 
                type="file"
                name="{{ $name }}"
                id="{{ $inputId }}"
                accept="image/*"
                class="d-none"
            >
        @endunless

    </div>

    @error($name)
        <div class="text-danger mt-2">{{ $message }}</div>
    @enderror

</div>

@unless($readonly)
<script>
(function(){
    const input = document.getElementById('{{ $inputId }}');
    const preview = document.getElementById('{{ $previewId }}');

    if (!input || !preview) return;

    preview.addEventListener('click', () => input.click());

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
    });
})();
</script>
@endunless
