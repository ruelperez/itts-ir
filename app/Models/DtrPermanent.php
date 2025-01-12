<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtrPermanent extends Model
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
        'photo',
        'task',
        'branch',
        'lateIn',
        'earlyOut',
        'schedIn',
        'schedOut',
        'schedIn2',
        'schedOut2',
        'isEarlyOut',
        'is_edited'
    ];

    use HasFactory;
}
