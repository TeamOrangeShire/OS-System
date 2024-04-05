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
        Schema::create('customer_notification', function (Blueprint $table) {
            $table->id('notif_id');
            $table->integer('user_id');
            $table->string('user_type', 50);
            $table->string('notif_header', 100);
            $table->string('notif_message');
            $table->string('notif_status', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_notification');
    }
};
