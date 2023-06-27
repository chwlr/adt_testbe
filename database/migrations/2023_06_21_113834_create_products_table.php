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
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_category')->nullable(false);
            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade');
            $table->string('name', 50)->change();
            $table->string('description', 100)->change();
            $table->smallInteger('quantity');
            $table->smallInteger('weight');
            $table->decimal('price', 10, 2);
            $table->string('brand', 15)->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
