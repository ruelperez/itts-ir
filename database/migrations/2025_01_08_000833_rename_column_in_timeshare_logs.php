<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the new column
        Schema::table('timeshare_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('timeshare_id')->nullable();
        });

        // Copy data from the old column to the new column
        DB::statement('UPDATE timeshare_logs SET timeshare_id = submission_id');

        // Drop the old column
        Schema::table('timeshare_logs', function (Blueprint $table) {
            $table->dropColumn('submission_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate the old column
        Schema::table('timeshare_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('submission_id')->nullable();
        });

        // Copy data back from the new column to the old column
        DB::statement('UPDATE timeshare_logs SET submission_id = timeshare_id');

        // Drop the new column
        Schema::table('timeshare_logs', function (Blueprint $table) {
            $table->dropColumn('timeshare_id');
        });
    }
};
