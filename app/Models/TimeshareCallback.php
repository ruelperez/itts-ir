<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeshareCallback extends Model
{
    protected $fillable = [
        'guest1',
        'guest2',
        'age1',
        'age2',
        'phoneNumber',
        'altPhoneNumber',
        'email',
        'relationship',
        'campaign',
        'state',
        'day',
        'time',
        'gift',
        'creditCard',
        'is_50k',
        'is_firsTime',
        'user_id',
        'reason',
        'timeRemaining',
        'is_expired',
    ];

    use HasFactory;
}
