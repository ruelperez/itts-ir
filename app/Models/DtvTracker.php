<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtvTracker extends Model
{
    protected $fillable = [
        'name',
        'phone_num',
        'alt_num',
        'email',
        'address',
        'service',
        'package',
        'disposition',
        'agent',
        'coach',
        'result',
        'description',
        'orderNumber',
        'date',
    ];

    use HasFactory;
}
