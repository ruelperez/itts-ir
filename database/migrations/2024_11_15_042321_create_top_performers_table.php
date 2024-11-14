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
        Schema::create('top_performers', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('rank')->nullable();
            $table->string('fullname')->nullable();
            $table->string('sale')->nullable();
            $table->string('submission')->nullable();
            $table->string('qa')->nullable();
            $table->string('attendance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_performers');
    }
};
