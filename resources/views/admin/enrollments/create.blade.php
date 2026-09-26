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
                        <form class="needs-validation" novalidate action="{{ route('admin.enrollments.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="select-default">Select Student</label>
                                        
                                    <select name="student_id" id="student_id" class="form-select" required>
                                        <option value="">Select Student</option>

                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">
                                                {{ $student->reg_no }} -
                                                {{ $student->user->first_name }}
                                                {{ $student->user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="select-default">Select Course</label>
                                        
                                        <select class="form-select" name="course_id" required multiple>
                                            <option value="">Choose...</option>

                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}">
                                                    {{ $course->course_code }} - 
                                                    {{ $course->name }}
                                            
                                                </option>
                                            @endforeach
                                        </select>
      
                                    </div>
                                     <div class="mb-3">
                                        <label class="form-label" for="select-default">Academic Year</label>
                                        <input type="number" class="form-control" id="validationCustom04" name="academic_year"
                                            required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="select-default">Semester</label>
                                        <select class="form-select" id="validationCustom05" name="semester" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
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
