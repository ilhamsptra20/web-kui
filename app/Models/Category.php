<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model 
{
    use HasUuids, HasTranslation;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['title_id', 'title_en', 'title_ar'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}