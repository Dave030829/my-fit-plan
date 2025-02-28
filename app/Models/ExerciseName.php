<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseName extends Model
{
    use HasFactory;

    protected $table = 'exercise_name';
    protected $primaryKey = 'exercise_id';

    protected $fillable = [
        'workout_id',
        'exercise_name',
        'exercise_index'
    ];
}
