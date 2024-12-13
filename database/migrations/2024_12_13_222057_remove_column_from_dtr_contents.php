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
            if (Schema::hasColumn('dtr_contents', 'sss')) {
                $table->dropColumn('sss');
            }
            if (Schema::hasColumn('dtr_contents', 'ph')) {
                $table->dropColumn('ph');
            }
            if (Schema::hasColumn('dtr_contents', 'ca')) {
                $table->dropColumn('ca');
            }
            if (Schema::hasColumn('dtr_contents', 'lateDeduction')) {
                $table->dropColumn('lateDeduction');
            }
            if (Schema::hasColumn('dtr_contents', 'totaDeduction')) {
                $table->dropColumn('totaDeduction');
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
