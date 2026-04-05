@php
    $showMode = $showMode ?? false;
    $selectedPermissions = collect(old('permissions', isset($role) ? $role->permissions->pluck('id')->all() : []))
        ->filter()
        ->map(fn ($id) => (string) $id)
        ->all();
@endphp

<div class="row">
    <div class="col-md-6">
        <x-form.input name="name" type="text" label="Role Name" :value="$role?->name ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
    <div class="col-md-6">
        <x-form.input name="slug" type="text" label="Role Slug" :value="$role?->slug ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <x-form.textarea name="description" label="Description" :readonly="$showMode" :disabled="$showMode">{{ $role?->description ?? '' }}</x-form.textarea>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <x-form.select name="permissions[]" label="Permissions" multiple :disabled="$showMode">
            @foreach($permissionOptions as $permission)
                <option value="{{ $permission->id }}" {{ in_array((string) $permission->id, $selectedPermissions, true) ? 'selected' : '' }}>
                    [{{ $permission->group ?: 'general' }}] {{ $permission->name }}
                </option>
            @endforeach
        </x-form.select>
    </div>
    <div class="col-md-4">
        <x-form.switch name="is_active" label="Active" :checked="(bool) old('is_active', $role?->is_active ?? true)" :disabled="$showMode" />
    </div>
</div>
