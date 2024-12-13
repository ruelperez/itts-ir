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
            if (Schema::hasColumn('dtr_contents', 'lateIn')) {
                $table->dropColumn('lateIn');
            }
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
