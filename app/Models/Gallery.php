<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = [
        'album_id',
        'title_id',
        'image',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
