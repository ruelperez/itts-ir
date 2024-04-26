<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'action',
        'user_id',
        'comment_id',
        'note_id',
        'fullname',
        'photo'
    ];

    use HasFactory;
}
