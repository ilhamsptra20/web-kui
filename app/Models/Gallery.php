<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Gallery extends Model 
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['album_id', 'title_id', 'image'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

}