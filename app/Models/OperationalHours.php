<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperationalHours extends Model
{
    use HasFactory;

    protected $table = 'operational_hours';
    protected $guarded = ['id'];
}
