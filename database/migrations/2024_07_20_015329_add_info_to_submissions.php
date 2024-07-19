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
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('client');
            $table->string('caseType');
            $table->string('injuredParty')->nullable();
            $table->string('dob');
            $table->string('email');
            $table->string('address');
            $table->integer('ssn');
            $table->string('verifier');
            $table->string('source');
            $table->string('result')->nullable();
            $table->string('user_name');
            $table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            //
        });
    }
};
