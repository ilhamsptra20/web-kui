<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'title_id' => 'required|string|min:5',
            'title_en' => 'nullable|string|min:5',
            'title_ar' => 'nullable|string|min:5',
        ];
    }
}