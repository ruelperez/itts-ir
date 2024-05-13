<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSetting extends Model
{
    protected $fillable = [
        'in',
        'out',
        'in2',
        'out2',
        'fullname',
        'user_id',
        'photo',
    ];

    use HasFactory;
}
