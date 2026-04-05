<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslation;

class Page extends BaseUuidModel
{
    use HasSlug, HasTranslation;

    protected $fillable = ['user_id', 'title_id', 'title_en', 'title_ar', 'slug', 'content_id', 'content_en', 'content_ar', 'status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_id')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}