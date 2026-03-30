<?php

namespace App\Models;

use App\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Slider extends Model 
{
    use HasUuids, HasTranslation;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['subtitle_id', 'subtitle_en', 'subtitle_ar', 'title_id', 'title_en', 'title_ar', 'description_id', 'description_en', 'description_ar', 'btn_text_id', 'btn_text_en', 'btn_text_ar', 'btn_url', 'image', 'order'];

}