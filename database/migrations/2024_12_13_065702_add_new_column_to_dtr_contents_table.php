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
            $table->double('sss');
            $table->double('ph');
            $table->double('ca');
            $table->double('lateDeduction');
            $table->double('totaDeduction');
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
