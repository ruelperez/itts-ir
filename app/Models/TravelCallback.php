<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelCallback extends Model
{
    protected $fillable = [
        'guest1',
        'guest2',
        'age1',
        'age2',
        'phoneNumber',
        'altPhoneNumber',
        'email',
        'campaign',
        'user_id',
        'reason',
        'timeRemaining',
        'is_expired',
        'address',
        'destination'
    ];

    public function updateExpirationStatus()
    {
        $expirationTime = $this->created_at->addHours(721); // 336 hours (14 days)
        $remainingHours = Carbon::now()->diffInHours($expirationTime, false);

        // Set time remaining and is_expired flag
        $this->timeRemaining = $remainingHours > 0 ? $remainingHours : 0;
        $this->is_expired = $remainingHours <= 0;

        $this->save(); // Save the updated values
    }

    use HasFactory;
}
