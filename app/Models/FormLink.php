<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLink extends Model
{
    protected $fillable = [
        'title',
        'textLink',
        'serveFor'
    ];

    use HasFactory;
}
