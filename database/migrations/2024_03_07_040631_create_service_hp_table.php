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
        Schema::create('service_hp', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('service_name', 100);
            $table->integer('service_hours');
            $table->integer('service_price');
            $table->integer('service_days');
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
        Schema::dropIfExists('service_hp');
    }
};
