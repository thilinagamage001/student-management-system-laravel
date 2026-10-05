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
        Schema::create('quiz_questions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('course_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->enum('question_type', [
            'mcq',
            'written'
        ]);

        $table->text('question');

        $table->integer('marks')
            ->default(1);

        $table->text('model_answer')
            ->nullable();

        $table->boolean('status')
            ->default(true);

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
