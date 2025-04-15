<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'numOfDays',
        'leaveType',
        'reason',
        'signature',  // Add the signature column
    ];
}
