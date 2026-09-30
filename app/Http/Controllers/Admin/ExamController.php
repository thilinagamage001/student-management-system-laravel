<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with('course')
            ->latest()
            ->paginate(10);

        return view(
            'admin.exams.index',
            compact('exams')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where(
            'status',
            'active'
        )->get();

        return view(
            'admin.exams.create',
            compact('courses')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'course_id' => 'required|exists:courses,id',

            'title' => 'required|string|max:255',

            'type' => 'required|in:quiz,assignment,midterm,final',

            'total_marks' => 'required|integer|min:1',

            'exam_date' => 'required|date',

        ]);

        Exam::create([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'type' => $validated['type'],
            'total_marks' => $validated['total_marks'],
            'exam_date' => $validated['exam_date'],
            'status' => 'active',
        ]);

        return redirect()
            ->route('admin.exams.index')
            ->with(
                'success',
                'Exam created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $courses = Course::all();

        return view(
            'admin.exams.edit',
            compact(
                'exam',
                'courses'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {

        $validated = $request->validate([

            'course_id' => 'required|exists:courses,id',

            'title' => 'required|string|max:255',

            'type' => 'required|in:quiz,assignment,midterm,final',

            'total_marks' => 'required|integer|min:1',

            'exam_date' => 'required|date',

        ]);

        $exam->update($validated);

        return redirect()
            ->route('admin.exams.index')
            ->with(
                'success',
                'Exam updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Exam deleted successfully.'
            );
    }
}
