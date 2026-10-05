@extends('layouts.app')
@push('title')
    Dashboard
@endpush
@section('content')


<div class="app-content">

    <div class="container-fluid">

        <div class="row">

            {{-- Students --}}
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $totalStudents }}</h3>
                        <p>Total Students</p>
                    </div>

                    <a href="{{ route('admin.students.index') }}"
                       class="small-box-footer text-white">
                        View Students
                    </a>
                </div>
            </div>

            {{-- Teachers --}}
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $totalTeachers }}</h3>
                        <p>Total Teachers</p>
                    </div>

                    <a href="{{ route('admin.teachers.index') }}"
                       class="small-box-footer text-white">
                        View Teachers
                    </a>
                </div>
            </div>

            {{-- Courses --}}
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $totalCourses }}</h3>
                        <p>Total Courses</p>
                    </div>

                    <a href="{{ route('admin.courses.index') }}"
                       class="small-box-footer text-dark">
                        View Courses
                    </a>
                </div>
            </div>

            {{-- Enrollments --}}
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $totalEnrollments }}</h3>
                        <p>Total Enrollments</p>
                    </div>

                    <a href="{{ route('admin.enrollments.index') }}"
                       class="small-box-footer text-white">
                        View Enrollments
                    </a>
                </div>
            </div>

        </div>

        <div class="row mt-3">

            {{-- Attendance --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $todayAttendance }}</h3>
                        <p>Today's Attendance</p>
                    </div>

                    <a href="{{ route('admin.attendance.index') }}"
                       class="small-box-footer text-white">
                        View Attendance
                    </a>
                </div>
            </div>

            {{-- Exams --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $totalExams }}</h3>
                        <p>Total Exams</p>
                    </div>

                    <a href="{{ route('admin.exams.index') }}"
                       class="small-box-footer text-white">
                        View Exams
                    </a>
                </div>
            </div>

            {{-- Grades --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalGrades }}</h3>
                        <p>Total Grades</p>
                    </div>

                    <a href="{{ route('admin.grades.index') }}"
                       class="small-box-footer text-white">
                        View Grades
                    </a>
                </div>
            </div>

            {{-- Attendance Rate --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>{{ $attendancePercentage }}%</h3>
                        <p>Attendance Rate</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">

            {{-- Recent Students --}}
            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">
                        <h5>Recent Students</h5>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th>Reg No</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>

                            @forelse($recentStudents as $student)

                                <tr>

                                    <td>
                                        {{ $student->reg_no }}
                                    </td>

                                    <td>
                                        {{ $student->user->first_name }}
                                        {{ $student->user->last_name }}
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            {{ $student->status }}
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3"
                                        class="text-center">
                                        No Students Found
                                    </td>
                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            {{-- Upcoming Exams --}}
            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">
                        <h5>Upcoming Exams</h5>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>Exam</th>
                                <th>Date</th>
                            </tr>
                            </thead>

                            <tbody>

                            @forelse($upcomingExams as $exam)

                                <tr>

                                    <td>
                                        {{ $exam->course->course_code }}
                                    </td>

                                    <td>
                                        {{ $exam->title }}
                                    </td>

                                    <td>
                                        {{ $exam->exam_date }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3"
                                        class="text-center">
                                        No Upcoming Exams
                                    </td>
                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
```
