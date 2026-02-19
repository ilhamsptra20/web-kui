<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'title_id' => 'nullable',
            'image' => 'nullable|image',
            'link' => 'nullable',
            'order' => 'nullable|numeric',
        ];
    }
}