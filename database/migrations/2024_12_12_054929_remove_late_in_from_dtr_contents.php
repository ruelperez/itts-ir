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
        Schema::table('dtr_contents', function (Blueprint $table) {
            $table->dropColumn('sss'); // Remove the column
            $table->dropColumn('ph'); // Remove the column
            $table->dropColumn('ca'); // Remove the column
            $table->dropColumn('lateDeduction'); // Remove the column
            $table->dropColumn('totaDeduction'); // Remove the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dtr_contents', function (Blueprint $table) {
            //
        });
    }
};
