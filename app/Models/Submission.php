<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'date',
        'campaign',
        'client',
        'caseType',
        'injuredParty',
        'claimant',
        'phoneNumber',
        'altPhoneNumber',
        'dob',
        'email',
        'address',
        'ssn',
        'agent',
        'coach',
        'verifier',
        'source',
        'result',
    ];

    use HasFactory;
}
