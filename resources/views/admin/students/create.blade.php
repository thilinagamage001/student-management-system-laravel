@extends('layouts.app')
@push('title')
    Add Student
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Add Student</div>
                        </div>
                        <form class="needs-validation" novalidate action="{{ route('admin.students.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="first_name"
                                            required />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="validationCustom02" name="last_name"
                                            required />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="validationCustom03" name="email"
                                            required />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="validationCustom04" name="password"
                                            required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Phone</label>
                                        <input type="number" class="form-control" id="validationCustom05" name="phone"
                                            required />
                                        <div class="invalid-feedback">Please provide a valid phone number.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="validationCustom05" name="dob"
                                            required />
                                        <div class="invalid-feedback">Please provide a valid date of birth.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="validationCustom05" name="age"
                                            required />
                                        <div class="invalid-feedback">Please provide a valid age.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="validationCustom05" name="address"
                                            required />
                                        <div class="invalid-feedback">Please provide a valid address.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Gender</label>
                                        <select class="form-select" id="validationCustom05" name="gender" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">NIC</label>
                                        <input type="text" class="form-control" id="validationCustom05" name="nic"
                                            required />
                                        <div class="invalid-feedback">Please provide a valid NIC.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Profile Picture</label>
                                        <input type="file" class="form-control" id="validationCustom05"
                                            name="profile_picture" />

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
