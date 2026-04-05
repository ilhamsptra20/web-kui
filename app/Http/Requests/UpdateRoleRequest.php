<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateRoleRequest extends StoreRoleRequest
{
    public function rules(): array
    {
        $roleId = $this->route('role')?->id;

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($roleId, 'id')],
            'slug' => ['required', 'string', 'max:255', Rule::unique('roles', 'slug')->ignore($roleId, 'id')],
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => ['uuid', Rule::exists('permissions', 'id')],
        ];
    }
}
