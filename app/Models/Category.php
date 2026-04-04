<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = [
        'title_id',
        'title_en',
        'title_ar',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
