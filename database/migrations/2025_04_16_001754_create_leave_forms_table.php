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
        Schema::create('leave_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('start');
            $table->string('end');
            $table->string('numOfDays');
            $table->string('leaveType');
            $table->string('reason');
            $table->string('signature');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneNum')->nullable();
            $table->string('relationship')->nullable();
            $table->string('remark')->nullable();
            $table->string('timeAdjust')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_forms');
    }
};
