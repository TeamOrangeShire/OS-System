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
        Schema::create('customer_acc', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('customer_firstname', 100);
            $table->string('customer_middlename', 100);
            $table->string('customer_lastname', 100);
            $table->string('customer_ext', 5);
            $table->string('customer_email', 100);
            $table->string('customer_phone_num', 14);
            $table->string('customer_username', 50);
            $table->string('customer_password', 50);
            $table->string('customer_profile_pic', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_acc');
    }
};
