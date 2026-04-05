<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'album_id' => 'required',
            'title_id' => 'nullable',
            'title_en' => 'nullable',
            'title_ar' => 'nullable',
            'image' => 'nullable|image',
        ];
    }
}