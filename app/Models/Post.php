<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends BaseUuidModel
{
    use HasSlug;
    use HasTranslation;

    protected $fillable = [
        'category_id',
        'user_id',
        'title_id',
        'title_en',
        'title_ar',
        'slug',
        'image',
        'content_id',
        'content_en',
        'content_ar',
        'status',
        'meta_title',
        'meta_description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_id')
            ->saveSlugsTo('slug');
    }
}
