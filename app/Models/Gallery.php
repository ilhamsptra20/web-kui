<?php

namespace App\Models;

use App\Traits\HasTranslation;

class Gallery extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = ['album_id', 'title_id', 'title_en', 'title_ar', 'image'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

}