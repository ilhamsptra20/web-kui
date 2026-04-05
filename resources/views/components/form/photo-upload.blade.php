@props([
    'label' => 'Photo',
    'name' => 'photo',
    'value' => null,
    'readonly' => false,
    'size' => null,        // null = full width, atau angka px (e.g. 150)
    'height' => null,      // null = sama dengan width (square), atau angka px
    'rounded' => 'xl',     // circle | xl | none
])

@php
    $previewId = $name . '_preview';
    $inputId   = $name . '_input';

    $roundedClass = match($rounded) {
        'circle' => 'rounded-circle',
        'none'   => '',
        default  => 'rounded-' . $rounded,
    };

    // Kalau size di-set, pakai fixed px; kalau tidak, full width
    $isFixed = $size !== null;

    $imgStyle = $isFixed
        ? "width:{$size}px; height:" . ($height ?? $size) . "px; object-fit:cover; cursor:" . ($readonly ? 'default' : 'pointer') . ";"
        : "width:100%; height:" . ($height ? "{$height}px" : '200px') . "; object-fit:cover; cursor:" . ($readonly ? 'default' : 'pointer') . ";";

    $wrapperClass = $isFixed ? 'd-inline-block' : 'd-block';

    $placeholderSize = $size ?? 400;
    $placeholderImage = 'data:image/svg+xml;utf8,' . rawurlencode(
        '<svg xmlns="http://www.w3.org/2000/svg" width="' . $placeholderSize . '" height="' . ($height ?? 200) . '" viewBox="0 0 ' . $placeholderSize . ' ' . ($height ?? 200) . '">'
        . '<rect width="100%" height="100%" fill="#f5f5f5"/>'
        . '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9aa0a6" font-family="Arial, sans-serif" font-size="20">Upload</text>'
        . '</svg>'
    );
    if (! $value) {
        $imageSrc = $placeholderImage;
    } elseif (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
        $imageSrc = $value;
    } else {
        $resolvedStorageUrl = \Illuminate\Support\Facades\Storage::disk('public')->url(ltrim($value, '/'));
        $imageSrc = parse_url($resolvedStorageUrl, PHP_URL_PATH) ?: $resolvedStorageUrl;
    }
@endphp

<div class="mb-4">

    <label class="d-block mb-2 fw-semibold">{{ $label }}</label>

    <div class="position-relative {{ $wrapperClass }}">

        <img
            id="{{ $previewId }}"
            src="{{ $imageSrc }}"
            class="{{ $roundedClass }} border"
            style="{{ $imgStyle }}"
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
    const input   = document.getElementById('{{ $inputId }}');
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
