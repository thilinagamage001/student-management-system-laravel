<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with([
            'student.user',
            'course'
        ])
        ->get()
        ->groupBy('student_id');

        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $students = Student::with('user')->get();
    $courses = Course::all();

    return view('admin.enrollments.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'course_id' => ['required', 'array', 'min:1'],
            'course_id.*' => ['integer', 'exists:courses,id'],
        ]);

        foreach ($validated['course_id'] as $courseId) {
            Enrollment::create([
                'student_id' => $validated['student_id'],
                'course_id' => $courseId,
            ]);
        }

        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Enrollment created successfully.');
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
    public function edit(string $id)
    {
        $enrollment = Enrollment::with(['student.user', 'course'])->findOrFail($id);

        $courses = Course::all();

        $selectedCourseIds = Enrollment::where('student_id', $enrollment->student_id)
            ->pluck('course_id')
            ->toArray();

        return view('admin.enrollments.edit', compact(
            'enrollment',
            'courses',
            'selectedCourseIds'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   $enrollment = Enrollment::findOrFail($id);

    $validated = $request->validate([
        'course_id' => ['required', 'array', 'min:1'],
        'course_id.*' => ['integer', 'exists:courses,id'],
   
    ]);

    DB::transaction(function () use ($enrollment, $validated) {

        // Student cannot be changed.
        $studentId = $enrollment->student_id;

        // Remove the student's existing courses for this
        // academic year and semester.
        Enrollment::where('student_id', $studentId)
            ->delete();

        // Create the currently selected courses.
        foreach ($validated['course_id'] as $courseId) {
            Enrollment::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                
            ]);
        }
    });

    return redirect()
        ->route('admin.enrollments.index')
        ->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $enrollment->delete();

        return redirect()
            ->route('admin.enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}
