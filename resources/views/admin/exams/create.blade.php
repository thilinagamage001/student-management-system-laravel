```blade
@extends('layouts.app')
@push('title')
    Create Exam
@endpush
@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h4>Create Exam</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.exams.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Course</label>

                    <select name="course_id"
                            class="form-control"
                            required>

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

                <div class="mb-3">
                    <label>Title</label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Type</label>

                    <select name="type"
                            class="form-control"
                            required>

                        <option value="quiz">Quiz</option>
                        <option value="assignment">Assignment</option>
                        <option value="midterm">Mid Term</option>
                        <option value="final">Final Exam</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>Total Marks</label>

                    <input type="number"
                           name="total_marks"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Exam Date</label>

                    <input type="date"
                           name="exam_date"
                           class="form-control"
                           required>
                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Save Exam
                </button>

            </form>

        </div>
    </div>

</div>

@endsection
```
