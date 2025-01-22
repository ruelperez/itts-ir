<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoofingWindowZip extends Model
{
    protected $fillable = [
        'zip',
        'city',
        'state',
    ];

    use HasFactory;
}
