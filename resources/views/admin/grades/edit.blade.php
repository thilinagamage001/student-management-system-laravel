@extends('layouts.app')
@push('title')
    Edit Grade
@endpush

@section('content')

    <div class="card">

        <div class="card-header">

            <h4>Edit Grade</h4>

        </div>

        <div class="card-body">

            <form
                action="{{ route(
                    'admin.grades.update',
                    $grade->id
                ) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>
                        Student
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $grade->student->user->first_name }} {{ $grade->student->user->last_name }}"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label>
                        Course
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $grade->exam->course->course_code }}"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label>
                        Exam
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $grade->exam->title }}"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label>
                        Marks
                    </label>

                    <input
                        type="number"
                        name="marks"
                        value="{{ $grade->marks }}"
                        class="form-control"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Update Grade
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
```
