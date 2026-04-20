<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title_id' => 'required',
            'title_en' => 'nullable',
            'title_ar' => 'nullable',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ];
    }
}
