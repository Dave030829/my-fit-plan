<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'kcal', 'protein', 'fat', 'carbs', 
        'quantity', 'unit'
    ];
}
