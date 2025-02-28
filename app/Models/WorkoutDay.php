<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutDay extends Model
{
    use HasFactory;

    protected $table = 'workout_days';
    protected $primaryKey = 'workout_id';

    protected $fillable = [
        'user_id',
        'workout_day',
        'day_index'
    ];
}
