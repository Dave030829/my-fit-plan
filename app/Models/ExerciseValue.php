<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseValue extends Model
{
    use HasFactory;

    protected $table = 'exercise_values';

    protected $fillable = [
        'exercise_id',
        'set_number',
        'weight',
        'sets',
        'done'
    ];
}
