<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title_id' => 'required|string',
            'title_en' => 'nullable|string',
            'title_ar' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'content_id' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
        ];
    }
}