<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslation;

class Album extends BaseUuidModel
{
    use HasSlug, HasTranslation;

    protected $fillable = ['name_id', 'name_en', 'name_ar', 'slug', 'image'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_id')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'album_id');
    }

}
