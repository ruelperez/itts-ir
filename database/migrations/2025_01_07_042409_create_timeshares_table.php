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
        Schema::create('timeshares', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('campaign');
            $table->string('client');
            $table->string('guest1');
            $table->string('guest2');
            $table->integer('phoneNumber');
            $table->integer('altPhoneNumber');
            $table->string('email');
            $table->string('day');
            $table->string('time');
            $table->string('gift');
            $table->string('agent');
            $table->string('coach');
            $table->string('verifier');
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeshares');
    }
};
