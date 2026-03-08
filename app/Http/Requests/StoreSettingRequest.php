<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'key' => 'required|unique:settings,key',
            'value' => 'nullable',
        ];
    }
}