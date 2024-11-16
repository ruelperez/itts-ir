<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadLog extends Model
{
    protected $fillable = [
        'date',
        'submission_id',
        'action',
        'user_name',
    ];

    use HasFactory;
}
