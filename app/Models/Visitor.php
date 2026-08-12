<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'visitor_id',
        'ip_address',
        'user_agent',
        'page',
        'visited_date',
    ];

    protected $casts = [
        'visited_date' => 'date',
    ];
}
