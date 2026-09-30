@extends('layouts.app')

@push('title')
    Attendance
@endpush
@section('content')

<div class="app-content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Attendance Sessions</h3>

                <div class="card-tools">
                    <a href="{{ route('admin.attendance.create') }}"
                       class="btn btn-primary btn-sm">
                        Mark Attendance
                    </a>
                </div>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Date</th>
                            <th>Students Marked</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $attendance->course->name }}</td>

                            <td>{{ $attendance->attendance_date }}</td>

                            <td>{{ $attendance->total_students }}</td>

                            <td>

                                <a href="{{ route('admin.attendance.editSession', [
                                    'course_id' => $attendance->course_id,
                                    'date' => $attendance->attendance_date
                                ]) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                No attendance found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

@endsection
