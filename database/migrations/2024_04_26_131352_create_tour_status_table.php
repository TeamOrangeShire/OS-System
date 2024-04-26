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
        Schema::create('tour_status', function (Blueprint $table) {
            $table->id('tour_status');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer_acc');
            $table->integer('tour_home');
            $table->integer('tour_login');
            $table->integer('tour_profile');
            $table->integer('tour_reservation');
            $table->integer('tour_subscription');
            $table->integer('tour_settings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_status');
    }
};
