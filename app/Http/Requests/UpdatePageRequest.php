<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $page = $this->route('page');
        $hasExistingFile = $page instanceof Page && $page->hasFile();
        $requiresFile = $this->input('type') === Page::TYPE_FILE && ! $hasExistingFile;

        return [
            'title_id' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'type' => 'required|in:'.Page::TYPE_TEXT.','.Page::TYPE_FILE,
            'content_id' => 'required_if:type,'.Page::TYPE_TEXT.'|nullable|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'file_upload' => ($requiresFile ? 'required' : 'nullable').'|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'status' => 'boolean',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => $this->input('type', Page::TYPE_TEXT),
            'status' => $this->boolean('status'),
        ]);
    }

}
