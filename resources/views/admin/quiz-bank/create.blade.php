@extends('layouts.app')
@push('title')
    Add Question
@endpush

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h4>Add Question</h4>
        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.quiz-bank.store') }}"
                method="POST">

                @csrf

                <div class="mb-3">

                    <label>Course</label>

                    <select
                        name="course_id"
                        class="form-control">

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

                    <label>Question Type</label>

                    <select
                        name="question_type"
                        id="question_type"
                        class="form-control">

                        <option value="mcq">
                            MCQ
                        </option>

                        <option value="written">
                            Written
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Question</label>

                    <textarea
                        name="question"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <div class="mb-3">

                    <label>Marks</label>

                    <input
                        type="number"
                        name="marks"
                        class="form-control">

                </div>

                <div id="mcqSection">

                    <div class="mb-3">
                        <label>Option A</label>
                        <input type="text"
                               name="option_a"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Option B</label>
                        <input type="text"
                               name="option_b"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Option C</label>
                        <input type="text"
                               name="option_c"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Option D</label>
                        <input type="text"
                               name="option_d"
                               class="form-control">
                    </div>

                    <div class="mb-3">

                        <label>Correct Answer</label>

                        <select
                            name="correct_answer"
                            class="form-control">

                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>

                        </select>

                    </div>

                </div>

                <div
                    id="writtenSection"
                    style="display:none;">

                    <div class="mb-3">

                        <label>Model Answer</label>

                        <textarea
                            name="model_answer"
                            class="form-control"
                            rows="5"></textarea>

                    </div>

                </div>

                <button class="btn btn-success">

                    Save Question

                </button>

            </form>

        </div>

    </div>

</div>

<script>

document
.getElementById('question_type')
.addEventListener('change', function () {

    let type = this.value;

    document.getElementById('mcqSection')
        .style.display =
        type === 'mcq'
        ? 'block'
        : 'none';

    document.getElementById('writtenSection')
        .style.display =
        type === 'written'
        ? 'block'
        : 'none';

});

</script>

@endsection

