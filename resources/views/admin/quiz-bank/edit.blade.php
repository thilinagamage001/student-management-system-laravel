@extends('layouts.app')
@push('title')
    Edit Quiz
@endpush
@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h4>Edit Quiz</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.quizzes.update',$quiz->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Course</label>

                    <select name="course_id"
                            class="form-control">

                        @foreach($courses as $course)

                            <option value="{{ $course->id }}"
                                {{ $quiz->course_id == $course->id ? 'selected' : '' }}>

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
                           value="{{ $quiz->title }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea name="description"
                              class="form-control">{{ $quiz->description }}</textarea>

                </div>

                <button class="btn btn-success">
                    Update Quiz
                </button>

            </form>

        </div>

    </div>

</div>

@endsection

