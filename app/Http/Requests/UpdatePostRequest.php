<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title_id' => 'required|string',
            'title_en' => 'nullable|string',
            'title_ar' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'content_id' => 'required',
            'content_en' => 'nullable',
            'content_ar' => 'nullable',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
        ];
    }
}