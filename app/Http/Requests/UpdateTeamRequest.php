<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'position_id' => 'required',
            'npp' => 'nullable|unique:teams,npp',
            'name' => 'required',
            'image' => 'nullable|image',
            'bio_id' => 'nullable',
        ];
    }
}