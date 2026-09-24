@extends('layouts.app')
@push('title')
    Students List
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
                        <h3 class="card-title">User Directory</h3>
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
                          <a href="{{ route('admin.students.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                            New user
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
                            <th>Name</th>
                            <th>Student ID</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $students as $student )
                                                       <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <img
                                  src="{{ asset('storage/' . $student->profile_picture) }}"
                                  alt=""
                                  class="img-size-32 rounded-circle me-2"
                                />
                                <span class="fw-medium">{{ $student->user->first_name }} {{ $student->user->last_name }} </span>
                              </div>
                            </td>
                            <td>{{ $student->reg_no }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td>
                              <span class="badge text-bg-danger"> {{ $student->user->role }} </span>
                            </td>
                            <td>
                              <span class="badge text-bg-success">{{ $student->status }}</span>
                            </td>
                            <td>{{ $student->user->created_at->format('M j, Y') }}</td>
                            <td class="text-end">
                              <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.students.view', $student->id) }}"
                                  type="button"
                                  class="btn btn-outline-secondary" >
                                  <i class="bi bi-eye" aria-hidden="true"> </i>
                              </a>
                                <a href="{{ route('admin.students.edit', $student->id) }}"
                                  type="button"
                                  class="btn btn-outline-secondary">
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </a>
                                <a href="{{ route('admin.students.destroy', $student->id) }} 
                                  " class="btn btn-outline-danger">
                                  <i class="bi bi-trash" aria-hidden="true"> </i>
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
