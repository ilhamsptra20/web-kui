<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = ['title_id', 'title_en', 'title_ar', 'content_id', 'content_en', 'content_ar', 'file_path', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function hasFile(): bool
    {
        return filled($this->file_path);
    }

    public function fileIcon(): string
    {
        $extension = strtolower(pathinfo((string) $this->file_path, PATHINFO_EXTENSION));

        return match ($extension) {
            'pdf' => 'ri-file-pdf-line',
            'doc', 'docx' => 'ri-file-word-line',
            'xls', 'xlsx', 'csv' => 'ri-file-excel-line',
            'ppt', 'pptx' => 'ri-file-ppt-line',
            'jpg', 'jpeg', 'png', 'webp' => 'ri-image-line',
            'zip', 'rar' => 'ri-folder-zip-line',
            default => 'ri-attachment-2',
        };
    }

}
