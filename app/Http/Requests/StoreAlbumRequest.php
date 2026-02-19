<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlbumRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'name_id' => 'required|string',
            'name_en' => 'nullable|string',
            'image' => 'nullable|image',
        ];
    }
}