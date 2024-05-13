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
        Schema::create('time_settings', function (Blueprint $table) {
            $table->id();
            $table->string('in')->default('10:00 pm')->nullable();
            $table->string('out')->default('1:00 am')->nullable();
            $table->string('in2')->default('2:00 am')->nullable();
            $table->string('out2')->default('7:00 am')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('fullname');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_settings');
    }
};
