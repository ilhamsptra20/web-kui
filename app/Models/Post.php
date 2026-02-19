<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model 
{
    use HasUuids, HasSlug;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['category_id', 'user_id', 'title_id', 'title_en', 'title_ar', 'slug', 'image', 'content_id', 'content_en', 'content_ar', 'status', 'meta_title', 'meta_description'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_id')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}