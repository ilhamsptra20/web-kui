<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslation;

class Team extends BaseUuidModel
{
    use HasSlug, HasTranslation;

    protected $fillable = ['position_id', 'npp', 'name', 'image', 'bio_id', 'bio_en', 'bio_ar', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('npp')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

}