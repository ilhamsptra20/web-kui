<?php

namespace App\Models;

use App\Traits\HasTranslation;

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

}