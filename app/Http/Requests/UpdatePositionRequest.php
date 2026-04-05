<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name_id' => 'required|string',
            'name_en' => 'nullable|string',
            'name_ar' => 'nullable|string',
        ];
    }
}