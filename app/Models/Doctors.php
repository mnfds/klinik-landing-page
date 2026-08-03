<?php

namespace App\Models;

use App\Models\DoctorSchedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctors extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $guarded = ['id'];

    public function schedules(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
