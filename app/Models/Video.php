<?php

namespace App\Models;

use App\Traits\HasTranslation;

class Video extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = ['title_id', 'title_en', 'title_ar', 'video_url', 'thumbnail', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
