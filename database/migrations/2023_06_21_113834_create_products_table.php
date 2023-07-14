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
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('id_category')->nullable(false);
            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('description', 100);
            $table->smallInteger('quantity');
            $table->smallInteger('weight');
            $table->decimal('price', 10);
            $table->string('brand', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('product');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
