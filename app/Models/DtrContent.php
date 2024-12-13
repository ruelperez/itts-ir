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
        'task',
        'branch',
        'schedIn',
        'schedOut',
        'schedIn2',
        'schedOut2',
        'isEarlyOut',
         'lateIn',
        'lateIn2',
        'lateOut',
        'lateOut2',
        'totalLate'
    ];

    use HasFactory;
}
