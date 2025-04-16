<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start',
        'end',
        'numOfDays',
        'leaveType',
        'reason',
        'signature',  // Add the signature column
        'name',
        'address',
        'phoneNum',
        'relationship',
        'remark',
        'timeAdjust',
        'resume'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
}
