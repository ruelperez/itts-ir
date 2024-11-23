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
        Schema::create('callbacks', function (Blueprint $table) {
            $table->id();
            $table->string('callbackTime');
            $table->string('claimant');
            $table->string('phoneNumber');
            $table->string('altPhoneNumber');
            $table->string('campaign');
            $table->string('injuredParty');
            $table->string('dob');
            $table->string('email');
            $table->string('address');
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
        Schema::dropIfExists('callbacks');
    }
};
