<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'position_id' => 'required',
            'npp' => 'nullable|unique:teams,npp',
            'name' => 'required',
            'image' => 'nullable|image',
            'bio_id' => 'nullable',
            'bio_en' => 'nullable',
            'bio_ar' => 'nullable',
        ];
    }
}