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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('author_name'); // Имя
            $table->string('email');       // Почта
            $table->text('comment');       // Текст отзыва
            $table->integer('rating');     // Оценка от 1 до 5
            $table->string('photo')->nullable(); // Ссылка на фото
            
            $table->morphs('reviewable'); // Связь
            $table->boolean('is_approved')->default(false); // Модерация
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
