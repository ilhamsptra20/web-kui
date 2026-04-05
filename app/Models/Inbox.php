<?php

namespace App\Models;



class Inbox extends BaseUuidModel
{
    

    protected $fillable = ['name', 'email', 'subject', 'message', 'is_read'];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

}