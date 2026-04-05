@php
    $showMode = $showMode ?? false;
    $selectedArea = old('area', $navigation?->area ?? \App\Models\Navigation::AREA_ADMIN);
    $selectedLocation = old(
        'location',
        $navigation?->location ?? ($selectedArea === \App\Models\Navigation::AREA_ADMIN ? \App\Models\Navigation::LOCATION_SIDEBAR : \App\Models\Navigation::LOCATION_NAVBAR)
    );
    $selectedType = old(
        'type',
        $navigation?->type ?? ($selectedArea === \App\Models\Navigation::AREA_MARKETING ? \App\Models\Navigation::TYPE_LINK : \App\Models\Navigation::TYPE_LINK)
    );
    $selectedParent = old('parent_id', $navigation?->parent_id ?? '');
    $isMarketing = $selectedArea === \App\Models\Navigation::AREA_MARKETING;
    $isLink = $selectedType === \App\Models\Navigation::TYPE_LINK;
    $isAdminLink = ! $isMarketing && $isLink;
    $previewTitle = $navigation?->title_id ?? '';
@endphp

<div class="navigation-builder">
    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Context</div>
                        <h5 class="mb-25">Pilih area dan perilaku menu</h5>
                        <p class="text-muted mb-0">Admin dan marketing sekarang dipisah tegas. Pilih area dulu, nanti field lain menyesuaikan otomatis.</p>
                    </div>
                </div>

                <div class="navigation-choice-grid">
                    @foreach($areaOptions as $value => $label)
                        <div class="navigation-choice-item">
                            <input class="navigation-area-input navigation-choice-input" type="radio" name="area" id="navigation-area-{{ $value }}" value="{{ $value }}" {{ $selectedArea === $value ? 'checked' : '' }} @disabled($showMode)>
                            <label class="navigation-choice-card navigation-choice-card-area" for="navigation-area-{{ $value }}">
                                <span class="navigation-choice-icon {{ $value === \App\Models\Navigation::AREA_ADMIN ? 'navigation-choice-icon-admin' : 'navigation-choice-icon-marketing' }}">
                                    <i class="feather {{ $value === \App\Models\Navigation::AREA_ADMIN ? 'icon-sidebar' : 'icon-globe' }}"></i>
                                </span>
                                <span class="navigation-choice-copy">
                                    <strong>{{ $label }}</strong>
                                    <small>{{ $value === \App\Models\Navigation::AREA_ADMIN ? 'Sidebar internal panel admin' : 'Navbar dan footer publik' }}</small>
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('area')
                    <div class="text-danger small mt-50">{{ $message }}</div>
                @enderror

                <div class="row mt-2">
                    <div class="col-md-6" data-navigation-block="location">
                        <div class="navigation-inline-block">
                            <div class="navigation-inline-label">Posisi Menu</div>
                            <div class="navigation-pill-group">
                                @foreach($locationOptions as $value => $label)
                                    <div class="navigation-location-option" data-option-area="{{ $value === \App\Models\Navigation::LOCATION_SIDEBAR ? \App\Models\Navigation::AREA_ADMIN : \App\Models\Navigation::AREA_MARKETING }}">
                                        <input class="navigation-location-input navigation-choice-input" type="radio" name="location" id="navigation-location-{{ $value }}" value="{{ $value }}" {{ $selectedLocation === $value ? 'checked' : '' }} @disabled($showMode)>
                                        <label class="navigation-pill" for="navigation-location-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('location')
                                <div class="text-danger small mt-50">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 {{ $isMarketing ? 'd-none' : '' }}" data-navigation-block="type">
                        <div class="navigation-inline-block">
                            <div class="navigation-inline-label">Tipe Menu Admin</div>
                            <div class="navigation-pill-group">
                                @foreach($typeOptions as $value => $label)
                                    <div class="navigation-type-option" data-type-value="{{ $value }}">
                                        <input class="navigation-type-input navigation-choice-input" type="radio" name="type" id="navigation-type-{{ $value }}" value="{{ $value }}" {{ $selectedType === $value ? 'checked' : '' }} @disabled($showMode)>
                                        <label class="navigation-pill" for="navigation-type-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('type')
                                <div class="text-danger small mt-50">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-6">
                        <x-form.input name="sort_order" type="number" label="Sort Order" :value="$navigation?->sort_order ?? 0" :readonly="$showMode" :disabled="$showMode" required floating divider />
                    </div>
                </div>
            </div>

            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Identity</div>
                        <h5 class="mb-25">Nama menu multibahasa</h5>
                        <p class="text-muted mb-0">Isi minimal `Title Id`. Kalau site lo multi-language, isi juga versi English dan Arabic.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form.input name="title_id" type="text" label="Title Id" :value="$navigation?->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="title_en" type="text" label="Title En" :value="$navigation?->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="title_ar" type="text" label="Title Ar" :value="$navigation?->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                </div>
            </div>

            <div class="navigation-surface {{ $isLink ? '' : 'd-none' }}" data-navigation-block="link-destination">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Destination</div>
                        <h5 class="mb-25">Atur urutan dan tujuan menu</h5>
                        <p class="text-muted mb-0">Kalau item ini link, isi `Route Name` atau `URL`, lalu tentukan urutan tampilnya.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 {{ $isLink ? '' : 'd-none' }}" data-navigation-block="parent-only">
                        <x-form.select name="parent_id" label="Parent Navigation" :disabled="$showMode">
                            <option value="">No Parent</option>
                            @foreach($parentNavigations as $item)
                                <option
                                    value="{{ $item->id }}"
                                    data-area="{{ $item->area }}"
                                    data-location="{{ $item->location }}"
                                    data-type="{{ $item->type }}"
                                    {{ $selectedParent === $item->id ? 'selected' : '' }}
                                >
                                    {{ $item->trans('title') ?? '-' }} ({{ \App\Models\Navigation::areaOptions()[$item->area] ?? $item->area }} / {{ \App\Models\Navigation::locationOptions()[$item->location] ?? $item->location }})
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form.input name="route_name" type="text" label="Route Name" :value="$navigation?->route_name ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                    <div class="col-md-6">
                        <x-form.input name="url" type="text" label="URL" :value="$navigation?->url ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                </div>
            </div>

            <div class="navigation-surface {{ $isAdminLink ? '' : 'd-none' }}" data-navigation-block="admin-appearance">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Admin Appearance</div>
                        <h5 class="mb-25">Visual sidebar admin</h5>
                        <p class="text-muted mb-0">Bagian ini hanya relevan untuk link admin. Lo bisa pilih icon dan badge supaya sidebar lebih informatif.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form.feather-icon-select
                            name="icon"
                            label="Icon"
                            :value="$navigation?->icon ?? ''"
                            :icons="$iconOptions"
                            :disabled="$showMode"
                            placeholder="Pilih Feather icon"
                        />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="badge_text" type="text" label="Badge Text" :value="$navigation?->badge_text ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="badge_class" type="text" label="Badge Class" :value="$navigation?->badge_class ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
                    </div>
                </div>
            </div>

            <div class="navigation-surface">
                <div class="navigation-surface-head">
                    <div>
                        <div class="navigation-surface-kicker">Behavior</div>
                        <h5 class="mb-25">Status dan perilaku item</h5>
                        <p class="text-muted mb-0">Nonaktifkan item kalau belum siap tayang. Untuk link, lo juga bisa atur buka di tab baru.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <x-form.switch name="is_active" label="Active" :checked="(bool) old('is_active', $navigation?->is_active ?? true)" :disabled="$showMode" />
                    </div>
                    <div class="col-md-6 {{ $isLink ? '' : 'd-none' }}" data-navigation-block="open-in-new-tab">
                        <x-form.switch name="open_in_new_tab" label="Open In New Tab" :checked="(bool) old('open_in_new_tab', $navigation?->open_in_new_tab ?? false)" :disabled="$showMode" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-12">
            <div class="navigation-preview-panel">
                <div class="navigation-preview-head">
                    <div class="navigation-surface-kicker">Live Preview</div>
                    <h5 class="mb-25">Context menu</h5>
                    <p class="text-muted mb-0">Preview ini bantu lo lihat item bakal tampil di area mana.</p>
                </div>

                <div class="navigation-preview-meta">
                    <span class="navigation-preview-tag navigation-preview-area" data-preview-area>{{ \App\Models\Navigation::areaOptions()[$selectedArea] ?? $selectedArea }}</span>
                    <span class="navigation-preview-tag navigation-preview-location" data-preview-location>{{ \App\Models\Navigation::locationOptions()[$selectedLocation] ?? $selectedLocation }}</span>
                    <span class="navigation-preview-tag navigation-preview-type" data-preview-type>{{ \App\Models\Navigation::typeOptions()[$selectedType] ?? $selectedType }}</span>
                </div>

                <div class="navigation-preview-canvas" data-preview-canvas="{{ $selectedArea }}">
                    <div class="navigation-preview-label">Preview item</div>
                    <div class="navigation-preview-item" data-preview-item>
                        <div class="navigation-preview-icon {{ $isAdminLink ? '' : 'd-none' }}" data-preview-icon-wrapper>
                            <i class="{{ $navigation?->icon ?: 'feather icon-circle' }}" data-preview-icon></i>
                        </div>
                        <div class="navigation-preview-copy">
                            <div class="navigation-preview-title" data-preview-title>{{ $previewTitle ?: 'Judul menu akan muncul di sini' }}</div>
                            <div class="navigation-preview-subtitle" data-preview-subtitle>
                                {{ $isLink ? ($navigation?->route_name ?: ($navigation?->url ?: 'Isi route name atau URL untuk lihat tujuan link')) : 'Header tidak punya tujuan link' }}
                            </div>
                        </div>
                        <span class="badge badge-primary {{ filled($navigation?->badge_text ?? null) && $isAdminLink ? '' : 'd-none' }}" data-preview-badge>{{ $navigation?->badge_text ?? '' }}</span>
                    </div>
                </div>

                <div class="navigation-preview-facts">
                    <div class="navigation-preview-fact">
                        <span class="navigation-preview-fact-label">Parent</span>
                        <strong data-preview-parent>{{ $navigation?->parent?->trans('title') ?? 'Tanpa parent' }}</strong>
                    </div>
                    <div class="navigation-preview-fact">
                        <span class="navigation-preview-fact-label">Order</span>
                        <strong data-preview-order>{{ old('sort_order', $navigation?->sort_order ?? 0) }}</strong>
                    </div>
                    <div class="navigation-preview-fact">
                        <span class="navigation-preview-fact-label">Status</span>
                        <strong data-preview-status>{{ old('is_active', $navigation?->is_active ?? true) ? 'Active' : 'Inactive' }}</strong>
                    </div>
                </div>

                <div class="navigation-preview-rules">
                    <div class="navigation-preview-rule">
                        <i class="feather icon-shield text-primary"></i>
                        <span>Admin selalu diarahkan ke sidebar.</span>
                    </div>
                    <div class="navigation-preview-rule">
                        <i class="feather icon-globe text-success"></i>
                        <span>Marketing hanya hidup di navbar atau footer.</span>
                    </div>
                    <div class="navigation-preview-rule">
                        <i class="feather icon-link-2 text-warning"></i>
                        <span>Item link wajib punya route name atau URL.</span>
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
            border: 1px solid rgba(115, 103, 240, .08);
            border-radius: 22px;
            box-shadow: 0 16px 38px rgba(15, 23, 42, .05);
            padding: 1.35rem 1.4rem;
            margin-bottom: 1.25rem;
        }

        .navigation-preview-panel {
            position: sticky;
            top: 1.5rem;
            background:
                radial-gradient(circle at top right, rgba(115, 103, 240, .08), transparent 35%),
                #fff;
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
            color: #7367f0;
        }

        .navigation-choice-grid {
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

        .navigation-choice-card {
            display: flex;
            align-items: center;
            gap: .9rem;
            padding: 1rem 1rem;
            border-radius: 18px;
            border: 1px solid #e9ecef;
            cursor: pointer;
            transition: all .18s ease;
            min-height: 96px;
            margin-bottom: 0;
        }

        .navigation-choice-card:hover,
        .navigation-choice-input:checked + .navigation-choice-card {
            border-color: rgba(115, 103, 240, .4);
            box-shadow: 0 14px 30px rgba(115, 103, 240, .12);
            transform: translateY(-1px);
        }

        .navigation-choice-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
        }

        .navigation-choice-icon-admin {
            background: linear-gradient(135deg, #7367f0, #8f84ff);
        }

        .navigation-choice-icon-marketing {
            background: linear-gradient(135deg, #28c76f, #5bd38d);
        }

        .navigation-choice-copy {
            display: flex;
            flex-direction: column;
        }

        .navigation-choice-copy small {
            color: #6c757d;
            margin-top: .2rem;
        }

        .navigation-inline-block {
            background: #f8f9ff;
            border-radius: 16px;
            padding: .95rem 1rem;
            height: 100%;
        }

        .navigation-inline-label {
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #6c757d;
            margin-bottom: .65rem;
        }

        .navigation-pill-group {
            display: flex;
            flex-wrap: wrap;
            gap: .65rem;
        }

        .navigation-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 96px;
            padding: .65rem .95rem;
            border-radius: 999px;
            border: 1px solid #dfe3e7;
            background: #fff;
            color: #495057;
            font-weight: 600;
            cursor: pointer;
            transition: all .18s ease;
            margin-bottom: 0;
        }

        .navigation-choice-input:checked + .navigation-pill {
            background: #7367f0;
            border-color: #7367f0;
            color: #fff;
            box-shadow: 0 10px 18px rgba(115, 103, 240, .2);
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

        .navigation-preview-area {
            background: rgba(115, 103, 240, .12);
            color: #7367f0;
        }

        .navigation-preview-location {
            background: rgba(255, 159, 67, .12);
            color: #ff9f43;
        }

        .navigation-preview-type {
            background: rgba(40, 199, 111, .12);
            color: #28c76f;
        }

        .navigation-preview-canvas {
            border-radius: 18px;
            padding: 1rem;
            background: linear-gradient(180deg, #f8f9ff, #fdfdff);
            border: 1px dashed rgba(115, 103, 240, .2);
            margin-bottom: 1rem;
        }

        .navigation-preview-canvas[data-preview-canvas="admin"] {
            background: linear-gradient(180deg, rgba(115, 103, 240, .08), rgba(115, 103, 240, .02));
        }

        .navigation-preview-canvas[data-preview-canvas="marketing"] {
            background: linear-gradient(180deg, rgba(40, 199, 111, .08), rgba(40, 199, 111, .02));
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

        .navigation-preview-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(115, 103, 240, .12);
            color: #7367f0;
            font-size: 1rem;
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
            grid-template-columns: repeat(3, minmax(0, 1fr));
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

        .navigation-preview-rules {
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }

        .navigation-preview-rule {
            display: flex;
            align-items: center;
            gap: .7rem;
            color: #495057;
            font-size: .9rem;
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
                const areaInputs = Array.from(document.querySelectorAll('.navigation-area-input'));
                const locationInputs = Array.from(document.querySelectorAll('.navigation-location-input'));
                const typeInputs = Array.from(document.querySelectorAll('.navigation-type-input'));
                const parentSelect = document.querySelector('select[name="parent_id"]');
                const iconSelect = document.querySelector('select[name="icon"]');
                const titleIdInput = document.querySelector('input[name="title_id"]');
                const titleEnInput = document.querySelector('input[name="title_en"]');
                const routeNameInput = document.querySelector('input[name="route_name"]');
                const urlInput = document.querySelector('input[name="url"]');
                const sortOrderInput = document.querySelector('input[name="sort_order"]');
                const badgeTextInput = document.querySelector('input[name="badge_text"]');
                const activeInput = document.querySelector('input[name="is_active"]');
                const previewCanvas = document.querySelector('[data-preview-canvas]');
                const previewArea = document.querySelector('[data-preview-area]');
                const previewLocation = document.querySelector('[data-preview-location]');
                const previewType = document.querySelector('[data-preview-type]');
                const previewTitle = document.querySelector('[data-preview-title]');
                const previewSubtitle = document.querySelector('[data-preview-subtitle]');
                const previewParent = document.querySelector('[data-preview-parent]');
                const previewOrder = document.querySelector('[data-preview-order]');
                const previewStatus = document.querySelector('[data-preview-status]');
                const previewIcon = document.querySelector('[data-preview-icon]');
                const previewIconWrapper = document.querySelector('[data-preview-icon-wrapper]');
                const previewBadge = document.querySelector('[data-preview-badge]');

                function selectedValue(inputs) {
                    return inputs.find((input) => input.checked)?.value || null;
                }

                function syncNavigationForm() {
                    const area = selectedValue(areaInputs) || '{{ \App\Models\Navigation::AREA_ADMIN }}';
                    let location = selectedValue(locationInputs);
                    let type = selectedValue(typeInputs) || '{{ \App\Models\Navigation::TYPE_LINK }}';

                    locationInputs.forEach((input) => {
                        const wrapper = input.closest('.navigation-location-option');
                        const allowedForArea = wrapper?.dataset.optionArea === area;
                        input.disabled = !allowedForArea;
                        wrapper?.classList.toggle('d-none', !allowedForArea);
                    });

                    if (area === '{{ \App\Models\Navigation::AREA_ADMIN }}') {
                        const sidebarInput = document.getElementById('navigation-location-{{ \App\Models\Navigation::LOCATION_SIDEBAR }}');
                        if (sidebarInput) {
                            sidebarInput.checked = true;
                            location = sidebarInput.value;
                        }
                    } else {
                        const sidebarInput = document.getElementById('navigation-location-{{ \App\Models\Navigation::LOCATION_SIDEBAR }}');
                        if (sidebarInput) {
                            sidebarInput.checked = false;
                        }

                        if (!['{{ \App\Models\Navigation::LOCATION_NAVBAR }}', '{{ \App\Models\Navigation::LOCATION_FOOTER }}'].includes(location)) {
                            const navbarInput = document.getElementById('navigation-location-{{ \App\Models\Navigation::LOCATION_NAVBAR }}');
                            if (navbarInput) {
                                navbarInput.checked = true;
                                location = navbarInput.value;
                            }
                        }
                    }

                    document.querySelector('[data-navigation-block="type"]')?.classList.toggle('d-none', area !== '{{ \App\Models\Navigation::AREA_ADMIN }}');

                    typeInputs.forEach((input) => {
                        const isHeader = input.value === '{{ \App\Models\Navigation::TYPE_HEADER }}';
                        input.disabled = area !== '{{ \App\Models\Navigation::AREA_ADMIN }}' && isHeader;
                        input.closest('.navigation-type-option')?.classList.toggle('d-none', area !== '{{ \App\Models\Navigation::AREA_ADMIN }}' && isHeader);
                    });

                    if (area === '{{ \App\Models\Navigation::AREA_MARKETING }}') {
                        const linkInput = document.getElementById('navigation-type-{{ \App\Models\Navigation::TYPE_LINK }}');
                        if (linkInput) {
                            linkInput.checked = true;
                            type = linkInput.value;
                        }
                    } else {
                        type = selectedValue(typeInputs) || '{{ \App\Models\Navigation::TYPE_LINK }}';
                    }

                    const isLink = type === '{{ \App\Models\Navigation::TYPE_LINK }}';
                    const isAdminLink = area === '{{ \App\Models\Navigation::AREA_ADMIN }}' && isLink;

                    document.querySelector('[data-navigation-block="link-destination"]')?.classList.toggle('d-none', !isLink);
                    document.querySelector('[data-navigation-block="admin-appearance"]')?.classList.toggle('d-none', !isAdminLink);
                    document.querySelector('[data-navigation-block="open-in-new-tab"]')?.classList.toggle('d-none', !isLink);
                    document.querySelector('[data-navigation-block="parent-only"]')?.classList.toggle('d-none', !isLink);

                    if (parentSelect) {
                        Array.from(parentSelect.options).forEach((option, index) => {
                            if (index === 0) {
                                option.hidden = false;
                                option.disabled = false;
                                return;
                            }

                            const matchesArea = option.dataset.area === area;
                            const matchesLocation = option.dataset.location === location;
                            const notHeader = option.dataset.type !== '{{ \App\Models\Navigation::TYPE_HEADER }}';
                            const visible = isLink && matchesArea && matchesLocation && notHeader;
                            option.hidden = !visible;
                            option.disabled = !visible;
                        });

                        const currentOption = parentSelect.selectedOptions[0];
                        if (currentOption && currentOption.hidden) {
                            parentSelect.value = '';
                            $(parentSelect).trigger('change.select2');
                        }
                    }

                    if (!isAdminLink && iconSelect) {
                        iconSelect.value = '';
                        $(iconSelect).trigger('change.select2');
                    }

                     if (previewCanvas) {
                        previewCanvas.dataset.previewCanvas = area;
                    }

                    if (previewArea) {
                        previewArea.textContent = area === '{{ \App\Models\Navigation::AREA_ADMIN }}' ? 'Admin' : 'Marketing';
                    }

                    if (previewLocation) {
                        previewLocation.textContent = location
                            ? document.querySelector('label[for="navigation-location-' + location + '"]')?.textContent?.trim() || location
                            : '-';
                    }

                    if (previewType) {
                        previewType.textContent = isLink ? 'Link' : 'Header';
                    }

                    if (previewTitle) {
                        previewTitle.textContent = titleIdInput?.value?.trim() || titleEnInput?.value?.trim() || 'Judul menu akan muncul di sini';
                    }

                    if (previewSubtitle) {
                        const destination = routeNameInput?.value?.trim() || urlInput?.value?.trim() || (isLink ? 'Isi route name atau URL untuk lihat tujuan link' : 'Header tidak punya tujuan link');
                        previewSubtitle.textContent = destination;
                    }

                    if (previewParent) {
                        const parentLabel = parentSelect?.selectedOptions?.[0]?.text?.trim();
                        previewParent.textContent = parentSelect?.value ? parentLabel : 'Tanpa parent';
                    }

                    if (previewOrder) {
                        previewOrder.textContent = sortOrderInput?.value?.trim() || '0';
                    }

                    if (previewStatus) {
                        previewStatus.textContent = activeInput?.checked ? 'Active' : 'Inactive';
                    }

                    if (previewIcon && previewIconWrapper) {
                        const iconClass = iconSelect?.value?.trim() || 'feather icon-circle';
                        previewIcon.className = iconClass;
                        previewIconWrapper.classList.toggle('d-none', !isAdminLink);
                    }

                    if (previewBadge) {
                        const badgeText = badgeTextInput?.value?.trim() || '';
                        previewBadge.textContent = badgeText;
                        previewBadge.classList.toggle('d-none', !isAdminLink || badgeText === '');
                    }
                }

                areaInputs.forEach((input) => input.addEventListener('change', syncNavigationForm));
                locationInputs.forEach((input) => input.addEventListener('change', syncNavigationForm));
                typeInputs.forEach((input) => input.addEventListener('change', syncNavigationForm));
                [titleIdInput, titleEnInput, routeNameInput, urlInput, sortOrderInput, badgeTextInput, activeInput].forEach((input) => {
                    input?.addEventListener(input.type === 'checkbox' ? 'change' : 'input', syncNavigationForm);
                });
                parentSelect?.addEventListener('change', syncNavigationForm);
                iconSelect?.addEventListener('change', syncNavigationForm);

                document.addEventListener('DOMContentLoaded', syncNavigationForm);
                syncNavigationForm();
            })();
        </script>
    @endpush
@endif
