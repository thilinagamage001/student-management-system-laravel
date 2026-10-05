@extends('layouts.app')
@push('title')
    Grades
@endpush
@section('content')
    <div class="container">

        <div class="card">

            <div class="card-header d-flex justify-content-between ">

                <h4>Grade List</h4>

                <a href="{{ route('admin.grades.create') }}" class="btn btn-primary">
                    Add Grades
                </a>

            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('admin.grades.index') }}">

                    <div class="row mb-3">

                        <div class="col-md-3">

                            <select name="course_id" class="form-control">

                                <option value="">
                                    All Courses
                                </option>

                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                                        {{ $course->course_code }}
                                        -
                                        {{ $course->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <select name="exam_id" class="form-control">

                                <option value="">
                                    All Exams
                                </option>

                                @foreach ($exams as $exam)
                                    <option value="{{ $exam->id }}"
                                        {{ request('exam_id') == $exam->id ? 'selected' : '' }}>

                                        {{ $exam->title }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <input type="text" name="student" class="form-control" placeholder="Student Name"
                                value="{{ request('student') }}">

                        </div>

                        <div class="col-md-3">

                            <button type="submit" class="btn btn-primary">

                                Filter

                            </button>

                            <a href="{{ route('admin.grades.index') }}" class="btn btn-secondary">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>
                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Student</th>

                                <th>Course</th>

                                <th>Exam</th>

                                <th>Type</th>

                                <th>Marks</th>

                                <th>Grade</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($grades as $grade)
                                <tr>

                                    <td>
                                        {{ $grade->id }}
                                    </td>

                                    <td>

                                        {{ $grade->student->user->first_name }}
                                        {{ $grade->student->user->last_name }}

                                    </td>

                                    <td>

                                        {{ $grade->exam->course->course_code }}

                                    </td>

                                    <td>

                                        {{ $grade->exam->title }}

                                    </td>

                                    <td>

                                        {{ ucfirst($grade->exam->type) }}

                                    </td>

                                    <td>

                                        {{ $grade->marks }}

                                    </td>

                                    <td>

                                        <span class="badge bg-success">

                                            {{ $grade->grade }}

                                        </span>

                                    </td>
                                    <td>

                                        <a href="{{ route('admin.grades.edit', $grade->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                         <a href="{{ route('admin.grades.destroy',$grade->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center">

                                        No grades found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $grades->links() }}

                </div>

            </div>

        </div>

    </div>
@endsection
