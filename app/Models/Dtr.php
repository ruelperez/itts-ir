<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtr extends Model
{
    protected $fillable = [
        'fullname',
        'in',
        'out',
        'in2',
        'out2',
        'user_id',
    ];

    use HasFactory;

    public function dtr_permanent(){
        return $this->hasMany(DtrPermanent::class);
    }
}
