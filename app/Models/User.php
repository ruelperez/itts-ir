<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'is_admin',
        'photo',
        'position',
        'branch'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function comment_heart(){
        return $this->hasMany(CommentHeart::class);
    }

    public function dtr(){
        return $this->hasMany(Dtr::class);
    }
    public function dtr_content(){
        return $this->hasMany(DtrContent::class);
    }
    public function dtr_permanent(){
        return $this->hasMany(DtrPermanent::class);
    }
    public function log(){
        return $this->hasMany(Logs::class);
    }
    public function note(){
        return $this->hasMany(Note::class);
    }
    public function time_setting(){
        return $this->hasMany(TimeSetting::class);
    }
    public function user_password(){
        return $this->hasMany(UserPassword::class);
    }
}
