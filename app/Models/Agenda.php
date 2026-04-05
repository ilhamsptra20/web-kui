<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslation;

class Agenda extends BaseUuidModel
{
    use HasSlug, HasTranslation;

    protected $fillable = ['name_id', 'name_en', 'name_ar', 'slug', 'description_id', 'description_en', 'description_ar', 'location_id', 'location_en', 'location_ar', 'start_date', 'end_date'];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_id')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

}