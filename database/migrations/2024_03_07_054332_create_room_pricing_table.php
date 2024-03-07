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
        Schema::create('room_pricing', function (Blueprint $table) {
            $table->id('rprice_id');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->integer('room_rates');
            $table->integer('room_price');
            $table->unsignedBigInteger('promo_id');
            $table->foreign('promo_id')->references('promo_id')->on('promos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_pricing');
    }
};
