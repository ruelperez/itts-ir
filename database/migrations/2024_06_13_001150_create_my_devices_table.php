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
        Schema::create('my_devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial');
            $table->integer('quantity');
            $table->string('action');
            $table->string('status');
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_declined')->default(0);
            $table->string('fullname');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_devices');
    }
};
