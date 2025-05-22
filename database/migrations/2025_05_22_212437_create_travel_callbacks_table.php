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
        Schema::create('travel_callbacks', function (Blueprint $table) {
            $table->id();
            $table->string('guest1');
            $table->string('guest2');
            $table->string('age1');
            $table->string('age2');
            $table->string('phoneNumber');
            $table->string('altPhoneNumber');
            $table->string('email');
            $table->string('campaign');
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
        Schema::dropIfExists('travel_callbacks');
    }
};
