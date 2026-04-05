<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInboxRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
            'is_read' => 'boolean',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_read' => $this->boolean('is_read'),
        ]);
    }

}