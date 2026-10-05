<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizQuestion;
use App\Models\McqOption;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // MCQ 1

        $q1 = QuizQuestion::create([
            'course_id' => 1,
            'question_type' => 'mcq',
            'question' => 'What does PHP stand for?',
            'marks' => 1,
            'status' => true,
        ]);

        McqOption::create([
            'quiz_question_id' => $q1->id,
            'option_a' => 'Hypertext Preprocessor',
            'option_b' => 'Personal Home Page',
            'option_c' => 'Programming Home Page',
            'option_d' => 'Private Hyper Processor',
            'correct_answer' => 'A',
        ]);

        // MCQ 2

        $q2 = QuizQuestion::create([
            'course_id' => 1,
            'question_type' => 'mcq',
            'question' => 'Which symbol is used for variables in PHP?',
            'marks' => 1,
            'status' => true,
        ]);

        McqOption::create([
            'quiz_question_id' => $q2->id,
            'option_a' => '#',
            'option_b' => '$',
            'option_c' => '@',
            'option_d' => '&',
            'correct_answer' => 'B',
        ]);

        // MCQ 3

        $q3 = QuizQuestion::create([
            'course_id' => 2,
            'question_type' => 'mcq',
            'question' => 'Which SQL statement is used to retrieve data?',
            'marks' => 1,
            'status' => true,
        ]);

        McqOption::create([
            'quiz_question_id' => $q3->id,
            'option_a' => 'INSERT',
            'option_b' => 'UPDATE',
            'option_c' => 'SELECT',
            'option_d' => 'DELETE',
            'correct_answer' => 'C',
        ]);

        // Written Questions

        QuizQuestion::create([
            'course_id' => 1,
            'question_type' => 'written',
            'question' => 'Explain the MVC architecture in Laravel.',
            'marks' => 10,
            'model_answer' => 'MVC stands for Model View Controller...',
            'status' => true,
        ]);

        QuizQuestion::create([
            'course_id' => 2,
            'question_type' => 'written',
            'question' => 'Explain database normalization.',
            'marks' => 10,
            'model_answer' => 'Normalization is the process of organizing data...',
            'status' => true,
        ]);

        QuizQuestion::create([
            'course_id' => 3,
            'question_type' => 'written',
            'question' => 'Describe Object-Oriented Programming principles.',
            'marks' => 15,
            'model_answer' => 'Encapsulation, Inheritance, Polymorphism and Abstraction.',
            'status' => true,
        ]);
    }
}
