@php
    $showMode = $showMode ?? false;
    $moduleOptions = $moduleOptions ?? [];
    $selectedLocation = old('location', $navigation?->location ?? \App\Models\Navigation::LOCATION_NAVBAR);
    $selectedParent = old('parent_id', $navigation?->parent_id ?? '');
    $currentRouteName = old('route_name', $navigation?->route_name ?? '');
    $currentUrl = old('url', $navigation?->url ?? '');
    $currentTitleId = old('title_id', $navigation?->title_id ?? '');
    $currentTitleEn = old('title_en', $navigation?->title_en ?? '');
    $currentTitleAr = old('title_ar', $navigation?->title_ar ?? '');
    $storedModule = old('module_key', $navigation?->module_key ?? null);
    $selectedModule = $storedModule ?: collect($moduleOptions)
        ->filter(function (array $module) use ($currentRouteName, $currentUrl): bool {
            return filled($currentRouteName)
                ? (($module['route_name'] ?? null) === $currentRouteName)
                : (($module['url'] ?? null) === $currentUrl);
        })
        ->keys()
        ->first();
@endphp

<input type="hidden" name="area" value="{{ \App\Models\Navigation::AREA_MARKETING }}">
<input type="hidden" name="type" value="{{ \App\Models\Navigation::TYPE_LINK }}">

