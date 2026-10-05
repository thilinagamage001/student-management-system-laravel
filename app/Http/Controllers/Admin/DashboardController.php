<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalStudents = Student::count();

        $totalTeachers = Teacher::count();

        $totalCourses = Course::count();

        $totalEnrollments = Enrollment::count();

        $todayAttendance = Attendance::whereDate(
            'attendance_date',
            today()
        )->count();

        $totalExams = Exam::count();

        $totalGrades = Grade::count();

        $attendancePercentage =
            Attendance::count() > 0
            ? round(
                (Attendance::where('status', 'present')->count()
                / Attendance::count()) * 100,
                2
            )
            : 0;
        $recentStudents = Student::with('user')
            ->latest()
            ->take(5)
            ->get();

        $upcomingExams = Exam::with('course')
            ->whereDate('exam_date', '>=', today())
            ->orderBy('exam_date')
            ->take(5)
            ->get();

        return view(
            'admin.dashboard.index',
            compact(
                'recentStudents',
                'upcomingExams',
                'totalStudents',
                'totalTeachers',
                'totalCourses',
                'totalEnrollments',
                'todayAttendance',
                'totalExams',
                'totalGrades',
                'attendancePercentage'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
