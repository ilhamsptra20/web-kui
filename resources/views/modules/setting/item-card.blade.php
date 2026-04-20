@php
    use App\Models\Setting;

    $settingId = $item['id'] ?? null;
    $label = $item['label'] ?? '';
    $key = $item['key'] ?? '';
    $type = $item['type'] ?? Setting::TYPE_TEXT;
    $value = $item['value'] ?? '';
    $localeOptions = $localeOptions ?? Setting::localeOptions();
    $translations = collect($localeOptions)
        ->mapWithKeys(fn (string $localeLabel, string $locale): array => [
            $locale => $item["value_{$locale}"] ?? $item['translations'][$locale] ?? ($locale === Setting::LOCALE_ID ? $value : ''),
        ])
        ->all();
    $existingValue = $item['existing_value'] ?? null;
    $imageUrl = $item['image_url'] ?? Setting::resolveImageUrl($existingValue);
@endphp

<div class="setting-item-card" data-setting-item data-index="{{ $index }}" data-setting-existing-key="{{ $key }}">
    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $settingId }}">
    <input type="hidden" name="items[{{ $index }}][existing_value]" value="{{ $existingValue }}">

    <div class="setting-item-card__header">
        <div class="setting-item-card__identity">
            <label class="setting-item-card__label">Setting Label</label>
            <input
                type="text"
                class="form-control setting-card-title-input"
                name="items[{{ $index }}][label]"
                value="{{ $label }}"
                placeholder="Contoh: About Description"
                data-setting-label
                required
            >
        </div>

        <div class="setting-item-card__controls">
            <select name="items[{{ $index }}][type]" class="form-control setting-type-select" data-setting-type>
                @foreach($typeOptions as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" {{ $type === $optionValue ? 'selected' : '' }}>{{ strtoupper($optionLabel) }}</option>
                @endforeach
            </select>

            @if($settingId)
                <button
                    type="button"
                    class="btn btn-light-danger setting-delete-button"
                    data-setting-delete-url="{{ route('settings.destroy', $settingId) }}"
                    title="Delete"
                >
                    <i class="feather icon-trash-2"></i>
                </button>
            @else
                <button type="button" class="btn btn-light-danger setting-delete-button" data-remove-unsaved title="Remove">
                    <i class="feather icon-trash-2"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="setting-item-card__body">
        <div class="setting-value-panel {{ $type === Setting::TYPE_TEXT ? '' : 'd-none' }}" data-type-panel="text">
            <div class="setting-locale-grid">
                @foreach($localeOptions as $locale => $localeLabel)
                    <div class="setting-locale-field">
                        <label>{{ $localeLabel }}</label>
                        <input
                            type="text"
                            class="form-control"
                            name="items[{{ $index }}][value_{{ $locale }}]"
                            value="{{ $type === Setting::TYPE_TEXT ? ($translations[$locale] ?? '') : '' }}"
                            placeholder="Masukkan nilai {{ $localeLabel }}"
                            data-setting-value-input
                            {{ $type === Setting::TYPE_TEXT ? '' : 'disabled' }}
                        >
                    </div>
                @endforeach
            </div>
        </div>

        <div class="setting-value-panel {{ $type === Setting::TYPE_LONGTEXT ? '' : 'd-none' }}" data-type-panel="longtext">
            <div class="setting-locale-grid">
                @foreach($localeOptions as $locale => $localeLabel)
                    <div class="setting-locale-field">
                        <label>{{ $localeLabel }}</label>
                        <textarea
                            class="form-control"
                            name="items[{{ $index }}][value_{{ $locale }}]"
                            rows="5"
                            placeholder="Masukkan long text {{ $localeLabel }}"
                            data-setting-value-input
                            {{ $type === Setting::TYPE_LONGTEXT ? '' : 'disabled' }}
                        >{{ $type === Setting::TYPE_LONGTEXT ? ($translations[$locale] ?? '') : '' }}</textarea>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="setting-value-panel {{ $type === Setting::TYPE_LIST ? '' : 'd-none' }}" data-type-panel="list">
            <div class="setting-locale-grid">
                @foreach($localeOptions as $locale => $localeLabel)
                    <div class="setting-locale-field">
                        <label>{{ $localeLabel }}</label>
                        <textarea
                            class="form-control"
                            name="items[{{ $index }}][value_{{ $locale }}]"
                            rows="5"
                            placeholder="Satu item per baris"
                            data-setting-value-input
                            {{ $type === Setting::TYPE_LIST ? '' : 'disabled' }}
                        >{{ $type === Setting::TYPE_LIST ? ($translations[$locale] ?? '') : '' }}</textarea>
                    </div>
                @endforeach
            </div>
            <small class="text-muted d-block mt-50">Setiap baris akan disimpan sebagai item list terpisah.</small>
        </div>

        <div class="setting-value-panel {{ $type === Setting::TYPE_IMAGE ? '' : 'd-none' }}" data-type-panel="image">
            <div class="setting-image-upload">
                <div class="setting-image-preview {{ $imageUrl ? '' : 'is-empty' }}" data-setting-image-preview>
                    @if($imageUrl)
                        <img src="{{ $imageUrl }}" alt="{{ $label ?: 'Setting image' }}">
                    @else
                        <div class="setting-image-placeholder">
                            <i class="feather icon-image"></i>
                            <span>Belum ada gambar</span>
                        </div>
                    @endif
                </div>

                <div class="setting-image-input">
                    <input type="file" class="form-control-file" name="items[{{ $index }}][image]" accept="image/*" data-setting-image-input>
                    <small class="text-muted d-block mt-50">Upload JPG, PNG, atau WEBP untuk mengganti gambar.</small>
                </div>
            </div>
        </div>
    </div>

    <div class="setting-item-card__footer">
        <div class="setting-key-meta">
            <span class="setting-key-meta__label">Database Key:</span>
            <span class="setting-key-meta__value" data-setting-key-badge>{{ $key ?: 'belum_diisi' }}</span>
        </div>
    </div>
</div>
