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
        Schema::create('hybrid_history_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('hph_id');
            $table->foreign('hph_id')->references('hph_id')->on('hybridpros_history');
            $table->string('log_date', 20);
            $table->string('log_time_in', 10);
            $table->string('log_time_out', 10);
            $table->string('log_time_consume', 10);
            $table->string('log_time_remaining', 10);
            $table->integer('log_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hybrid_history_logs');
    }
};
