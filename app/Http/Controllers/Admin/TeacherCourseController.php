<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\User;
use App\Models\TeacherCourse;


class TeacherCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherCourses = TeacherCourse::all();
        $teachers = Teacher::all();
        return view('admin.teacher-course.index', compact('teacherCourses','teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $courses = Course::all();
        $teachers = Teacher::with('user')->get();

        $assignedCourses = TeacherCourse::pluck('course_id');

        return view('admin.teacher-course.create', compact(
            'courses',
            'teachers',
            'assignedCourses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'course_id' => 'required|unique:teacher_courses,course_id',
                'teacher_id' => 'required',
            ]);

            TeacherCourse::create([
                'teacher_id' => $validated['teacher_id'],
                'course_id' =>  $validated['course_id'],
            ]);
        }
        catch (\Exception $e) {
            return $e;
        }
            return redirect()
            ->route('admin.teacher-courses.index')
            ->with('success', 'Teacher assigned successfully.');
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
        $teacherCourse = TeacherCourse::findOrFail($id);

        $courses = Course::where('id', $teacherCourse->course_id)->get();

        $teachers = Teacher::with('user')->get();

        $assignedTeachers = TeacherCourse::where('id', '!=', $id)
            ->pluck('teacher_id');

        return view('admin.teacher-course.edit', compact(
            'teacherCourse',
            'courses',
            'teachers',
            'assignedTeachers'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'course_id'  => 'required|exists:courses,id',
        ]);

        $teacherCourse = TeacherCourse::findOrFail($id);

        $teacherCourse->update([
            'teacher_id' => $validated['teacher_id'],
            'course_id'  => $validated['course_id'],
        ]);

        return redirect()
            ->route('admin.teacher-courses.index')
            ->with('success', 'Teacher Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacherCourse = TeacherCourse::findOrFail($id);
        $teacherCourse->delete();

        return redirect()
            ->route('admin.teacher-courses.index')
            ->with('success', 'Teacher Course deleted successfully');
        }
}
