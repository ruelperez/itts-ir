<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'user_fullname',
        'tags',
    ];

    use HasFactory;
}
