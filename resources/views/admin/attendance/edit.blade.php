@extends('layouts.app')

@push('title')
    Edit Attendance
@endpush

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h3>Edit Attendance</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.attendance.update', $attendance->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-select">

                        <option value="present"
                            {{ $attendance->status == 'present' ? 'selected' : '' }}>
                            Present
                        </option>

                        <option value="absent"
                            {{ $attendance->status == 'absent' ? 'selected' : '' }}>
                            Absent
                        </option>

                        <option value="late"
                            {{ $attendance->status == 'late' ? 'selected' : '' }}>
                            Late
                        </option>

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Attendance
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
