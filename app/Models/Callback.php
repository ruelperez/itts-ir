<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $fillable = [
    'callbackTime',
    'claimant',
    'phoneNumber',
    'altPhoneNumber',
    'campaign',
    'injuredParty',
    'dob',
    'email',
    'address',
    'user_id',
    'reason',
];

    // Accessor to calculate hours remaining until expiration (336 hours = 14 days)
    public function getHoursRemainingAttribute()
    {
        $expirationTime = $this->created_at->addHours(336);
        $remainingHours = Carbon::now()->diffInHours($expirationTime, false);

        return $remainingHours > 0 ? $remainingHours : 0;
    }

    use HasFactory;
}
