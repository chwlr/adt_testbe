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
        Schema::create('order', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_product')->nullable(false);
            $table->foreign('id_product')->references('id')->on('product')->onDelete('cascade');
            $table->enum('status', ['paid', 'failed', 'shipped', 'delivered', 'returned', 'complete']);
            $table->decimal('subtotal', 10,2);
            $table->float('tax', 8,2);
            $table->decimal('grandTotal', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
