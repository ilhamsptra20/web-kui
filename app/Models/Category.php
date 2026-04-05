<?php

namespace App\Models;

use App\Traits\HasTranslation;

class Category extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = ['title_id', 'title_en', 'title_ar'];

}