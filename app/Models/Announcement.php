<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = [
        'title_id',
        'title_en',
        'content_id',
        'file_path',
        'is_active',
    ];

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
            'pdf' => 'ri-file-pdf-2-line',
            'doc', 'docx' => 'ri-file-word-2-line',
            'xls', 'xlsx', 'csv' => 'ri-file-excel-2-line',
            'zip', 'rar' => 'ri-file-zip-line',
            default => 'ri-file-line',
        };
    }
}
