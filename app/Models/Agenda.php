<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Agenda extends Model
{
    use HasUuids, HasSlug, HasTranslation;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name_id', 'name_en', 'name_ar',
        'slug',
        'description_id', 'description_en', 'description_ar',
        'location_id', 'location_en', 'location_ar',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_id')
            ->saveSlugsTo('slug');
    }

    /**
     * Apakah agenda sedang berlangsung
     */
    public function isOngoing(): bool
    {
        return now()->between($this->start_date, $this->end_date);
    }

    /**
     * Apakah agenda sudah selesai
     */
    public function isPast(): bool
    {
        return now()->isAfter($this->end_date);
    }

    /**
     * Apakah agenda akan datang
     */
    public function isUpcoming(): bool
    {
        return now()->isBefore($this->start_date);
    }
}