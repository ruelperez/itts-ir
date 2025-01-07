<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeshareLog extends Model
{
    protected $fillable = [
        'user_name',
        'timeshare_id',
        'action',
        'date',
    ];

    use HasFactory;
}
