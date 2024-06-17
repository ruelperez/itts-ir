<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyDevice extends Model
{
    protected $fillable = [
        'name',
        'serial',
        'quantity',
        'status',
        'brand_name',
        'fullname',
        'inventory_id',
        'user_id',
    ];

    use HasFactory;
}
