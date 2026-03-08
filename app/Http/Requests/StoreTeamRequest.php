<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'position_id' => 'required',
            'npp' => 'nullable|unique:teams,npp',
            'name' => 'required',
            'image' => 'required|image',
            'bio_id' => 'nullable',
        ];
    }
}