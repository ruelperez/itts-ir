<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeshare extends Model
{
    protected $fillable = [
        'date',
        'campaign',
        'client',
        'guest1',
        'guest2',
        'phoneNumber',
        'altPhoneNumber',
        'email',
        'day',
        'time',
        'gift',
        'agent',
        'coach',
        'verifier',
        'source',
        'user_name',
        'user_id',
        'leadOwnership',
        'agent2',
        'remarks',
        'result',
        'reason',
    ];
    public function timeshare_log(){
        return $this->hasMany(TimeshareLog::class);
    }
    use HasFactory;
}
