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
        Schema::create('submissions', function (Blueprint $table) {
            $table->string('date');
            $table->string('agent');
            $table->string('claimant');
            $table->bigInteger('phoneNumber');
            $table->bigInteger('altPhoneNumber');
            $table->string('campaign');
            $table->string('coach');
            $table->string('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
