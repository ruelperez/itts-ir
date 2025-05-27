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
            $table->string('lawfirm')->nullable()->change();
            $table->string('method')->nullable()->change();
            $table->string('did')->nullable()->change();
            $table->string('tf')->nullable()->change();
            $table->string('geo')->nullable()->change();
            $table->string('schedule')->nullable()->change();
            $table->string('restriction')->nullable()->change();
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
