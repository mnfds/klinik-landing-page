<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brosurs extends Model
{
    protected $table = 'brosurs';
    protected $fillable = [
        'title',
        'file',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

}
