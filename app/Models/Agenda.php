<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Builder;

class Agenda extends BaseUuidModel
{
    use HasTranslation;

    protected $fillable = [
        'name_id',
        'slug',
        'description_id',
        'location_id',
        'start_date',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('start_date', '>', now());
    }

    public function isOngoing(): bool
    {
        if (! $this->start_date) {
            return false;
        }

        if (! $this->end_date) {
            return now()->greaterThanOrEqualTo($this->start_date);
        }

        return now()->between($this->start_date, $this->end_date);
    }

    public function isUpcoming(): bool
    {
        return $this->start_date?->isFuture() ?? false;
    }
}
