@extends('layouts.app')
@push('title')
    Student Enrollments
@endpush

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <!--begin::Card-->
                <div class="card mb-4">
                  <!--begin::Card Header-->
                  <div class="card-header">
                    <div class="row g-2 align-items-center">
                      <div class="col-12 col-md-4">
                        <h3 class="card-title">Student Enrollments</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="user-search"
                              class="form-control"
                              placeholder="Search users"
                              aria-label="Search users"
                              style="width: 180px"
                            />
                          </div>
                          <select
                            id="user-role-filter"
                            class="form-select form-select-sm w-auto"
                            aria-label="Filter by role"
                          >
                            <option value="all" selected>All roles</option>
                            <option value="administrator">Administrator</option>
                            <option value="editor">Editor</option>
                            <option value="author">Author</option>
                            <option value="subscriber">Subscriber</option>
                          </select>
                          <a href="{{ route('admin.enrollments.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                            Student Enrollments
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Card Header-->
                  <!--begin::Card Body-->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover align-middle m-0">
                        <thead>
                          <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Course</th>


                            <th class="text-end">Actions</th>
                          </tr>
                        </thead>
<tbody>
    @foreach($enrollments as $studentEnrollments)

        @php
            $firstEnrollment = $studentEnrollments->first();
            $student = $firstEnrollment->student;
        @endphp

        <tr>
            {{-- Student ID --}}
            <td>
                {{ $student->reg_no }}
            </td>

            {{-- Student Name --}}
            <td>
                {{ $student->user->first_name }}
                {{ $student->user->last_name }}
            </td>

            {{-- All Courses --}}
            <td>
                @foreach($studentEnrollments as $enrollment)
                    <div class="mb-1">
                        <span class="badge text-bg-info">
                            {{ $enrollment->course->course_code }}
                        </span>
                        {{ $enrollment->course->name }}
                    </div>
                @endforeach
            </td>

            {{-- Actions --}}
            <td class="text-end">
                <div class="btn-group btn-group-sm">

                    <a href="{{ route('admin.enrollments.edit', $firstEnrollment->id) }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <a href="{{ route('admin.enrollments.destroy', $firstEnrollment->id) }}"
                       class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                    </a>

                </div>
            </td>
        </tr>

    @endforeach
</tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!--end::Card Body-->
                  <!--begin::Card Footer-->
                  <div class="card-footer clearfix">
                    <div class="float-start pt-1 fs-7 text-body-secondary">
                      Showing 1 to 9 of 42 users
                    </div>
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous"> &laquo; </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">5</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next"> &raquo; </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
    </div>
@endsection
