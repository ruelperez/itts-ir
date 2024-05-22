<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyNote extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'fullname',
        'title',
    ];

    use HasFactory;
}
