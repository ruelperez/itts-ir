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
        Schema::table('notes', function (Blueprint $table) {
            $table->string('did')->nullable();
            $table->string('schedule')->nullable();
            $table->string('geo')->nullable();
            $table->string('restriction')->nullable();
            $table->string('campaign_stat')->nullable();
            $table->boolean('tcpa')->default('0');
            $table->boolean('tf')->default('0');
            $table->boolean('blacklist')->default('0');
            $table->boolean('thatsthem')->default('0');
            $table->boolean('dupe')->default('0');
            $table->boolean('email')->default('0');
            $table->boolean('govt')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
