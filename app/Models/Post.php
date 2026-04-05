<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslation;

class Post extends BaseUuidModel
{
    use HasSlug, HasTranslation;

    protected $fillable = ['category_id', 'user_id', 'title_id', 'title_en', 'title_ar', 'slug', 'image', 'content_id', 'content_en', 'content_ar', 'status', 'meta_title', 'meta_description'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_id')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
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