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
        Schema::table('dtv_trackers', function (Blueprint $table) {
            $table->string('phone_num');
            $table->string('alt_num')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('service');
            $table->string('package')->nullable();
            $table->string('disposition');
            $table->string('agent');
            $table->string('coach');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dtv_trackers', function (Blueprint $table) {
            //
        });
    }
};
