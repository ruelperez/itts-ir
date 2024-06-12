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
        'action',
        'is_active',
        'is_approved',
        'is_declined',
        'fullname',
        'inventory_id',
        'user_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_approved' => 'boolean',
        'is_declined' => 'boolean',
    ];
    use HasFactory;
}
