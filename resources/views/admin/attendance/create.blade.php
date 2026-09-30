@extends('layouts.app')
@push('title')
    Mark Attendance
@endpush
@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h3>Take Attendance</h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.attendance.store') }}">

                @csrf

                <div class="row mb-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Course
                        </label>

                        <select
                            id="course_id"
                            class="form-select"
                        >
                            <option value="">
                                Select Course
                            </option>

                            @foreach($courses as $course)

                                <option value="{{ $course->id }}">
                                    {{ $course->course_code }}
                                    -
                                    {{ $course->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Attendance Date
                        </label>

                        <input
                            type="date"
                            id="attendance_date"
                            class="form-control"
                            value="{{ date('Y-m-d') }}"
                        >

                    </div>

                </div>

                <input
                    type="hidden"
                    name="course_id"
                    id="hidden_course_id"
                >

                <input
                    type="hidden"
                    name="attendance_date"
                    id="hidden_attendance_date"
                >

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th>Student Name</th>
                            <th width="25%">Status</th>
                        </tr>
                        </thead>

                        <tbody id="studentTableBody">

                        <tr>
                            <td colspan="3" class="text-center">
                                Select a course to load students
                            </td>
                        </tr>

                        </tbody>

                    </table>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Attendance
                </button>

            </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const courseSelect =
        document.getElementById('course_id');

    const dateInput =
        document.getElementById('attendance_date');

    const hiddenCourse =
        document.getElementById('hidden_course_id');

    const hiddenDate =
        document.getElementById('hidden_attendance_date');

    const tbody =
        document.getElementById('studentTableBody');

    courseSelect.addEventListener('change', function () {

        let courseId = this.value;

        hiddenCourse.value = courseId;
        hiddenDate.value = dateInput.value;

        if (!courseId) {

            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">
                        Select a course
                    </td>
                </tr>
            `;

            return;
        }

        fetch(
            "{{ route('admin.attendance.getstudents') }}" +
            "?course_id=" + courseId
        )
        .then(response => response.json())
        .then(data => {

            tbody.innerHTML = '';

            if (data.length === 0) {

                tbody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center">
                            No enrolled students found
                        </td>
                    </tr>
                `;

                return;
            }

            data.forEach((student, index) => {

                tbody.innerHTML += `
                    <tr>

                        <td>${index + 1}</td>

                        <td>
                            ${student.name}
                        </td>

                        <td>

                            <select
                                name="attendance[${student.student_id}]"
                                class="form-select"
                            >

                                <option value="present">
                                    Present
                                </option>

                                <option value="absent">
                                    Absent
                                </option>

                                <option value="late">
                                    Late
                                </option>

                            </select>

                        </td>

                    </tr>
                `;
            });

        })
        .catch(error => {

            console.error(error);

            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-danger text-center">
                        Error loading students
                    </td>
                </tr>
            `;
        });

    });

    dateInput.addEventListener('change', function () {

        hiddenDate.value = this.value;

    });

});

</script>

@endpush
