<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';
    protected $fillable = [
        'title',
        'description',
        'difficulty',
        'duration_in_days',
    ];

    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'challenge_user',
            'challenge_id',
            'user_id'
        )
            ->withPivot('days_completed', 'last_completed_date')
            ->withTimestamps();
    }
}
