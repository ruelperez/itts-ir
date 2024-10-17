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
        Schema::create('user_accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('can_login')->default(true);
            $table->boolean('dtr_record')->default(false);
            $table->boolean('campaign_settings')->default(false);
            $table->boolean('staff_directory')->default(false);
            $table->boolean('logs')->default(false);
            $table->boolean('eod')->default(false);
            $table->boolean('inventory')->default(false);
            $table->boolean('lead_tracker')->default(false);
            $table->boolean('user_credential')->default(false);
            $table->boolean('settings')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accesses');
    }
};
