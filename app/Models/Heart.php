<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
    protected $fillable = [
        'note_id',
        'user_id',
    ];

    use HasFactory;
}
