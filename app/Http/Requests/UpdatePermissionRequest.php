<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends StorePermissionRequest
{
    public function rules(): array
    {
        $permissionId = $this->route('permission')?->id;

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'name')->ignore($permissionId, 'id')],
            'slug' => ['required', 'string', 'max:255', Rule::unique('permissions', 'slug')->ignore($permissionId, 'id')],
            'group' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }
}
