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
        Schema::create('payment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user')->nullable(false);
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->uuid('id_order')->nullable(false);
            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade');
            $table->string('method', 15);
            $table->enum('status', ['declined', 'success']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
