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
            $table->string('product_name');
            $table->string('description');
            $table->integer('quality');
            $table->string('weight');
            $table->string('price');
            $table->string('brand');
            $table->string('ingredients');
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
