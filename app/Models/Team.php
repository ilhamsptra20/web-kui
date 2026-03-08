<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Team extends Model 
{
    use HasUuids, HasSlug;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['position_id', 'npp', 'name', 'image', 'bio_id', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

}