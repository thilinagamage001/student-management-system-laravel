@extends('layouts.app')
@push('title')
    Edit Assign
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Edit Assign</div>
                        </div>
                        <form class="needs-validation" novalidate action="{{ route('admin.teacher-courses.update', $teacherCourse->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="select-default">Select Course</label>

<select class="form-select" name="course_id" required>
    @foreach ($courses as $course)
        <option value="{{ $course->id }}" selected>
            {{ $course->course_code }} - {{ $course->name }}
        </option>
    @endforeach
</select>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="select-default">Select Teacher</label>
<select class="form-select" name="teacher_id" required>
    <option value="">Choose...</option>

    @foreach ($teachers as $teacher)
        <option
            value="{{ $teacher->id }}"
            {{ $teacher->id == $teacherCourse->teacher_id ? 'selected disabled' : '' }}>

            {{ $teacher->reg_no }}
            - {{ $teacher->user->first_name }}
            {{ $teacher->user->last_name }}

        </option>
    @endforeach
</select>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-info" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
