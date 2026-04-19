<?php

namespace App\Http\Requests;

use App\Models\Navigation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'area' => Navigation::AREA_MARKETING,
            'location' => $this->filled('location') ? $this->input('location') : Navigation::LOCATION_NAVBAR,
            'type' => Navigation::TYPE_LINK,
            'module_key' => $this->filled('module_key') ? $this->input('module_key') : null,
            'url' => $this->filled('url') ? trim((string) $this->input('url')) : null,
            'route_name' => $this->filled('route_name') ? trim((string) $this->input('route_name')) : null,
            'icon' => null,
            'badge_text' => null,
            'badge_class' => null,
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
            'module_key' => ['nullable', 'string', Rule::in(array_keys(config('navigator.modules', [])))],
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'nullable|boolean',
            'open_in_new_tab' => 'nullable|boolean',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if (
                $this->input('type') === Navigation::TYPE_LINK
                && blank($this->input('url'))
                && blank($this->input('route_name'))
                && blank($this->input('module_key'))
            ) {
                $validator->errors()->add('url', 'Field URL, Route Name, atau Module CRUD wajib diisi untuk item link.');
            }

            if (filled($this->input('parent_id'))) {
                $parent = Navigation::query()->find($this->input('parent_id'));

                if (! $parent) {
                    return;
                }

                if ($parent->area !== Navigation::AREA_MARKETING) {
                    $validator->errors()->add('parent_id', 'Parent navigation harus berupa menu marketing.');
                }

                if ($parent->location !== $this->input('location')) {
                    $validator->errors()->add('parent_id', 'Parent navigation harus berada di lokasi yang sama.');
                }
            }
        });
    }
}
