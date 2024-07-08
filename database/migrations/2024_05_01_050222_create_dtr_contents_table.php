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
        Schema::create('dtr_contents', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->dateTime('in')->nullable();
            $table->dateTime('out')->nullable();
            $table->dateTime('in2')->nullable();
            $table->dateTime('out2')->nullable();
            $table->string('hour')->nullable();
            $table->string('minute')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dtr_id');
            $table->string('branch');
            $table->string('week')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtr_contents');
    }
};
