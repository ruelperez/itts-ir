<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopPerformer extends Model
{
    protected $fillable = [
        'rank',
        'month',
        'fullname',
        'sale',
        'submission',
        'qa',
        'attendance',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    use HasFactory;
}
