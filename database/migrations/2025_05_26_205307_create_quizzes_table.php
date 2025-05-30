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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('imageRef');
            $table->timestamps();
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onDelete('set null');
            $table->foreignId("level_id")
            ->nullable()
            ->constrained("levels")
            ->ondelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
