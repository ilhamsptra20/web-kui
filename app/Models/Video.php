<?php

namespace App\Models;

use App\Traits\HasTranslation;

class Video extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = ['title_id', 'title_en', 'title_ar', 'video_url', 'thumbnail'];

}