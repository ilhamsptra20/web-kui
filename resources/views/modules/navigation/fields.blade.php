@php
    $showMode = $showMode ?? false;
    $selectedArea = old('area', $navigation->area ?? \App\Models\Navigation::AREA_ADMIN);
    $selectedLocation = old('location', $navigation->location ?? \App\Models\Navigation::LOCATION_SIDEBAR);
    $selectedType = old('type', $navigation->type ?? \App\Models\Navigation::TYPE_LINK);
    $selectedParent = old('parent_id', $navigation->parent_id ?? '');
@endphp

<div class="row">
    <div class="col-md-4">
        <x-form.select name="area" label="Area" required :disabled="$showMode">
            @foreach($areaOptions as $value => $label)
                <option value="{{ $value }}" {{ $selectedArea === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-form.select>
    </div>
    <div class="col-md-4">
        <x-form.select name="location" label="Location" required :disabled="$showMode">
            @foreach($locationOptions as $value => $label)
                <option value="{{ $value }}" {{ $selectedLocation === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-form.select>
    </div>
    <div class="col-md-4">
        <x-form.select name="type" label="Type" required :disabled="$showMode">
            @foreach($typeOptions as $value => $label)
                <option value="{{ $value }}" {{ $selectedType === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-form.select>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.select name="parent_id" label="Parent Navigation" :disabled="$showMode">
            <option value="">No Parent</option>
            @foreach($parentOptions as $value => $label)
                <option value="{{ $value }}" {{ $selectedParent === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-form.select>
    </div>
    <div class="col-md-6">
        <x-form.input name="sort_order" type="number" label="Sort Order" :value="$navigation->sort_order ?? 0" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <x-form.input name="title_id" type="text" label="Title Id" :value="$navigation->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
    <div class="col-md-4">
        <x-form.input name="title_en" type="text" label="Title En" :value="$navigation->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
    <div class="col-md-4">
        <x-form.input name="title_ar" type="text" label="Title Ar" :value="$navigation->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.input name="route_name" type="text" label="Route Name" :value="$navigation->route_name ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
    <div class="col-md-6">
        <x-form.input name="url" type="text" label="URL" :value="$navigation->url ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <x-form.input name="icon" type="text" label="Icon Class" :value="$navigation->icon ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
    <div class="col-md-4">
        <x-form.input name="badge_text" type="text" label="Badge Text" :value="$navigation->badge_text ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
    <div class="col-md-4">
        <x-form.input name="badge_class" type="text" label="Badge Class" :value="$navigation->badge_class ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.switch name="is_active" label="Active" :checked="(bool) old('is_active', $navigation->is_active ?? true)" :disabled="$showMode" />
    </div>
    <div class="col-md-6">
        <x-form.switch name="open_in_new_tab" label="Open In New Tab" :checked="(bool) old('open_in_new_tab', $navigation->open_in_new_tab ?? false)" :disabled="$showMode" />
    </div>
</div>

<div class="alert alert-light-info mt-1 mb-0">
    Gunakan <strong>header</strong> untuk section title di sidebar admin. Gunakan <strong>link</strong> untuk item yang benar-benar bisa diklik. Untuk link, isi minimal salah satu: <strong>Route Name</strong> atau <strong>URL</strong>.
</div>
