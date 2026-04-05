<?php

namespace App\Http\Requests;

use App\Models\Navigation;
use Illuminate\Foundation\Http\FormRequest;

class StoreNavigationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'parent_id' => $this->filled('parent_id') ? $this->input('parent_id') : null,
            'url' => $this->filled('url') ? trim((string) $this->input('url')) : null,
            'route_name' => $this->filled('route_name') ? trim((string) $this->input('route_name')) : null,
            'icon' => $this->filled('icon') ? trim((string) $this->input('icon')) : null,
            'badge_text' => $this->filled('badge_text') ? trim((string) $this->input('badge_text')) : null,
            'badge_class' => $this->filled('badge_class') ? trim((string) $this->input('badge_class')) : null,
            'is_active' => $this->boolean('is_active'),
            'open_in_new_tab' => $this->boolean('open_in_new_tab'),
        ]);
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|exists:navigations,id',
            'area' => 'required|in:' . implode(',', array_keys(Navigation::areaOptions())),
            'location' => 'required|in:' . implode(',', array_keys(Navigation::locationOptions())),
            'type' => 'required|in:' . implode(',', array_keys(Navigation::typeOptions())),
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:100',
            'badge_class' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'nullable|boolean',
            'open_in_new_tab' => 'nullable|boolean',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if ($this->input('type') === Navigation::TYPE_LINK && blank($this->input('url')) && blank($this->input('route_name'))) {
                $validator->errors()->add('url', 'Field URL atau Route Name wajib diisi untuk item link.');
            }
        });
    }
}
