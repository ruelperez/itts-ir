<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDeduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sss',
        'ph',
        'ca',
        'other',
        'lateDeduction',
        'totalDeduction',
        'dtr_content_id'
    ];

    public function dtr_content(){
        return $this->belongsTo(DtrContent::class);
    }
}
