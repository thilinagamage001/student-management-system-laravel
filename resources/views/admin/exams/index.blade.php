
@extends('layouts.app')
@push('title')
     Exam
@endpush
@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h4>Exams</h4>

        <a href="{{ route('admin.exams.create') }}"
           class="btn btn-primary">
            Add Exam
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered">

        <thead>

        <tr>
            <th>ID</th>
            <th>Course</th>
            <th>Title</th>
            <th>Type</th>
            <th>Total Marks</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        </thead>

        <tbody>

        @forelse($exams as $exam)

            <tr>

                <td>{{ $exam->id }}</td>

                <td>
                    {{ $exam->course->course_code }}
                </td>

                <td>{{ $exam->title }}</td>

                <td>{{ ucfirst($exam->type) }}</td>

                <td>{{ $exam->total_marks }}</td>

                <td>{{ $exam->exam_date }}</td>

                <td>{{ $exam->status }}</td>

                <td>

                    <a href="{{ route('admin.exams.edit',$exam->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.exams.destroy',$exam->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Exam?')">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="8" class="text-center">
                    No exams found
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    {{ $exams->links() }}

</div>

@endsection

