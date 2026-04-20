@php
    $showMode = $showMode ?? false;
    $selectedLocation = old('location', $navigation?->location ?? \App\Models\Navigation::LOCATION_NAVBAR);
    $selectedParent = old('parent_id', $navigation?->parent_id ?? '');
    $currentUrl = old('url', $navigation?->url ?? '');
    $currentTitleId = old('title_id', $navigation?->title_id ?? '');
    $currentTitleEn = old('title_en', $navigation?->title_en ?? '');
    $currentTitleAr = old('title_ar', $navigation?->title_ar ?? '');
@endphp

<input type="hidden" name="area" value="{{ \App\Models\Navigation::AREA_MARKETING }}">
<input type="hidden" name="type" value="{{ \App\Models\Navigation::TYPE_LINK }}">

<div class="navigation-builder">
    <div class="navigation-surface navigation-hero">
        <div class="navigation-section-title">Lokasi Menu</div>

        <div class="navigation-location-grid">
            @foreach($locationOptions as $value => $label)
                <div class="navigation-choice-item">
                    <input class="navigation-location-input navigation-choice-input" type="radio" name="location" id="navigation-location-{{ $value }}" value="{{ $value }}" {{ $selectedLocation === $value ? 'checked' : '' }} @disabled($showMode)>
                    <label class="navigation-location-card" for="navigation-location-{{ $value }}">
                        <span class="navigation-location-icon">
                            <i class="feather {{ $value === \App\Models\Navigation::LOCATION_NAVBAR ? 'icon-navigation' : 'icon-list' }}"></i>
                        </span>
                        <strong>{{ $label }}</strong>
                    </label>
                </div>
            @endforeach
        </div>
        @error('location')
            <div class="text-danger small mt-50">{{ $message }}</div>
        @enderror
    </div>

    <div class="navigation-surface">
        <div class="row">
            <div class="col-lg-4">
                <div class="navigation-section-title">Struktur</div>
                <x-form.select name="parent_id" label="Sub Menu Dari" :disabled="$showMode">
                    <option value="">Tidak ada parent</option>
                    @foreach($parentNavigations as $item)
                        <option
                            value="{{ $item->id }}"
                            data-location="{{ $item->location }}"
                            {{ $selectedParent === $item->id ? 'selected' : '' }}
                        >
                            {{ $item->trans('title') ?? '-' }} - {{ \App\Models\Navigation::locationOptions()[$item->location] ?? $item->location }}
                        </option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="col-lg-8">
                <div class="navigation-section-title">Label Menu</div>
                <div class="row">
                    <div class="col-md-4">
                        <x-form.input name="title_id" type="text" label="Title Indonesia" :value="$currentTitleId" :readonly="$showMode" :disabled="$showMode" required floating divider />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="title_en" type="text" label="Title English" :value="$currentTitleEn" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="title_ar" type="text" label="Title Arabic" :value="$currentTitleAr" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navigation-surface">
        <div class="navigation-section-title">Tujuan Link</div>
        <div class="row">
            <div class="col-md-12">
                <x-form.input name="url" type="text" label="URL" :value="$currentUrl" :readonly="$showMode" :disabled="$showMode" floating divider />
            </div>
        </div>
    </div>

    <div class="navigation-surface">
        <div class="navigation-section-title">Pengaturan</div>
        <div class="row align-items-center">
            <div class="col-md-4">
                <x-form.input name="sort_order" type="number" label="Sort Order" :value="$navigation?->sort_order ?? 0" :readonly="$showMode" :disabled="$showMode" required floating divider />
            </div>
            <div class="col-md-4">
                <x-form.switch name="is_active" label="Active" :checked="(bool) old('is_active', $navigation?->is_active ?? true)" :disabled="$showMode" />
            </div>
            <div class="col-md-4">
                <x-form.switch name="open_in_new_tab" label="Open In New Tab" :checked="(bool) old('open_in_new_tab', $navigation?->open_in_new_tab ?? false)" :disabled="$showMode" />
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .navigation-builder {
            position: relative;
        }

        .navigation-surface {
            background: #fff;
            border: 1px solid rgba(40, 199, 111, .12);
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .04);
            padding: 1.2rem 1.25rem;
            margin-bottom: 1rem;
        }

        .navigation-hero {
            background:
                radial-gradient(circle at top right, rgba(40, 199, 111, .12), transparent 36%),
                linear-gradient(180deg, rgba(40, 199, 111, .04), rgba(255, 255, 255, 0));
        }

        .navigation-section-title {
            display: inline-block;
            margin-bottom: 1rem;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #28c76f;
        }

        .navigation-location-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .navigation-choice-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .navigation-choice-item {
            position: relative;
        }

        .navigation-location-card {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: .9rem 1rem;
            border-radius: 18px;
            border: 1px solid #e9ecef;
            background: #fff;
            cursor: pointer;
            transition: all .18s ease;
            min-height: 78px;
            margin-bottom: 0;
        }

        .navigation-location-card:hover,
        .navigation-choice-input:checked + .navigation-location-card {
            border-color: rgba(40, 199, 111, .45);
            box-shadow: 0 14px 30px rgba(40, 199, 111, .12);
            transform: translateY(-1px);
        }

        .navigation-location-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #28c76f, #5bd38d);
            color: #fff;
            font-size: 1.1rem;
        }

        @media (max-width: 767.98px) {
            .navigation-surface {
                padding: 1.1rem 1rem;
                border-radius: 16px;
            }
        }
    </style>
@endpush

@if (! $showMode)
    @push('scripts')
        <script>
            (function () {
                const locationInputs = Array.from(document.querySelectorAll('.navigation-location-input'));
                const parentSelect = document.querySelector('select[name="parent_id"]');

                function selectedLocation() {
                    return locationInputs.find((input) => input.checked)?.value || '{{ \App\Models\Navigation::LOCATION_NAVBAR }}';
                }

                function syncParentOptions() {
                    if (!parentSelect) return;

                    const location = selectedLocation();
                    parentSelect.disabled = false;

                    Array.from(parentSelect.options).forEach((option, index) => {
                        if (index === 0) {
                            option.hidden = false;
                            option.disabled = false;
                            return;
                        }

                        const visible = option.dataset.location === location;
                        option.hidden = !visible;
                        option.disabled = !visible;
                    });

                    const currentOption = parentSelect.selectedOptions[0];
                    if (currentOption && currentOption.hidden) {
                        parentSelect.value = '';
                        if (window.$) {
                            $(parentSelect).trigger('change.select2');
                        }
                    }
                }

                locationInputs.forEach((input) => input.addEventListener('change', syncParentOptions));
                document.addEventListener('DOMContentLoaded', syncParentOptions);
                syncParentOptions();
            })();
        </script>
    @endpush
@endif
