
@extends('layouts.app')
@push('title')
     Edit Exam
@endpush
@section('content')


<div class="container">

    <div class="card">

        <div class="card-header">
            <h4>Edit Exam</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.exams.update',$exam->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Course</label>

                    <select name="course_id"
                            class="form-control">

                        @foreach($courses as $course)

                            <option value="{{ $course->id }}"
                                {{ $exam->course_id == $course->id ? 'selected' : '' }}>

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
                           value="{{ $exam->title }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Type</label>

                    <select name="type"
                            class="form-control">

                        <option value="quiz"
                            {{ $exam->type == 'quiz' ? 'selected' : '' }}>
                            Quiz
                        </option>

                        <option value="assignment"
                            {{ $exam->type == 'assignment' ? 'selected' : '' }}>
                            Assignment
                        </option>

                        <option value="midterm"
                            {{ $exam->type == 'midterm' ? 'selected' : '' }}>
                            Mid Term
                        </option>

                        <option value="final"
                            {{ $exam->type == 'final' ? 'selected' : '' }}>
                            Final Exam
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Total Marks</label>

                    <input type="number"
                           name="total_marks"
                           value="{{ $exam->total_marks }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Exam Date</label>

                    <input type="date"
                           name="exam_date"
                           value="{{ $exam->exam_date }}"
                           class="form-control">

                </div>

                <button class="btn btn-success">
                    Update Exam
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
```
