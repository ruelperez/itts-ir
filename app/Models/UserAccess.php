<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $fillable = [
        'user_id',
        'can_login',
        'dtr_record',
        'campaign_settings',
        'staff_directory',
        'logs',
        'eod',
        'inventory',
        'lead_tracker',
        'user_credential',
        'settings',
        'dashboard_crud',
        'faq_crud',
        'login_special',
        'dtr_task',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    use HasFactory;
}
