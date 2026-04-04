<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = [
        'name_id',
        'name_en',
        'slug',
        'image',
    ];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
