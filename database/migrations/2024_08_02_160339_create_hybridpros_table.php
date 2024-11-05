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
        Schema::create('hybridpros', function (Blueprint $table) {
            $table->id('hp_id');
            $table->string('hp_customer_name', 100);
            $table->string('hp_phone_number', 13)->nullable();
            $table->string('hp_email', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hybridpros');
    }
};
