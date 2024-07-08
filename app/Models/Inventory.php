<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'serial',
        'quantity',
        'status',
        'fullname',
        'user_id',
        'brand_name',
        'deployed_name'
    ];
    use HasFactory;
}
