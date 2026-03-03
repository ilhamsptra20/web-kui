<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'content_id' => 'required',
            'content_en' => 'nullable',
            'content_ar' => 'nullable',
            'status' => 'boolean',
        ];
    }
}