@props([
    'name',
    'label' => null,
    'value' => null,
    'icons' => [],
    'placeholder' => 'Pilih icon',
    'disabled' => false,
])

@php
    $selectedValue = old($name, $value);
    $errorClass = $errors->has($name) ? 'is-invalid' : '';
    $selectId = $attributes->get('id') ?: $name;
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $selectId }}">{{ $label }}</label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $selectId }}"
        data-placeholder="{{ $placeholder }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => "form-control feather-icon-select {$errorClass}"]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($icons as $iconClass => $iconName)
            <option value="{{ $iconClass }}" data-icon-class="{{ $iconClass }}" {{ $selectedValue === $iconClass ? 'selected' : '' }}>
                {{ $iconName }}
            </option>
        @endforeach
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
        .feather-icon-select-option {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .feather-icon-select-option i {
            font-size: 1rem;
            min-width: 1rem;
        }

        .feather-icon-select-option .feather-icon-select-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }

        .feather-icon-select-option .feather-icon-select-name {
            font-weight: 600;
        }

        .feather-icon-select-option .feather-icon-select-class {
            color: #6c757d;
            font-size: .75rem;
        }

        .feather-icon-select-wrapper .select2-selection__rendered {
            line-height: 1.5 !important;
        }

        .feather-icon-select.is-invalid + .select2-container .select2-selection {
            border-color: #ea5455 !important;
        }
    </style>
@endpushonce

@pushonce('scripts')
    <script src="{{ asset('assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        (function () {
            function formatFeatherIcon(option) {
                if (!option.id) {
                    return option.text;
                }

                const iconClass = option.element?.dataset?.iconClass || option.id;
                const iconName = option.text || iconClass.replace('feather icon-', '');

                return $(
                    '<span class="feather-icon-select-option">' +
                        '<i class="' + iconClass + '"></i>' +
                        '<span class="feather-icon-select-meta">' +
                            '<span class="feather-icon-select-name">' + iconName + '</span>' +
                            '<span class="feather-icon-select-class">' + iconClass + '</span>' +
                        '</span>' +
                    '</span>'
                );
            }

            function initFeatherIconSelect(context) {
                $(context).find('.feather-icon-select').each(function () {
                    const $select = $(this);

                    if ($select.hasClass('select2-hidden-accessible')) {
                        return;
                    }

                    $select.select2({
                        width: '100%',
                        allowClear: true,
                        placeholder: $select.data('placeholder') || 'Pilih icon',
                        dropdownAutoWidth: true,
                        templateResult: formatFeatherIcon,
                        templateSelection: formatFeatherIcon,
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                    });

                    $select.next('.select2-container').addClass('feather-icon-select-wrapper');
                });
            }

            $(document).ready(function () {
                initFeatherIconSelect(document);
            });
        })();
    </script>
@endpushonce
