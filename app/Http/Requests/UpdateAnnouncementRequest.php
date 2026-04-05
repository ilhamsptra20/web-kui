<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title_id' => 'required|string',
            'title_en' => 'nullable|string',
            'title_ar' => 'nullable|string',
            'content_id' => 'required',
            'content_en' => 'nullable',
            'content_ar' => 'nullable',
            'file_path' => 'nullable',
            'is_active' => 'boolean',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

}