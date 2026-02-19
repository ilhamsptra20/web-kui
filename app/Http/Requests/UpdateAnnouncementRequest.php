<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'title_id' => 'required|string',
            'title_en' => 'nullable|string',
            'content_id' => 'required',
            'file_path' => 'nullable',
            'is_active' => 'boolean',
        ];
    }
}