<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplayMonth extends Model
{
    protected $fillable = [
        'month',
    ];
    use HasFactory;
}
