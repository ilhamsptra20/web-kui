<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'album_id' => 'required',
            'title_id' => 'nullable',
            'image' => 'required|image',
        ];
    }
}