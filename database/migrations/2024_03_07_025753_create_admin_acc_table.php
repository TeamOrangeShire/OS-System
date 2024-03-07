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
        Schema::create('admin_acc', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_firstname', 100);
            $table->string('admin_middlename', 100);      
            $table->string('admin_lastname', 100);      
            $table->string('admin_ext', 5);
            $table->string('admin_username', 50);
            $table->string('admin_password', 50);
            $table->string('admin_profile_pic', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_acc');
    }
};
