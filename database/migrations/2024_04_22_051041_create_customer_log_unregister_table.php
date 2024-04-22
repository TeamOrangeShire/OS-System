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
        Schema::create('customer_log_unregister', function (Blueprint $table) {
            $table->id('unregister_id');
            $table->string('un_firstname',30);
            $table->string('un_middlename',30);
            $table->string('un_lastname',30);
            $table->string('un_ext',10);
            $table->string('un_email',30);
            $table->string('un_number',30);
            $table->string('un_log_date',30);
            $table->string('un_log_start_time',30);
            $table->string('un_log_end_time',30);
            $table->integer('un_log_status');
            $table->string('un_log_transaction',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_log_unregister');
    }
};
