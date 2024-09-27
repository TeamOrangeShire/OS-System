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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('r_id');
            $table->string('c_name');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('c_email');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->string('c_guest_emails');
            $table->string('phone_num');
            $table->string('status');
            $table->string('reason');
            $table->string('billing');
            $table->integer('pax');
            $table->string('date_cancelled');
            $table->string('date_approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