<div class="navigation-builder">
    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="navigation-surface navigation-hero">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Marketing Navigator</div>
                        <h5 class="mb-25">Atur menu publik tanpa menyentuh sidebar admin</h5>
                    </div>
                </div>

                <div class="navigation-location-grid">
                    @foreach($locationOptions as $value => $label)
                        <div class="navigation-choice-item">
                            <input class="navigation-location-input navigation-choice-input" type="radio" name="location" id="navigation-location-{{ $value }}" value="{{ $value }}" {{ $selectedLocation === $value ? 'checked' : '' }} @disabled($showMode)>
                            <label class="navigation-location-card" for="navigation-location-{{ $value }}">
                                <span class="navigation-location-icon">
                                    <i class="feather {{ $value === \App\Models\Navigation::LOCATION_NAVBAR ? 'icon-navigation' : 'icon-list' }}"></i>
                                </span>
                                <span>
                                    <strong>{{ $label }}</strong>
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('location')
                    <div class="text-danger small mt-50">{{ $message }}</div>
                @enderror
            </div>

            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Module Target</div>
                        <h5 class="mb-25">Pilih module CRUD</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form.select name="module_key" label="Module CRUD" :disabled="$showMode">
                            <option value="">Custom Link</option>
                            @foreach($moduleOptions as $key => $module)
                                <option
                                    value="{{ $key }}"
                                    data-title-id="{{ $module['title_id'] ?? '' }}"
                                    data-title-en="{{ $module['title_en'] ?? '' }}"
                                    data-title-ar="{{ $module['title_ar'] ?? '' }}"
                                    data-route-name="{{ $module['route_name'] ?? '' }}"
                                    data-url="{{ $module['url'] ?? '' }}"
                                    {{ $selectedModule === $key ? 'selected' : '' }}
                                >
                                    {{ $module['label'] ?? $key }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="col-md-6">
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
                </div>
            </div>

            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Language Label</div>
                        <h5 class="mb-25">Judul menu multibahasa</h5>
                    </div>
                </div>

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

            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Destination</div>
                        <h5 class="mb-25">Tujuan link menu</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form.input name="route_name" type="text" label="Route Name" :value="$currentRouteName" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="url" type="text" label="URL" :value="$currentUrl" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                </div>
            </div>

            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Behavior</div>
                        <h5 class="mb-25">Status dan urutan</h5>
                    </div>
                </div>

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

        <div class="col-xl-4 col-12">
            <div class="navigation-preview-panel">
                <div class="navigation-preview-head">
                    <div class="navigation-surface-kicker">Live Preview</div>
                    <h5 class="mb-25">Ringkasan menu</h5>
                </div>

                <div class="navigation-preview-meta">
                    <span class="navigation-preview-tag navigation-preview-location" data-preview-location>{{ \App\Models\Navigation::locationOptions()[$selectedLocation] ?? $selectedLocation }}</span>
                    <span class="navigation-preview-tag navigation-preview-status" data-preview-status>{{ old('is_active', $navigation?->is_active ?? true) ? 'Active' : 'Inactive' }}</span>
                </div>

                <div class="navigation-preview-canvas">
                    <div class="navigation-preview-label">Preview item</div>
                    <div class="navigation-preview-item">
                        <div class="navigation-preview-icon">
                            <i class="feather icon-menu"></i>
                        </div>
                        <div class="navigation-preview-copy">
                            <div class="navigation-preview-title" data-preview-title>{{ $currentTitleId ?: 'Judul menu akan muncul di sini' }}</div>
                            <div class="navigation-preview-subtitle" data-preview-subtitle>{{ $currentRouteName ?: ($currentUrl ?: 'Route name atau URL belum diisi') }}</div>
                        </div>
                    </div>
                </div>

                <div class="navigation-preview-facts">
                    <div class="navigation-preview-fact">
                        <span class="navigation-preview-fact-label">Parent</span>
                        <strong data-preview-parent>{{ $navigation?->parent?->trans('title') ?? 'Root menu' }}</strong>
                    </div>
                    <div class="navigation-preview-fact">
                        <span class="navigation-preview-fact-label">Order</span>
                        <strong data-preview-order>{{ old('sort_order', $navigation?->sort_order ?? 0) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .navigation-builder {
            position: relative;
        }

        .navigation-surface,
        .navigation-preview-panel {
            background: #fff;
            border: 1px solid rgba(40, 199, 111, .12);
            border-radius: 22px;
            box-shadow: 0 16px 38px rgba(15, 23, 42, .05);
            padding: 1.35rem 1.4rem;
            margin-bottom: 1.25rem;
        }

        .navigation-hero {
            background:
                radial-gradient(circle at top right, rgba(40, 199, 111, .12), transparent 36%),
                linear-gradient(180deg, rgba(40, 199, 111, .04), rgba(255, 255, 255, 0));
        }

        .navigation-preview-panel {
            position: sticky;
            top: 1.5rem;
        }

        .navigation-surface-head,
        .navigation-preview-head {
            margin-bottom: 1rem;
        }

        .navigation-surface-kicker {
            display: inline-block;
            margin-bottom: .45rem;
            font-size: .72rem;
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
            padding: 1rem;
            border-radius: 18px;
            border: 1px solid #e9ecef;
            background: #fff;
            cursor: pointer;
            transition: all .18s ease;
            min-height: 96px;
            margin-bottom: 0;
        }

        .navigation-location-card:hover,
        .navigation-choice-input:checked + .navigation-location-card {
            border-color: rgba(40, 199, 111, .45);
            box-shadow: 0 14px 30px rgba(40, 199, 111, .12);
            transform: translateY(-1px);
        }

        .navigation-location-icon,
        .navigation-preview-icon {
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

        .navigation-preview-meta {
            display: flex;
            flex-wrap: wrap;
            gap: .55rem;
            margin-bottom: 1rem;
        }

        .navigation-preview-tag {
            border-radius: 999px;
            padding: .4rem .7rem;
            font-size: .78rem;
            font-weight: 700;
        }

        .navigation-preview-location {
            background: rgba(40, 199, 111, .12);
            color: #28c76f;
        }

        .navigation-preview-status {
            background: rgba(115, 103, 240, .12);
            color: #7367f0;
        }

        .navigation-preview-canvas {
            border-radius: 18px;
            padding: 1rem;
            background: linear-gradient(180deg, rgba(40, 199, 111, .08), rgba(40, 199, 111, .02));
            border: 1px dashed rgba(40, 199, 111, .24);
            margin-bottom: 1rem;
        }

        .navigation-preview-label {
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #6c757d;
            margin-bottom: .8rem;
        }

        .navigation-preview-item {
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: .9rem 1rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 22px rgba(15, 23, 42, .05);
        }

        .navigation-preview-copy {
            flex: 1;
            min-width: 0;
        }

        .navigation-preview-title {
            font-weight: 700;
            color: #212529;
            margin-bottom: .15rem;
        }

        .navigation-preview-subtitle {
            color: #6c757d;
            font-size: .84rem;
            word-break: break-word;
        }

        .navigation-preview-facts {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: .75rem;
            margin-bottom: 1rem;
        }

        .navigation-preview-fact {
            border-radius: 16px;
            padding: .85rem .9rem;
            background: #f8f9ff;
        }

        .navigation-preview-fact-label {
            display: block;
            font-size: .75rem;
            color: #6c757d;
            margin-bottom: .25rem;
        }

        @media (max-width: 1199.98px) {
            .navigation-preview-panel {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .navigation-preview-facts {
                grid-template-columns: 1fr;
            }

            .navigation-surface,
            .navigation-preview-panel {
                padding: 1.1rem 1rem;
                border-radius: 18px;
            }
        }
    </style>
@endpush

@if (! $showMode)
    @push('scripts')
        <script>
            (function () {
                const moduleSelect = document.querySelector('select[name="module_key"]');
                const locationInputs = Array.from(document.querySelectorAll('.navigation-location-input'));
                const parentSelect = document.querySelector('select[name="parent_id"]');
                const titleIdInput = document.querySelector('input[name="title_id"]');
                const titleEnInput = document.querySelector('input[name="title_en"]');
                const titleArInput = document.querySelector('input[name="title_ar"]');
                const routeNameInput = document.querySelector('input[name="route_name"]');
                const urlInput = document.querySelector('input[name="url"]');
                const sortOrderInput = document.querySelector('input[name="sort_order"]');
                const activeInput = document.querySelector('input[name="is_active"]');
                const previewLocation = document.querySelector('[data-preview-location]');
                const previewStatus = document.querySelector('[data-preview-status]');
                const previewTitle = document.querySelector('[data-preview-title]');
                const previewSubtitle = document.querySelector('[data-preview-subtitle]');
                const previewParent = document.querySelector('[data-preview-parent]');
                const previewOrder = document.querySelector('[data-preview-order]');

                function selectedLocation() {
                    return locationInputs.find((input) => input.checked)?.value || '{{ \App\Models\Navigation::LOCATION_NAVBAR }}';
                }

                function selectedLocationLabel() {
                    const location = selectedLocation();
                    return document.querySelector('label[for="navigation-location-' + location + '"] strong')?.textContent?.trim() || location;
                }

                function setInputValue(input, value) {
                    if (!input) return;
                    input.value = value || '';
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                }

                function applyPreset() {
                    const selected = moduleSelect?.selectedOptions?.[0];
                    if (!selected || !selected.value) {
                        syncPreview();
                        return;
                    }

                    setInputValue(titleIdInput, selected.dataset.titleId);
                    setInputValue(titleEnInput, selected.dataset.titleEn);
                    setInputValue(titleArInput, selected.dataset.titleAr);
                    setInputValue(routeNameInput, selected.dataset.routeName);
                    setInputValue(urlInput, selected.dataset.url);
                    syncPreview();
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

                function syncPreview() {
                    syncParentOptions();

                    if (previewLocation) {
                        previewLocation.textContent = selectedLocationLabel();
                    }

                    if (previewStatus) {
                        previewStatus.textContent = activeInput?.checked ? 'Active' : 'Inactive';
                    }

                    if (previewTitle) {
                        previewTitle.textContent = titleIdInput?.value?.trim()
                            || titleEnInput?.value?.trim()
                            || 'Judul menu akan muncul di sini';
                    }

                    if (previewSubtitle) {
                        previewSubtitle.textContent = routeNameInput?.value?.trim()
                            || urlInput?.value?.trim()
                            || 'Route name atau URL belum diisi';
                    }

                    if (previewParent) {
                        const parentLabel = parentSelect?.selectedOptions?.[0]?.text?.trim();
                        previewParent.textContent = parentSelect?.value ? parentLabel : 'Root menu';
                    }

                    if (previewOrder) {
                        previewOrder.textContent = sortOrderInput?.value?.trim() || '0';
                    }
                }

                moduleSelect?.addEventListener('change', applyPreset);
                locationInputs.forEach((input) => input.addEventListener('change', syncPreview));
                parentSelect?.addEventListener('change', syncPreview);
                [titleIdInput, titleEnInput, titleArInput, routeNameInput, urlInput, sortOrderInput, activeInput].forEach((input) => {
                    input?.addEventListener(input.type === 'checkbox' ? 'change' : 'input', syncPreview);
                });

                document.addEventListener('DOMContentLoaded', syncPreview);
                syncPreview();
            })();
        </script>
    @endpush
@endif
