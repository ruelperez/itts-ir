<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('mi');
            $table->string('mname');
            $table->string('suffix');
            $table->string('age');
            $table->string('phone_number');
            $table->string('dob');
            $table->string('gender_preference');
            $table->string('civil_status');
            $table->string('religion');
            $table->string('personal_email');
            $table->string('current_house');
            $table->string('current_street');
            $table->string('current_brgy');
            $table->string('current_city');
            $table->string('current_working_email');
            $table->string('permanent_house');
            $table->string('permanent_street');
            $table->string('permanent_brgy');
            $table->string('permanent_city');
            $table->string('permanent_working_email');
            $table->string('sss');
            $table->string('philhealth');
            $table->string('tin');
            $table->string('hire_date');
            $table->string('yot');
            $table->string('designation');
            $table->string('department');
            $table->string('contact_number');
            $table->string('address');
            $table->string('relationship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
