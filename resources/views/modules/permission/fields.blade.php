@php $showMode = $showMode ?? false; @endphp

<div class="row">
    <div class="col-md-6">
        <x-form.input name="name" type="text" label="Permission Name" :value="$permission?->name ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
    <div class="col-md-6">
        <x-form.input name="slug" type="text" label="Permission Slug" :value="$permission?->slug ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-form.input name="group" type="text" label="Group" :value="$permission?->group ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
    </div>
    <div class="col-md-6">
        <x-form.switch name="is_active" label="Active" :checked="(bool) old('is_active', $permission?->is_active ?? true)" :disabled="$showMode" />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.textarea name="description" label="Description" :readonly="$showMode" :disabled="$showMode">{{ $permission?->description ?? '' }}</x-form.textarea>
    </div>
</div>
