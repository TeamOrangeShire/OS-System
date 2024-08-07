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
        Schema::create('hybridpros_history', function (Blueprint $table) {
            $table->id('hph_id');
            $table->unsignedBigInteger('hp_id');
            $table->foreign('hp_id')->references('hp_id')->on('hybridpros');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('service_id')->on('service_hp');
            $table->string('hp_plan_start', 100);
            $table->string('hp_plan_expire', 100);
            $table->string('hp_plan_expire_new', 100)->nullable();
            $table->string('hp_remaining_time', 20);
            $table->string('hp_consume_time', 100)->nullable();
            $table->integer('hp_inuse_status')->default(0);
            $table->integer('hp_active_status')->default(0);
            $table->integer('hp_payment_status')->default(0);
            $table->string('hp_payment_mode',50);
            $table->integer('hp_transfer_status')->default(0);
            $table->integer('hp_transfer_from_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hybridpros_history');
    }
};
