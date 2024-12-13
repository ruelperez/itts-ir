<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDeduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sss',
        'ph',
        'ca',
        'lateDeduction',
        'totalDeduction',
    ];
}
