<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
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
            'image' => 'required|image',
            'bio_id' => 'nullable',
            'bio_en' => 'nullable',
            'bio_ar' => 'nullable',
        ];
    }
}