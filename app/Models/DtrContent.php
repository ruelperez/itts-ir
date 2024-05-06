<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtrContent extends Model
{
    protected $fillable = [
        'fullname',
        'in',
        'out',
        'in2',
        'out2',
        'user_id',
        'dtr_id',
        'hour',
        'minute',
        'week',
        'photo',
        'task'
    ];

    use HasFactory;
}
