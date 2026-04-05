<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SaveSettingGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation(): void
    {
        $items = collect((array) $this->input('items', []))
            ->values()
            ->map(function (array $item): array {
                $label = trim((string) ($item['label'] ?? ''));

                return [
                    'id' => $item['id'] ?? null,
                    'label' => $label,
                    'generated_key' => Str::limit((string) Str::of(Str::snake($label))
                        ->replaceMatches('/[^a-z0-9_]+/', '_')
                        ->replaceMatches('/_+/', '_')
                        ->trim('_'), 100, ''),
                    'type' => $item['type'] ?? Setting::TYPE_TEXT,
                    'value' => $item['value'] ?? null,
                    'existing_value' => $item['existing_value'] ?? null,
                ];
            })
            ->all();

        $this->merge([
            'group' => trim((string) $this->input('group')),
            'items' => $items,
        ]);
    }

    public function rules(): array
    {
        return [
            'group' => 'required|string|max:100',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|uuid|exists:settings,id',
            'items.*.label' => 'required|string|max:100',
            'items.*.type' => ['required', Rule::in(Setting::typeValues())],
            'items.*.value' => 'nullable|string',
            'items.*.existing_value' => 'nullable|string',
            'items.*.image' => 'nullable|image|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Tambahkan minimal satu setting dalam group ini.',
            'items.min' => 'Tambahkan minimal satu setting dalam group ini.',
            'items.*.image.image' => 'File setting image harus berupa gambar.',
        ];
    }
}
