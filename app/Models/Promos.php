<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promos extends Model
{
    use HasFactory;

    protected $table = 'promos';
    protected $guarded = ['id'];
}
