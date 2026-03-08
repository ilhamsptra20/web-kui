<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'title_id' => 'required',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image',
        ];
    }
}