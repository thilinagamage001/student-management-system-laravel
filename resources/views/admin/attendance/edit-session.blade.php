@extends('layouts.app')

@push('title')
    Edit Attendance
@endpush

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Edit Attendance - {{ $date }}</h3>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('admin.attendance.updateSession') }}">

                @csrf
                @method('PUT')

                <input type="hidden"
                       name="course_id"
                       value="{{ $courseId }}">

                <input type="hidden"
                       name="attendance_date"
                       value="{{ $date }}">

                <table class="table table-bordered">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($records as $record)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $record->student->user->first_name }}
                                {{ $record->student->user->last_name }}
                            </td>

                            <td>

                                <select
                                    name="attendance[{{ $record->student_id }}]"
                                    class="form-select">

                                    <option value="present"
                                        {{ $record->status == 'present' ? 'selected' : '' }}>
                                        Present
                                    </option>

                                    <option value="absent"
                                        {{ $record->status == 'absent' ? 'selected' : '' }}>
                                        Absent
                                    </option>

                                    <option value="late"
                                        {{ $record->status == 'late' ? 'selected' : '' }}>
                                        Late
                                    </option>

                                </select>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

                <button type="submit"
                        class="btn btn-primary">
                    Update Attendance
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
