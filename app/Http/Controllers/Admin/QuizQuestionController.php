<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\McqOption;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('status', 'active')->get();

        $questions = QuizQuestion::with([
                'course',
                'mcqOption'
            ])
            ->when($request->course_id, function ($query) use ($request) {
                $query->where(
                    'course_id',
                    $request->course_id
                );
            })
            ->latest()
            ->paginate(15);

        return view(
            'admin.quiz-bank.index',
            compact(
                'questions',
                'courses'
            )
        );
    }

    public function create()
    {
        $courses = Course::where(
            'status',
            'active'
        )->get();

        return view(
            'admin.quiz-bank.create',
            compact('courses')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'course_id' =>
                'required|exists:courses,id',

            'question_type' =>
                'required|in:mcq,written',

            'question' =>
                'required|string',

            'marks' =>
                'required|integer|min:1',

        ]);

        DB::transaction(function () use ($request) {

            $question = QuizQuestion::create([

                'course_id' =>
                    $request->course_id,

                'question_type' =>
                    $request->question_type,

                'question' =>
                    $request->question,

                'marks' =>
                    $request->marks,

                'model_answer' =>
                    $request->model_answer,

                'status' => true

            ]);

            if (
                $request->question_type === 'mcq'
            ) {

                McqOption::create([

                    'quiz_question_id' =>
                        $question->id,

                    'option_a' =>
                        $request->option_a,

                    'option_b' =>
                        $request->option_b,

                    'option_c' =>
                        $request->option_c,

                    'option_d' =>
                        $request->option_d,

                    'correct_answer' =>
                        $request->correct_answer

                ]);
            }

        });

        return redirect()
            ->route(
                'admin.quiz-bank.index'
            )
            ->with(
                'success',
                'Question added successfully.'
            );
    }

    public function edit(
        QuizQuestion $quizBank
    )
    {
        $courses = Course::all();

        $quizBank->load(
            'mcqOption'
        );

        return view(
            'admin.quiz-bank.edit',
            compact(
                'quizBank',
                'courses'
            )
        );
    }

    public function update(
        Request $request,
        QuizQuestion $quizBank
    )
    {
        $request->validate([

            'course_id' =>
                'required|exists:courses,id',

            'question_type' =>
                'required|in:mcq,written',

            'question' =>
                'required|string',

            'marks' =>
                'required|integer|min:1',

        ]);

        DB::transaction(function ()
            use (
                $request,
                $quizBank
            ) {

            $quizBank->update([

                'course_id' =>
                    $request->course_id,

                'question_type' =>
                    $request->question_type,

                'question' =>
                    $request->question,

                'marks' =>
                    $request->marks,

                'model_answer' =>
                    $request->model_answer,

            ]);

            if (
                $request->question_type === 'mcq'
            ) {

                McqOption::updateOrCreate(

                    [
                        'quiz_question_id' =>
                            $quizBank->id
                    ],

                    [
                        'option_a' =>
                            $request->option_a,

                        'option_b' =>
                            $request->option_b,

                        'option_c' =>
                            $request->option_c,

                        'option_d' =>
                            $request->option_d,

                        'correct_answer' =>
                            $request->correct_answer
                    ]
                );

            } else {

                McqOption::where(
                    'quiz_question_id',
                    $quizBank->id
                )->delete();
            }
        });

        return redirect()
            ->route(
                'admin.quiz-bank.index'
            )
            ->with(
                'success',
                'Question updated successfully.'
            );
    }

    public function destroy(
        QuizQuestion $quizBank
    )
    {
        $quizBank->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Question deleted successfully.'
            );
    }
}
