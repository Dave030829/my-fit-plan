<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDiary extends Model
{
    use HasFactory;

    protected $table = 'food_diary';

    protected $fillable = ['user_id', 'food_id', 'quantity', 'unit', 'day'];

}
