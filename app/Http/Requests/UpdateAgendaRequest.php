<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name_id' => 'required',
            'name_en' => 'nullable',
            'name_ar' => 'nullable',
            'description_id' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'location_id' => 'nullable',
            'location_en' => 'nullable',
            'location_ar' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ];
    }
}