<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'date',
        'agent',
        'claimant',
        'phoneNumber',
        'altPhoneNumber',
        'campaign',
        'coach',
        'remarks',
        'client',
        'caseType',
        'injuredParty',
        'dob',
        'email',
        'address',
        'ssn',
        'verifier',
        'source',
        'result',
        'user_name',
        'user_id',
        'lawfirm',
        'comment',
        'method',
        'leadOwnership',
        'agent2',
    ];

    public function lead_log(){
        return $this->hasMany(LeadLog::class);
    }

    use HasFactory;
}
