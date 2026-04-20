@php
    $builderItems = collect(old('items', $settingItems))
        ->values()
        ->all();
@endphp

@extends('layouts.app')
@section('title', 'Setting Builder')

@section('content')
<div class="settings-builder-page">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card settings-sidebar-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="settings-sidebar-header">
                        <div class="settings-sidebar-icon">
                            <i class="feather icon-grid"></i>
                        </div>
                        <div>
                            <h4 class="mb-25">Setting Sections</h4>
                            <p class="text-muted mb-0">Kelompokkan setting admin dan marketing per section.</p>
                        </div>
                    </div>

                    <div class="settings-sidebar-block">
                        <span class="settings-sidebar-label">Groups</span>

                        <div class="settings-group-list">
                            @foreach($groups as $group)
                                <a
                                    href="{{ route('settings.index', ['group' => $group->group]) }}"
                                    class="settings-group-item {{ $activeGroup === $group->group ? 'is-active' : '' }}"
                                >
                                    <span>{{ $group->group }}</span>
                                    <small>{{ number_format((int) $group->total) }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="settings-sidebar-block border-top pt-2 mt-2">
                        <span class="settings-sidebar-label">Open New Group</span>
                        <form action="{{ route('settings.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="group" class="form-control" placeholder="Contoh: Hero Section" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-primary">Open</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8">
            @unless($schemaReady)
                <div class="alert alert-light-warning border-0 shadow-sm">
                    Jalankan migration terbaru untuk mengaktifkan setting builder berbasis group dan type.
                </div>
            @endunless

            @if(session('success'))
                <div class="alert alert-light-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-light-danger border-0 shadow-sm">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-light-danger border-0 shadow-sm">
                    <strong>Validasi gagal.</strong>
                    <ul class="mb-0 mt-50 pl-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="settings-builder-topbar">
                <div>
                    <div class="settings-breadcrumb text-muted">Settings / Group Management</div>
                    <h2 class="settings-builder-title mb-50">{{ $activeGroup }}</h2>
                    <p class="text-muted mb-0">Atur field setting untuk group ini. Form akan otomatis menyesuaikan dengan type yang dipilih.</p>
                </div>
                <div class="settings-builder-actions">
                    <button type="button" class="btn btn-outline-primary" id="add-setting-item">
                        <i class="feather icon-plus mr-50"></i>Add Field
                    </button>
                    <button type="submit" form="settings-group-form" class="btn btn-primary settings-publish-button">
                        <i class="feather icon-upload-cloud mr-50"></i>Publish Changes
                    </button>
                </div>
            </div>

            <form id="settings-group-form" action="{{ route('settings.publish') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="group" value="{{ old('group', $activeGroup) }}">

                <div id="settings-items-container">
                    @forelse($builderItems as $index => $item)
                        @include('modules.setting.item-card', ['item' => $item, 'index' => $index, 'typeOptions' => $typeOptions, 'localeOptions' => $localeOptions])
                    @empty
                        <div class="settings-empty-state" id="settings-empty-state">
                            <div class="settings-empty-state__icon">
                                <i class="feather icon-sliders"></i>
                            </div>
                            <h4 class="mb-50">Belum ada setting di group ini</h4>
                            <p class="text-muted mb-0">Klik <strong>Add Field</strong> untuk mulai membuat setting pertama.</p>
                        </div>
                    @endforelse
                </div>
            </form>
        </div>
    </div>
</div>

<template id="setting-item-template">
    <div class="setting-item-card" data-setting-item data-index="__INDEX__" data-setting-existing-key="">
        <input type="hidden" name="items[__INDEX__][id]" value="">
        <input type="hidden" name="items[__INDEX__][existing_value]" value="">

        <div class="setting-item-card__header">
            <div class="setting-item-card__identity">
                <label class="setting-item-card__label">Setting Label</label>
                <input
                    type="text"
                    class="form-control setting-card-title-input"
                    name="items[__INDEX__][label]"
                    value=""
                    placeholder="Contoh: About Description"
                    data-setting-label
                    required
                >
            </div>

            <div class="setting-item-card__controls">
                <select name="items[__INDEX__][type]" class="form-control setting-type-select" data-setting-type>
                    @foreach($typeOptions as $optionValue => $optionLabel)
                        <option value="{{ $optionValue }}">{{ strtoupper($optionLabel) }}</option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-light-danger setting-delete-button" data-remove-unsaved title="Remove">
                    <i class="feather icon-trash-2"></i>
                </button>
            </div>
        </div>

        <div class="setting-item-card__body">
            <div class="setting-value-panel" data-type-panel="text">
                <div class="setting-locale-grid">
                    @foreach($localeOptions as $locale => $localeLabel)
                        <div class="setting-locale-field">
                            <label>{{ $localeLabel }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name="items[__INDEX__][value_{{ $locale }}]"
                                value=""
                                placeholder="Masukkan nilai {{ $localeLabel }}"
                                data-setting-value-input
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="setting-value-panel d-none" data-type-panel="longtext">
                <div class="setting-locale-grid">
                    @foreach($localeOptions as $locale => $localeLabel)
                        <div class="setting-locale-field">
                            <label>{{ $localeLabel }}</label>
                            <textarea
                                class="form-control"
                                name="items[__INDEX__][value_{{ $locale }}]"
                                rows="5"
                                placeholder="Masukkan long text {{ $localeLabel }}"
                                data-setting-value-input
                                disabled
                            ></textarea>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="setting-value-panel d-none" data-type-panel="list">
                <div class="setting-locale-grid">
                    @foreach($localeOptions as $locale => $localeLabel)
                        <div class="setting-locale-field">
                            <label>{{ $localeLabel }}</label>
                            <textarea
                                class="form-control"
                                name="items[__INDEX__][value_{{ $locale }}]"
                                rows="5"
                                placeholder="Satu item per baris"
                                data-setting-value-input
                                disabled
                            ></textarea>
                        </div>
                    @endforeach
                </div>
                <small class="text-muted d-block mt-50">Setiap baris akan disimpan sebagai item list terpisah.</small>
            </div>

            <div class="setting-value-panel d-none" data-type-panel="image">
                <div class="setting-image-upload">
                    <div class="setting-image-preview is-empty" data-setting-image-preview>
                        <div class="setting-image-placeholder">
                            <i class="feather icon-image"></i>
                            <span>Belum ada gambar</span>
                        </div>
                    </div>
                    <div class="setting-image-input">
                        <input type="file" class="form-control-file" name="items[__INDEX__][image]" accept="image/*" data-setting-image-input>
                        <small class="text-muted d-block mt-50">Upload JPG, PNG, atau WEBP untuk mengganti gambar.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="setting-item-card__footer">
            <div class="setting-key-meta">
                <span class="setting-key-meta__label">Database Key:</span>
                <span class="setting-key-meta__value" data-setting-key-badge>otomatis_dari_label</span>
            </div>
        </div>
    </div>
</template>
@endsection

@push('styles')
<style>
    .settings-builder-page {
        padding-bottom: 2rem;
    }

    .settings-sidebar-card,
    .setting-item-card {
        border-radius: 22px;
    }

    .settings-sidebar-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .settings-sidebar-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        background: rgba(115, 103, 240, .12);
        color: #7367f0;
        font-size: 1.15rem;
    }

    .settings-sidebar-label {
        display: block;
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #8e95a9;
        margin-bottom: .9rem;
        font-weight: 700;
    }

    .settings-group-list {
        display: flex;
        flex-direction: column;
        gap: .6rem;
    }

    .settings-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: .95rem 1rem;
        border-radius: 16px;
        color: #4b5675;
        background: #f8f8fb;
        transition: .2s ease;
        font-weight: 600;
    }

    .settings-group-item small {
        color: inherit;
        opacity: .7;
    }

    .settings-group-item:hover,
    .settings-group-item.is-active {
        color: #fff;
        background: linear-gradient(135deg, #5f27ff, #7367f0);
        box-shadow: 0 14px 28px rgba(95, 39, 255, .22);
        text-decoration: none;
    }

    .settings-builder-topbar {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    .settings-breadcrumb {
        font-size: .95rem;
        margin-bottom: .35rem;
    }

    .settings-builder-title {
        font-size: 2.2rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .settings-builder-actions {
        display: flex;
        gap: .75rem;
        flex-wrap: wrap;
    }

    .settings-publish-button {
        min-width: 180px;
        border-radius: 14px;
        box-shadow: 0 14px 24px rgba(115, 103, 240, .18);
    }

    .setting-item-card {
        background: #fff;
        border: 1px solid rgba(115, 103, 240, .08);
        box-shadow: 0 16px 40px rgba(15, 23, 42, .06);
        padding: 1.4rem;
        margin-bottom: 1.25rem;
    }

    .setting-item-card__header,
    .setting-item-card__footer {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: flex-start;
    }

    .setting-item-card__identity {
        flex: 1 1 auto;
    }

    .setting-item-card__label {
        display: block;
        margin-bottom: .6rem;
        font-size: .76rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #8e95a9;
        letter-spacing: .08em;
    }

    .setting-item-card__controls {
        display: flex;
        gap: .75rem;
        align-items: center;
    }

    .setting-type-select {
        min-width: 160px;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .setting-delete-button {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        padding: 0;
    }

    .setting-item-card__body {
        border-top: 1px solid #edf0f7;
        border-bottom: 1px solid #edf0f7;
        padding: 1.25rem 0;
        margin: 1.1rem 0;
    }

    .setting-locale-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .9rem;
    }

    .setting-locale-field label {
        display: block;
        margin-bottom: .45rem;
        color: #8e95a9;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .setting-key-meta {
        display: flex;
        align-items: center;
        gap: .55rem;
        flex-wrap: wrap;
    }

    .setting-key-meta__label {
        color: #8e95a9;
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        font-weight: 700;
    }

    .setting-key-meta__value {
        display: inline-flex;
        align-items: center;
        padding: .3rem .65rem;
        border-radius: 999px;
        background: rgba(115, 103, 240, .1);
        color: #5f27ff;
        font-weight: 700;
        font-size: .82rem;
    }

        .setting-image-upload {
            display: flex;
            flex-direction: column;
            gap: .85rem;
    }

    .setting-image-preview {
        min-height: 220px;
        border: 2px dashed rgba(115, 103, 240, .18);
        border-radius: 18px;
        overflow: hidden;
        background: #fbfbfe;
    }

    .setting-image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .setting-image-preview.is-empty {
        display: grid;
        place-items: center;
    }

    .setting-image-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .55rem;
        color: #8e95a9;
        font-weight: 600;
    }

    .setting-image-placeholder i {
        font-size: 1.5rem;
    }

    .settings-empty-state {
        border: 1px dashed rgba(115, 103, 240, .22);
        border-radius: 22px;
        padding: 3rem 1.5rem;
        text-align: center;
        background: #fff;
    }

    .settings-empty-state__icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 1rem;
        border-radius: 20px;
        display: grid;
        place-items: center;
        font-size: 1.5rem;
        color: #7367f0;
        background: rgba(115, 103, 240, .1);
    }

        @media (max-width: 991.98px) {
            .settings-builder-topbar,
            .setting-item-card__header,
            .setting-item-card__footer {
                flex-direction: column;
            }

            .setting-type-select {
                width: 100%;
                min-width: 0;
            }

            .setting-locale-grid {
                grid-template-columns: 1fr;
            }
        }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        const container = document.getElementById('settings-items-container');
        const addButton = document.getElementById('add-setting-item');
        const template = document.getElementById('setting-item-template');
        let nextIndex = {{ count($builderItems) }};

        function updateKeyBadge(card) {
            const labelInput = card.querySelector('[data-setting-label]');
            const badge = card.querySelector('[data-setting-key-badge]');
            const existingKey = (card.dataset.settingExistingKey || '').trim();
            const idInput = card.querySelector('input[name$="[id]"]');
            const isExisting = idInput && (idInput.value || '').trim() !== '';

            if (!labelInput || !badge) {
                return;
            }

            const value = isExisting
                ? existingKey
                : toSnakeCase(labelInput.value);

            badge.textContent = value !== '' ? value : 'otomatis_dari_label';
        }

        function toSnakeCase(value) {
            return (value || '')
                .normalize('NFKD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^A-Za-z0-9]+/g, '_')
                .replace(/([a-z0-9])([A-Z])/g, '$1_$2')
                .replace(/_+/g, '_')
                .replace(/^_+|_+$/g, '')
                .toLowerCase()
                .slice(0, 100);
        }

        function syncKeyFromLabel(card, force = false) {
            const labelInput = card.querySelector('[data-setting-label]');
            if (!labelInput) {
                return;
            }
            updateKeyBadge(card);
        }

        function syncVisibleValuePanel(card) {
            const typeSelect = card.querySelector('[data-setting-type]');
            const activeType = typeSelect ? typeSelect.value : 'text';

            card.querySelectorAll('[data-type-panel]').forEach((panel) => {
                const isActive = panel.dataset.typePanel === activeType;
                panel.classList.toggle('d-none', !isActive);

                panel.querySelectorAll('[data-setting-value-input]').forEach((field) => {
                    field.disabled = !isActive;
                });
            });
        }

        function bindImagePreview(card) {
            const input = card.querySelector('[data-setting-image-input]');
            const preview = card.querySelector('[data-setting-image-preview]');

            if (!input || !preview || input.dataset.previewBound === '1') {
                return;
            }

            input.dataset.previewBound = '1';

            input.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    preview.classList.remove('is-empty');
                    preview.innerHTML = '<img src="' + event.target.result + '" alt="Setting image preview">';
                };
                reader.readAsDataURL(file);
            });
        }

        function bindCard(card) {
            if (!card) {
                return;
            }

            syncVisibleValuePanel(card);
            updateKeyBadge(card);
            bindImagePreview(card);

            const typeSelect = card.querySelector('[data-setting-type]');
            const labelInput = card.querySelector('[data-setting-label]');

            if (typeSelect && typeSelect.dataset.bound !== '1') {
                typeSelect.dataset.bound = '1';
                typeSelect.addEventListener('change', function () {
                    syncVisibleValuePanel(card);
                });
            }

            if (labelInput && labelInput.dataset.bound !== '1') {
                labelInput.dataset.bound = '1';
                labelInput.addEventListener('input', function () {
                    syncKeyFromLabel(card);
                });
            }

            syncKeyFromLabel(card);
        }

        function removeUnsavedCard(button) {
            const card = button.closest('[data-setting-item]');

            if (!card) {
                return;
            }

            card.remove();
            toggleEmptyState();
        }

        function toggleEmptyState() {
            const emptyState = document.getElementById('settings-empty-state');
            const hasCards = container.querySelector('[data-setting-item]') !== null;

            if (!emptyState) {
                return;
            }

            emptyState.classList.toggle('d-none', hasCards);
        }

        function createCard() {
            const markup = template.innerHTML.replaceAll('__INDEX__', nextIndex);
            nextIndex += 1;

            const wrapper = document.createElement('div');
            wrapper.innerHTML = markup.trim();

            return wrapper.firstElementChild;
        }

        container.querySelectorAll('[data-setting-item]').forEach(bindCard);
        toggleEmptyState();

        if (addButton) {
            addButton.addEventListener('click', function () {
                const card = createCard();
                container.appendChild(card);
                bindCard(card);
                toggleEmptyState();
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }

        document.addEventListener('click', function (event) {
            const removeButton = event.target.closest('[data-remove-unsaved]');
            if (removeButton) {
                removeUnsavedCard(removeButton);
                return;
            }

            const deleteButton = event.target.closest('[data-setting-delete-url]');
            if (!deleteButton) {
                return;
            }

            event.preventDefault();

            const deleteUrl = deleteButton.dataset.settingDeleteUrl;

            const submitDelete = function () {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.style.display = 'none';
                form.innerHTML =
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                    '<input type="hidden" name="_method" value="DELETE">';
                document.body.appendChild(form);
                form.submit();
            };

            if (window.Swal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus setting ini?',
                    text: 'Data yang dihapus tidak bisa dikembalikan.',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#ea5455',
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitDelete();
                    }
                });
            } else if (window.confirm('Hapus setting ini?')) {
                submitDelete();
            }
        });
    })();
</script>
@endpush
