<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1',
            
        ]);

        Course::create([
            'course_code' => $validated['course_code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'credits' => $validated['credits'],
            'status' => 'active', // Set the default status to 'active'
        ]);
        }
        catch (\Exception $e) {
            return $e;
        }
        

        // Redirect to the course index page with a success message
        return redirect()->route('admin.courses.create')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $courses = Course::findOrFail($id);
        return view('admin.courses.view', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $courses = Course::findOrFail($id);
        return view('admin.courses.edit', compact('courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $validated = $request->validate([
            'course_code' => 'required|string|max:255|unique:courses,course_code,',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1',
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'course_code' => $validated['course_code'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'credits' => $validated['credits'],
        ]);
        }
        catch (\Exception $e) {
            return $e;
        }

        // Redirect to the course index page with a success message
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
        } catch (\Exception $e) {
            return $e;
        }

        // Redirect to the course index page with a success message
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
