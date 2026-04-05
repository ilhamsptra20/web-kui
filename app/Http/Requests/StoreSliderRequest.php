<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'subtitle_id' => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'subtitle_ar' => 'nullable|string|max:255',
            'title_id' => 'nullable',
            'title_en' => 'nullable',
            'title_ar' => 'nullable',
            'description_id' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'btn_text_id' => 'nullable|string|max:100',
            'btn_text_en' => 'nullable|string|max:100',
            'btn_text_ar' => 'nullable|string|max:100',
            'btn_url' => 'nullable|string|max:255',
            'image' => 'required|image',
            'order' => 'nullable|numeric',
        ];
    }
}