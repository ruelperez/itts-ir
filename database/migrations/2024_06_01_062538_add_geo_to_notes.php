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
            $table->boolean('tcpa')->default(false);
            $table->boolean('tf')->default(false);
            $table->boolean('blacklist')->default(false);
            $table->boolean('thatsthem')->default(false);
            $table->boolean('dupe')->default(false);
            $table->boolean('email')->default(false);
            $table->boolean('govt')->default(false);
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
