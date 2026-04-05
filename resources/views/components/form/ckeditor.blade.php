@props([
    'name',
    'label' => null,
    'value' => '',
    'placeholder' => '',
    'enableImages' => true,
    'enableCodeBlock' => true,
    'enableClearFormatting' => true,
    'uploadUrl' => null,
    'required' => false,
])

@php
    $fieldId = $attributes->get('id', $name);
    $resolvedUploadUrl = null;

    if ($enableImages) {
        $resolvedUploadUrl = $uploadUrl;

        if (! $resolvedUploadUrl && \Illuminate\Support\Facades\Route::has('editor-images.store')) {
            $resolvedUploadUrl = route('editor-images.store');
        }
    }

    $editorConfig = [
        'placeholder' => $placeholder ?: ($label ? 'Tulis ' . strtolower($label) . ' di sini...' : ''),
        'enableImages' => (bool) $enableImages,
        'enableCodeBlock' => (bool) $enableCodeBlock,
        'enableClearFormatting' => (bool) $enableClearFormatting,
        'uploadUrl' => $resolvedUploadUrl,
        'csrfToken' => csrf_token(),
    ];
@endphp

@once
    @push('styles')
        <x-editor.ckeditor-styles />
    @endpush

    @push('scripts')
        <x-editor.ckeditor-scripts />
    @endpush
@endonce

<div class="mb-3 ck-editor-wrapper {{ $errors->has($name) ? 'is-invalid' : '' }}">
    @if ($label)
        <label for="{{ $fieldId }}" class="form-label">{{ $label }}</label>
    @endif

    <textarea
        id="{{ $fieldId }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        data-ckeditor-config='@json($editorConfig)'
        {{ $attributes->except(['id', 'class'])->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>
