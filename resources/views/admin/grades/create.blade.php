@extends('layouts.app')
@push('title')
    Grades
@endpush
@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h4>Grade Entry</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-4">

                <div class="col-md-6">

                    <label class="form-label">
                        Select Exam
                    </label>

                    <select
                        id="exam_id"
                        class="form-control"
                    >

                        <option value="">
                            Select Exam
                        </option>

                        @foreach($exams as $exam)

                            <option value="{{ $exam->id }}">

                                {{ $exam->course->course_code }}
                                -
                                {{ $exam->title }}
                                ({{ ucfirst($exam->type) }})

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <form
                method="POST"
                action="{{ route('admin.grades.store') }}"
            >

                @csrf

                <input
                    type="hidden"
                    name="exam_id"
                    id="hidden_exam_id"
                >

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>
                                <th width="10%">#</th>
                                <th>Student Name</th>
                                <th width="30%">Marks</th>
                            </tr>

                        </thead>

                        <tbody id="studentsTable">

                            <tr>
                                <td colspan="3" class="text-center">
                                    Select an exam to load students
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Grades
                </button>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const examSelect =
        document.getElementById('exam_id');

    const hiddenExam =
        document.getElementById('hidden_exam_id');

    const tableBody =
        document.getElementById('studentsTable');

    examSelect.addEventListener(
        'change',
        function () {

            let examId = this.value;

            hiddenExam.value = examId;

            if (!examId) {

                tableBody.innerHTML = `
                    <tr>
                        <td colspan="3"
                            class="text-center">
                            Select an exam
                        </td>
                    </tr>
                `;

                return;
            }

            fetch(
                "{{ route('admin.grades.students') }}" +
                "?exam_id=" +
                examId
            )
            .then(response => response.json())
            .then(data => {

                tableBody.innerHTML = '';

                if (data.length === 0) {

                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="3"
                                class="text-center">
                                No students found
                            </td>
                        </tr>
                    `;

                    return;
                }

                data.forEach(
                    (student, index) => {

                        tableBody.innerHTML += `
                            <tr>

                                <td>
                                    ${index + 1}
                                </td>

                                <td>
                                    ${student.name}
                                </td>

                                <td>

                                    <input
                                        type="number"
                                        min="0"
                                        step="0.01"
                                        name="marks[${student.student_id}]"
                                        class="form-control"
                                        required
                                    >

                                </td>

                            </tr>
                        `;
                    }
                );

            })
            .catch(error => {

                console.error(error);

                tableBody.innerHTML = `
                    <tr>
                        <td colspan="3"
                            class="text-danger text-center">
                            Error loading students
                        </td>
                    </tr>
                `;
            });

        }
    );

});

</script>

@endpush

