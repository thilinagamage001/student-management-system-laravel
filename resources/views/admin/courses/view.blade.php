@extends('layouts.app')
@push('title')
     Course
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Edit Course</div>
                        </div>
                        <form class="needs-validation" novalidate
                            enctype="multipart/form-data">

                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Course Code</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="course_code"
                                            value="{{ $courses->course_code }}" disabled />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Course Name</label>
                                        <input type="text" class="form-control" id="validationCustom02" name="name"
                                            value="{{ $courses->name }}" disabled />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="validationCustom04" class="form-label">Credits</label>
                                        <input type="number" class="form-control" id="validationCustom04" name="credits"
                                            value="{{ $courses->credits }}" disabled />
                                    </div>
                                     <div class="col-md-12">
                                        <label for="validationCustom03" class="form-label">Description</label>
                                        <textarea type="text" class="form-control" id="validationCustom03" name="description"
                                            disabled>{{ $courses->description }}</textarea>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-info" href="{{ route('admin.courses.edit', $courses->id) }}">Edit form</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
