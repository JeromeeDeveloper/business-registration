<!DOCTYPE html>
<html lang="en">
 <head>
    @include('layouts.adminheader')
 </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{route('adminDashboard')}}" class="logo">
                <img class="logo-mass-specc" src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <li class="nav-item">
                  <a
                    href="{{route('adminDashboard')}}"
                    class="collapsed"
                  >
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                  </a>
                </li>

                <li class="nav-section">
                  <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                  </span>
                  <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#cooperative">
                      <i class="fas fa-users"></i>
                      <p>Cooperative</p>
                      <span class="caret"></span>
                    </a>
                    <div class="collapse" id="cooperative">
                      <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('adminview')}}">
                              <span class="sub-item">Manage Cooperative</span>
                            </a>
                          </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#participant">
                        <i class="fas fa-user-cog"></i>
                      <p>Participant</p>
                      <span class="caret"></span>
                    </a>
                    <div class="collapse" id="participant">
                      <ul class="nav nav-collapse">
                        <li>
                            <a href="{{route('participants.index')}}">
                                <span class="sub-item">Manage Participant</span>
                              </a>
                          </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#user">
                      <i class="fas fa-user"></i>
                      <p>User</p>
                      <span class="caret"></span>
                    </a>
                    <div class="collapse show" id="user">
                      <ul class="nav nav-collapse">
                        <li class="active">
                            <a href="{{route('users.index')}}">
                              <span class="sub-item">Manage User</span>
                            </a>
                          </li>
                      </ul>
                    </div>
                  </li>
              </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="{{route('adminDashboard')}}" class="logo">
                <img class="logo-mass-specc" src="{{ asset('images/logo.png') }}" alt="">
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          @include('layouts.adminnav')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">User</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">User</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Datatable</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Users</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Modal -->
                    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                        <div class="d-flex justify-content-end">
                            <div class="input-group flex-nowrap w-50 w-md-50 w-lg-25 ms-auto">
                                <input type="text" name="search" class="form-control" placeholder="Search..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Date Created</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucfirst($user->role) }}</td>
                                            <td>{{ $user->created_at->format('F d, Y') }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('registerform')}}" class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip" title="Add User">
                                                        <i class="fa fa-plus"></i>
                                                    </a>


                                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit User">
                                                        <a href="{{route('user.edit', $user->user_id)}}" class="text-decoration-none text-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </button>

                                                    <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" class="delete-form" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove User" aria-label="Remove User" onclick="confirmDelete(event, this)">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No users found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                  </div>
                  <div class="d-flex justify-content-center mt-3">
                    {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                </div>


                </div>

              </div>


            </div>

          </div>

        </div>

            @include('layouts.adminfooter')

      </div>

    </div>
    <script>
       function confirmDelete(event, button) {
        event.preventDefault(); // Prevent form from submitting

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                button.closest('form').submit();  // Trigger form submission
            }
        });
    }

    </script>

    @include('layouts.links')
  </body>
</html>
