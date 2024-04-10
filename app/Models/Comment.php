<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'note_id',
        'user_id',
        'text',
        'photo',
        'fullname'
    ];
    use HasFactory;
}
