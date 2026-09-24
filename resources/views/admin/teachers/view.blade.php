@extends('layouts.app')
@push('title')
    View Teacher
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">View Teacher</div>
                        </div>
                        <form class="needs-validation" novalidate  method="POST" action="{{ route('admin.teachers.update', $teacher->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" class="form-control" id="validationCustom01" name="teacherId" value="{{ $teacher->user->teacherId  }}"/>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12 d-flex justify-content-center mb-3">
                                            <img
                                            src="{{ asset('storage/' . $teacher->profile_picture) }}"
                                            alt=""
                                            class="img-size-100 rounded-circle me-2"
                                            />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="first_name" value="{{ $teacher->user->first_name }}"
                                           readonly  />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="validationCustom02" name="last_name" value="{{ $teacher->user->last_name }}"
                                           readonly  />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="validationCustom03" name="email" value="{{ $teacher->user->email }}"
                                           readonly  />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Password (leave blank to keep current password)</label>
                                        <input type="password" class="form-control" id="validationCustom04" name="password"
                                          readonly   />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Phone</label>
                                        <input type="number" class="form-control" id="validationCustom05" name="phone" value="{{ $teacher->phone }}"
                                          readonly   />
                                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="validationCustom05" name="dob" value="{{ $teacher->dob }}"
                                          readonly   />
                                        <div class="invalid-feedback">Please provide a valid date of birth.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="validationCustom05" name="age" value="{{ $teacher->age }}"
                                          readonly   />
                                        <div class="invalid-feedback">Please provide a valid age.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="validationCustom05" name="address" value="{{ $teacher->address }}"
                                            readonly />
                                        <div class="invalid-feedback">Please provide a valid address.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Gender</label>
                                        <select class="form-select" id="validationCustom05" name="gender" disabled>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Male" {{ $teacher->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $teacher->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">NIC</label>
                                        <input type="text" class="form-control" id="validationCustom05" name="nic" value="{{ $teacher->nic }}"
                                           readonly  />
                                        <div class="invalid-feedback">Please provide a valid NIC.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-info" href="{{ route('admin.teachers.edit', $teacher->id) }}">Edit Profile</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
