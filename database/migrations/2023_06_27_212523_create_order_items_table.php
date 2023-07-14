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
        Schema::create('order_item', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_product')->nullable(false);
            $table->foreign('id_product')->references('id')->on('product')->onDelete('cascade');
            $table->uuid('id_order')->nullable(false);
            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade');
            $table->decimal('price', 10,2);
            $table->smallInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('order_item');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
