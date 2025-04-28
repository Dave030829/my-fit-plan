<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function challenges()
    {

        return $this->belongsToMany(Challenge::class, 'challenge_user', 'user_id', 'challenge_id')
            ->withPivot(['days_completed', 'last_completed_date'])
            ->withTimestamps();
    }

    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }
}
