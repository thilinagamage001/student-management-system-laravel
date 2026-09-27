@extends('layouts.app')
@push('title')
    Create Enrollments
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title"> Create Enrollments</div>
                        </div>
                        <form class="needs-validation" novalidate action="{{ route('admin.enrollments.update', $enrollment->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="mb-3">
                                        <label class="form-label">Student</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            value="{{ $enrollment->student->reg_no }} - {{ $enrollment->student->user->first_name }} {{ $enrollment->student->user->last_name }}"
                                            readonly
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="course_id">
                                            Select Courses
                                        </label>

<select
    class="form-select"
    name="course_id[]"
    id="course_id"
    multiple
    size="6"
    required
>
    @foreach($courses as $course)
        <option
            value="{{ $course->id }}"
            {{ in_array($course->id, $selectedCourseIds) ? 'selected' : '' }}
        >
            {{ $course->course_code }} - {{ $course->name }}
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
