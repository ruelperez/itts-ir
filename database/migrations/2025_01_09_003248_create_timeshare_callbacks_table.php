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
        Schema::create('timeshare_callbacks', function (Blueprint $table) {
            $table->id();
            $table->string('guest1');
            $table->string('guest2');
            $table->string('age1');
            $table->string('age2');
            $table->string('phoneNumber');
            $table->string('altPhoneNumber');
            $table->string('email');
            $table->string('relationship');
            $table->string('campaign');
            $table->string('state');
            $table->string('day');
            $table->string('time');
            $table->string('gift');
            $table->string('creditCard');
            $table->boolean('is_50k');
            $table->boolean('is_firsTime');
            $table->string('user_id');
            $table->string('reason');
            $table->string('timeRemaining');
            $table->boolean('is_expired')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeshare_callbacks');
    }
};
