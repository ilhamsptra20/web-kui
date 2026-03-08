<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLembagaRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'name_id' => 'required',
            'description_id' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ];
    }
}