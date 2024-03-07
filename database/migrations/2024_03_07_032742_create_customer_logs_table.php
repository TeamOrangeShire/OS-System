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
        Schema::create('customer_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('log_date', 100);
            $table->string('log_start_time', 100);
            $table->string('log_end_time', 100);
            $table->string('log_firstname', 100);
            $table->string('log_middlename', 100);
            $table->string('log_lastname', 100);
            $table->string('log_ext', 100);
            $table->string('log_email', 100);
            $table->string('log_phone_num', 14);
            $table->integer('log_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_logs');
    }
};
