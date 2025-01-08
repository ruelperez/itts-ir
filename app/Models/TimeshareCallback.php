<?php

namespace App\Models;

use Carbon\Carbon;
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
