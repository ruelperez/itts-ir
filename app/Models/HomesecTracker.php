<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomesecTracker extends Model
{
    protected $fillable = [
        'name',
        'phone_num',
        'alt_num',
        'email',
        'address',
        'disposition',
        'description',
        'agent',
        'coach',
        'date',
        'referenceCityZip',
        'distanceTimeDiff',
        'source',
    ];

    use HasFactory;
}
