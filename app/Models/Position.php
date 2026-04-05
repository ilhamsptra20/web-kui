<?php

namespace App\Models;

use App\Traits\HasTranslation;

class Position extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = ['name_id', 'name_en', 'name_ar'];

    public function teams()
    {
        return $this->hasMany(Team::class, 'position_id');
    }

}
