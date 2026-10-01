<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Grade::with([
            'student.user',
            'exam.course'
        ]);

        if ($request->filled('course_id')) {
            $query->whereHas('exam', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        if ($request->filled('exam_id')) {
            $query->where('exam_id', $request->exam_id);
        }

        if ($request->filled('student')) {

            $student = $request->student;

            $query->whereHas('student.user', function ($q) use ($student) {

                $q->where('first_name', 'like', "%{$student}%")
                ->orWhere('last_name', 'like', "%{$student}%");

            });
        }

        $grades = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $courses = Course::orderBy('name')->get();

        $exams = Exam::orderBy('title')->get();

        return view(
            'admin.grades.index',
            compact(
                'grades',
                'courses',
                'exams'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::with('course')
            ->where('status', 'active')
            ->get();

        return view(
            'admin.grades.create',compact('exams'));
    }

    public function getStudents(Request $request)
    {
        $exam = Exam::findOrFail(
            $request->exam_id
        );
        $students = Enrollment::with('student.user')
            ->where('course_id', $exam->course_id)
            ->get();


return response()->json(
    $students->map(function ($item) {

        return [
            'student_id' => $item->student->id,
            'name' =>
                $item->student->user->first_name .
                ' ' .
                $item->student->user->last_name,
        ];

    })
    );

    }

    private function calculateGrade($marks)
    {
        if ($marks >= 75) {
            return 'A';
        }

        if ($marks >= 65) {
            return 'B';
        }

        if ($marks >= 55) {
            return 'C';
        }

        if ($marks >= 35) {
            return 'S';
        }

        return 'F';
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'marks' => 'required|array',
        ]);

        foreach (
            $request->marks
            as $studentId => $marks
        ) {

            Grade::updateOrCreate(
                [
                    'exam_id' => $request->exam_id,
                    'student_id' => $studentId,
                ],
                [
                    'marks' => $marks,
                    'grade' => $this->calculateGrade($marks),
                ]
            );
    }

    return redirect()
        ->back()
        ->with(
            'success',
            'Grades saved successfully.'
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
    public function edit(Grade $grade)
    {
        $grade->load([
            'student.user',
            'exam.course'
        ]);

        return view(
            'admin.grades.edit',
            compact('grade')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'marks' => 'required|numeric|min:0'
        ]);

        $marks = $request->marks;

        $grade->update([

            'marks' => $marks,

            'grade' => $this->calculateGrade(
                $marks
            )

        ]);

        return redirect()
            ->route(
                'admin.grades.index'
            )
            ->with(
                'success',
                'Grade updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return back()->with(
            'success',
            'Grade deleted successfully.'
        );
    }
}
