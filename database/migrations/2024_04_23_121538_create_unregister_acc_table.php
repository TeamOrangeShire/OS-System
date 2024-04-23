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
        Schema::create('unregister_acc', function (Blueprint $table) {
            $table->id('un_id');
            $table->string('un_firstname', 50);
            $table->string('un_middlename', 50);
            $table->string('un_lastname', 50);
            $table->string('un_ext', 50);
            $table->string('un_email', 50);
            $table->string('un_contact', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unregister_acc');
    }
};
