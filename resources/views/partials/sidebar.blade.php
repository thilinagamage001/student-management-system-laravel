      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->

            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Search-->
        <div class="sidebar-search" role="search">
          <label for="sidebar-search-input" class="visually-hidden">Filter menu</label>
          <input
            type="search"
            id="sidebar-search-input"
            class="form-control form-control-sm"
            placeholder="Filter menu…"
            autocomplete="off"
            data-lte-toggle="sidebar-search"
            data-lte-target="#navigation"
          />
          <p class="fs-7 text-secondary mt-2 mb-0" data-lte-search-empty role="status" hidden>
            No matching pages.
          </p>
        </div>
        <!--end::Sidebar Search-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              data-accordion="false"
              id="navigation"  >
              <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Students
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.students.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Student List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.students.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Student</p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill"></i>
                  <p>
                    Teachers
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route("admin.teachers.index") }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Teacher List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.teachers.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Teacher</p>
                    </a>
                  </li>

                </ul>
              </li>
                            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill"></i>
                  <p>
                    Courses
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route("admin.courses.index") }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Courses List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.courses.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Course</p>
                    </a>
                  </li>

                </ul>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->