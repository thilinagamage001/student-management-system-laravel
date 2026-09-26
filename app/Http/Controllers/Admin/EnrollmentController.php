<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try{
            $validated = $request->validate([
                'student_id' => ['required', 'integer', 'exists:students,id'],
                'course_id' => ['required', 'integer', 'exists:courses,id'],
                'academic_year' => ['required', 'digits:4'],
                'semester' => ['required', 'integer', 'in:1,2'],
            ]);

            Enrollment::create([
                'student_id' => $validated['student_id'],
                'course_id' => $validated['course_id'],
                'academic_year' => $validated['academic_year'],
                'semester' => $validated['semester'],
            ]);

        }
        catch (\Exception $e) {
            return $e;
        }

        return redirect()->route('admin.enrollments.create')->with('success', 'Course created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
