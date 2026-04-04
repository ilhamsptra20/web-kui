<?php

namespace App\Models;

use App\Traits\HasTranslation;

class Lembaga extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = [
        'name_id',
        'slug',
        'description_id',
        'image',
    ];
}
