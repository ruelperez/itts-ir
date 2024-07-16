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
            $table->id();
            $table->string('date');
            $table->string('campaign');
            $table->string('client');
            $table->string('caseType');
            $table->string('injuredParty');
            $table->string('claimant')->nullable();
            $table->string('phoneNumber');
            $table->string('altPhoneNumber');
            $table->string('dob');
            $table->string('email');
            $table->string('address');
            $table->string('ssn');
            $table->string('agent');
            $table->string('coach');
            $table->string('verifier');
            $table->string('source');
            $table->string('result');
            $table->timestamps();
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
