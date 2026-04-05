<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLembagaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name_id' => 'required',
            'name_en' => 'nullable',
            'name_ar' => 'nullable',
            'description_id' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ];
    }
}