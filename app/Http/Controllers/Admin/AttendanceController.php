<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $attendances = Attendance::select(
            'course_id',
            'attendance_date',
            DB::raw('COUNT(*) as total_students')
        )
        ->with('course')
        ->groupBy('course_id', 'attendance_date')
        ->orderByDesc('attendance_date')
        ->get();

         return view('admin.attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::orderBy('name')->get();
        return view('admin.attendance.create',compact('courses'));
    }

public function getStudents(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
    ]);

    $students = Enrollment::with('student.user')
        ->where('course_id', $request->course_id)
        ->get()
        ->map(function ($enrollment) {

            return [
                'student_id' => $enrollment->student->id,
                'name' => $enrollment->student->user->first_name . ' ' .
                          $enrollment->student->user->last_name,
            ];
        });

    return response()->json($students);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->attendance as $studentId => $status) {
                Attendance::updateOrCreate([
                    'student_id' => $studentId,
                    'course_id' => $request->course_id,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status' => $status,
                ]
                );
            }
        });
        return redirect()->back()->with('success','Attendance saved successfully.');
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
    // public function edit(string $id)
    // {
    //     $attendance = Attendance::findOrFail($id);
    //     return view('admin.attendance.edit', compact('attendance'));
    // }
    public function editSession($courseId, $date)
{
    $records = Attendance::with('student.user')
        ->where('course_id', $courseId)
        ->where('attendance_date', $date)
        ->get();

    return view(
        'admin.attendance.edit-session',
        compact('records', 'courseId', 'date')
    );
}

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:present,absent,late',
    //     ]);

    //     $attendance = Attendance::findOrFail($id);
    //     $attendance->update([
    //         'status' => $request->status,
    //     ]);

    //     return redirect()->route('admin.attendance.index')->with('success','Attendance update successfully');
    // }

    public function updateSession(Request $request)
    {
        foreach ($request->attendance as $studentId => $status) {

            Attendance::where('student_id', $studentId)
                ->where('course_id', $request->course_id)
                ->where('attendance_date', $request->attendance_date)
                ->update([
                    'status' => $status
                ]);
        }

        return redirect()
            ->route('admin.attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
