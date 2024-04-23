<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminShow extends Model
{
    protected $fillable = [
        'user_id',
        'on_off',
    ];

    use HasFactory;
}
