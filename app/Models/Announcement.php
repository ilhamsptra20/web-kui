<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Announcement extends Model
{
    use HasUuids, HasTranslation;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title_id', 'title_en', 'title_ar',
        'content_id', 'content_en', 'content_ar',
        'file_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Cek apakah announcement punya file attachment
     */
    public function hasFile(): bool
    {
        return !empty($this->file_path);
    }

    /**
     * Ekstensi file untuk menentukan icon
     */
    public function fileExtension(): ?string
    {
        return $this->file_path ? strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION)) : null;
    }

    /**
     * Icon remix berdasarkan tipe file
     */
    public function fileIcon(): string
    {
        return match($this->fileExtension()) {
            'pdf'              => 'ri-file-pdf-line',
            'doc', 'docx'      => 'ri-file-word-line',
            'xls', 'xlsx'      => 'ri-file-excel-line',
            'ppt', 'pptx'      => 'ri-file-ppt-line',
            'zip', 'rar'       => 'ri-file-zip-line',
            'jpg', 'jpeg', 'png', 'webp' => 'ri-image-line',
            default            => 'ri-file-line',
        };
    }
}