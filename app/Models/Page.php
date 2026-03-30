<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model 
{
    use HasUuids, HasSlug;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['user_id', 'title_id', 'title_en', 'title_ar', 'slug', 'content_id', 'content_en', 'content_ar', 'status'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('user_id')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}