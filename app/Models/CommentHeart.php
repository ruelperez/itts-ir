<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentHeart extends Model
{
    protected $fillable = [
        'note_id',
        'user_id',
        'comment_id',
        'photo',
        'fullname'
    ];

    use HasFactory;
}
