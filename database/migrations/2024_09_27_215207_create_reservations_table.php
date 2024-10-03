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
            $table->string('c_name')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('c_email')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->string('c_guest_emails')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('billing')->nullable();
            $table->integer('pax')->nullable();
            $table->string('request')->nullable();
            $table->integer('rate_id')->nullable();
            $table->string('date_cancelled')->nullable();
            $table->string('date_approved')->nullable();
            $table->string('transaction_id')->nullable();
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
