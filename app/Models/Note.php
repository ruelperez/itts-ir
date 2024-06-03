<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'user_fullname',
        'tags',
        'campaign',
        'photo',
        'title',
        'client',
        'lawfirm',
        'method',
        'image',
        'did',
        'schedule',
        'geo',
        'restriction',
        'campaign_stat',
        'tcpa',
        'tf',
        'blacklist',
        'thatsthem',
        'dupe',
        'email',
        'govt',
    ];

    protected $casts = [
        'tcpa' => 'boolean',
        'tf' => 'boolean',
        'blacklist' => 'boolean',
        'thatsthem' => 'boolean',
        'dupe' => 'boolean',
        'email' => 'boolean',
        'govt' => 'boolean',
    ];

    use HasFactory;
}
