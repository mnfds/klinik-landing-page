<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerPage extends Model
{
    use HasFactory;

    protected $table = 'banner_pages';
    protected $guarded = ['id'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
