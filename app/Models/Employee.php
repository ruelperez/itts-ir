<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'mi',
        'mname',
        'suffix',
        'age',
        'phone_number',
        'dob',
        'gender_preference',
        'civil_status',
        'religion',
        'personal_email',
        'current_house',
        'current_street',
        'current_brgy',
        'current_city',
        'current_working_email',
        'permanent_house',
        'permanent_street',
        'permanent_brgy',
        'permanent_city',
        'sss',
        'philhealth',
        'tin',
        'hire_date',
        'yot',
        'designation',
        'department',
        'contact_number',
        'address',
        'relationship',
        'user_id',
        'branch',
        'fullname',
        'status',
        'id_user',
        'employeeFullname',
        'dailyRate',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
