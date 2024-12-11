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
        Schema::table('dtr_permanents', function (Blueprint $table) {
            $table->string('schedIn')->nullable();
            $table->string('schedOut')->nullable();
            $table->string('schedIn2')->nullable();
            $table->string('schedOut2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dtr_permanents', function (Blueprint $table) {
            //
        });
    }
};
