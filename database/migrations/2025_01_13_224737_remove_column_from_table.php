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
        Schema::table('dtr_permanents', function (Blueprint $table) {
            $table->dropColumn('dtr_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dtr_permanents', function (Blueprint $table) {
            $table->string('dtr_id'); // Adjust the column type to match the original
        });
    }
};
