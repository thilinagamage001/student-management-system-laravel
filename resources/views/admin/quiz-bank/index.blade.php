@extends('layouts.app')
@push('title')
    Question Bank
@endpush

@section('content')
<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>Question Bank</h4>

            <a href="{{ route('admin.quiz-bank.create') }}"
               class="btn btn-primary">
                Add Question
            </a>

        </div>

        <div class="card-body">

            <form method="GET">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <select name="course_id"
                                class="form-control">

                            <option value="">
                                All Courses
                            </option>

                            @foreach($courses as $course)

                                <option
                                    value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>

                                    {{ $course->course_code }}
                                    -
                                    {{ $course->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">
                            Filter
                        </button>

                    </div>

                </div>

            </form>

            <table class="table table-bordered">

                <thead>

                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Type</th>
                    <th>Question</th>
                    <th>Marks</th>
                    <th>Actions</th>
                </tr>

                </thead>

                <tbody>

                @forelse($questions as $question)

                    <tr>

                        <td>{{ $question->id }}</td>

                        <td>
                            {{ $question->course->course_code }}
                        </td>

                        <td>
                            {{ strtoupper($question->question_type) }}
                        </td>

                        <td>
                            {{ Str::limit($question->question, 60) }}
                        </td>

                        <td>
                            {{ $question->marks }}
                        </td>

                        <td>

                            <a href="{{ route('admin.quiz-bank.edit',$question->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.quiz-bank.destroy',$question->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete question?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center">

                            No Questions Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            {{ $questions->links() }}

        </div>

    </div>

</div>

@endsection

