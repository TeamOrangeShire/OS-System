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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('sub_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer_acc');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('service_id')->on('service_hp');
            $table->string('sub_start', 50);
            $table->string('sub_end', 50);
            $table->integer('sub_time');
            $table->integer('sub_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
