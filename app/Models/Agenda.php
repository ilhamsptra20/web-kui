<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Agenda extends Model 
{
    use HasUuids, HasSlug;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name_id', 'slug', 'description_id', 'location_id', 'start_date', 'end_date'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_id')
            ->saveSlugsTo('slug');
    }

}