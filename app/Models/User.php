<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

// Begin Relationship
    // Comments Function
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // requests Function
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    // suggestions Function
    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }
// End Relationship



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        // 'email',
        'password',
        'phone',
        'full_name',
        'level',
        'remember_token',
        'address',
        'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
