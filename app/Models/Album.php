<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Album extends Model 
{
    use HasUuids, HasSlug;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name_id', 'name_en', 'slug', 'image'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_id')
            ->saveSlugsTo('slug');
    }

}