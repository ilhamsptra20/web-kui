<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialMediaRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'name' => 'required|string|min:3',
            'icon' => 'required|string|min:3',
            'link' => 'required|string|url',
        ];
    }
}