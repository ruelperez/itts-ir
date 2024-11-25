<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $fillable = [
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
    'timeRemaining',
    'is_expired',
];

    // Update the 'is_expired' and 'timeRemaining' based on the record age
    public function updateExpirationStatus()
    {
        $expirationTime = $this->created_at->addHours(721); // 336 hours (14 days)
        $remainingHours = Carbon::now()->diffInHours($expirationTime, false);

        // Set time remaining and is_expired flag
        $this->timeRemaining = $remainingHours > 0 ? $remainingHours : 0;
        $this->is_expired = $remainingHours <= 0;

        $this->save(); // Save the updated values
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    use HasFactory;
}
