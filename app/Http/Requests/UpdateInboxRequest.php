<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInboxRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
            'is_read' => 'boolean',
        ];
    }
}