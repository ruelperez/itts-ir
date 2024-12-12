<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'basic',
        'nightDiff',
        'allowance',
        'holiday',
        'ot',
        'other',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
