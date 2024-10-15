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
        Schema::table('homesec_trackers', function (Blueprint $table) {
            $table->string('date');
            $table->string('name');
            $table->string('phone_num');
            $table->string('alt_num')->nullable();
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('disposition');
            $table->string('description')->nullable();
            $table->string('agent');
            $table->string('coach');
            $table->string('source');
            $table->string('campaign')->default('Home-Security');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homesec_trackers', function (Blueprint $table) {
            //
        });
    }
};
