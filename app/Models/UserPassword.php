<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPassword extends Model
{
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'photo',
        'position'
    ];

    use HasFactory;
}
