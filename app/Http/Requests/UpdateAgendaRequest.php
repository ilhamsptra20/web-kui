<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaRequest extends FormRequest 
{
    public function authorize() { return true; }
    public function rules() 
    {
        return [
            'name_id' => 'required',
            'description_id' => 'nullable',
            'location_id' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ];
    }
}