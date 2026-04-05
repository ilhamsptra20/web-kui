@php
    $showMode = $showMode ?? false;
    $isEdit = isset($user);
    $isVerified = (bool) old('is_email_verified', isset($user) ? (bool) $user->email_verified_at : false);
    $selectedRoles = collect(old('roles', isset($user) ? $user->roles->pluck('id')->all() : []))
        ->filter()
        ->map(fn ($id) => (string) $id)
        ->all();
@endphp

<div class="row">
    <div class="col-md-6">
        <x-form.input name="name" type="text" label="Nama" :value="$user?->name ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
    <div class="col-md-6">
        <x-form.input name="email" type="email" label="Email" :value="$user?->email ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
    </div>
</div>

@if (! $showMode)
    <div class="row">
        <div class="col-md-6">
            <x-form.input
                name="password"
                type="password"
                :label="$isEdit ? 'Password Baru' : 'Password'"
                placeholder="{{ $isEdit ? 'Kosongkan jika tidak ingin mengganti password' : '' }}"
                :required="! $isEdit"
                floating
                divider
            />
        </div>
        <div class="col-md-6">
            <x-form.input
                name="password_confirmation"
                type="password"
                :label="$isEdit ? 'Konfirmasi Password Baru' : 'Konfirmasi Password'"
                placeholder="{{ $isEdit ? 'Ulangi password baru' : '' }}"
                :required="! $isEdit"
                floating
                divider
            />
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <x-form.select name="roles[]" label="Roles" multiple :disabled="$showMode">
            @foreach($roleOptions as $role)
                <option value="{{ $role->id }}" {{ in_array((string) $role->id, $selectedRoles, true) ? 'selected' : '' }}>
                    {{ $role->name }} ({{ $role->slug }})
                </option>
            @endforeach
        </x-form.select>
    </div>
    <div class="col-md-6">
        <x-form.switch name="is_email_verified" label="Email Verified" :checked="$isVerified" :disabled="$showMode" />
    </div>

    @if($showMode)
        <div class="col-md-12">
            <x-form.input
                name="joined_at"
                type="text"
                label="Bergabung"
                :value="optional($user?->created_at)->format('d M Y, H:i') ?? '-'"
                readonly
                disabled
                floating
                divider
            />
        </div>
    @endif
</div>

@if($showMode)
    <div class="alert alert-light-info mt-1 mb-0">
        Password tidak ditampilkan demi keamanan. Kalau perlu ganti password user, gunakan tombol <strong>Edit</strong>.
    </div>
@endif
