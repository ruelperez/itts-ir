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
        Schema::table('dtr_contents', function (Blueprint $table) {
            $table->string('lateIn')->nullable();
            $table->string('lateIn2')->nullable();
            $table->string('lateOut')->nullable();
            $table->string('lateOut2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dtr_contents', function (Blueprint $table) {
            //
        });
    }
};
