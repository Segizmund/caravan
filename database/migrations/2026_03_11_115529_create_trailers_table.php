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
        Schema::create('trailers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->index(); 
            
            // Технические характеристики
            $table->integer('length_mm')->nullable();
            $table->integer('width_mm')->nullable();
            $table->integer('board_height_mm')->nullable();
            $table->integer('empty_weight_kg')->nullable();
            $table->integer('max_load_capacity_kg')->nullable();
            $table->integer('tested_load_capacity_kg')->nullable();
            
            // Текстовые характеристики
            $table->string('drawbar')->nullable(); // Дышло
            $table->string('suspension')->nullable(); // Подвеска
            $table->string('coupling_device')->nullable(); // Сцепное устройство
            $table->string('hub')->nullable(); // Ступица
            $table->string('axle')->nullable(); // Ось
            $table->string('floor')->nullable(); // Днище
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trailers');
    }
};
