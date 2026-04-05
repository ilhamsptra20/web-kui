<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorVisit extends Model
{
    protected $fillable = [
        'visitor_key',
        'session_id',
        'route_name',
        'first_path',
        'last_path',
        'browser_name',
        'browser_version',
        'os_name',
        'os_version',
        'device_type',
        'is_bot',
        'page_views',
        'visited_on',
        'first_visited_at',
        'last_visited_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_bot' => 'boolean',
            'visited_on' => 'date',
            'first_visited_at' => 'datetime',
            'last_visited_at' => 'datetime',
        ];
    }
}
