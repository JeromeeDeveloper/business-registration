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
            <a href="{{route('supportDashboard')}}" class="logo">
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
                  href="{{route('supportDashboard')}}"
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
                        <a href="{{route('supportview')}}">
                          <span class="sub-item">Manage Cooperative</span>
                        </a>
                      </li>
                  </ul>
                </div>
              </li>
              {{-- <li class="nav-item">
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
                <a data-bs-toggle="collapse" href="#attendance">
                  <i class="fas fa-calendar"></i>
                  <p>Attendance</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="attendance">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{ route('attendance.index') }}">
                            <span class="sub-item">Manage attendance</span>
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
                <div class="collapse" id="user">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{route('users.index')}}">
                          <span class="sub-item">Manage User</span>
                        </a>
                      </li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#speaker">
                  <i class="fas fa-microphone"></i>
                  <p>Speakers</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="speaker">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{ route('speakers.index') }}">
                            <span class="sub-item">Manage Speaker</span>
                        </a>
                    </li>

                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#events">
                  <i class="fas fa-calendar"></i>
                  <p>Events</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="events">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{route('events.index')}}">
                          <span class="sub-item">Manage Events</span>
                        </a>
                      </li>
                  </ul>
                </div>
              </li> --}}

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
              <a href="{{route('supportDashboard')}}" class="logo">
                <img class="logo-mass-specc" src="{{ asset('images/logo.png') }}" alt="">
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
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <nav
                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">

                </nav>

                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-user dropdown hidden-caret">

                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                            aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <span class="profile-username">
                                <span class="op-7">Hi,</span>
                                <span class="fw-bold" style="text-transform: capitalize;">
                                    {{ Auth::user()->name }}
                                </span>

                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="u-text">
                                            <h4> {{ Auth::user()->name }}</h4>
                                            <p class="text-muted"> {{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('profile.edit3') }}">My
                                        Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="#"
                                        onclick="document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Edit Profile</h3>
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
                    <a href="#">Dashboard</a>
                  </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">My Profile</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Profile Edit Form</div>
                  </div>

                  <form action="{{ route('profile.update3') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" required>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="password">Password (Leave blank to keep current)</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-round">Save Changes</button>
                    <a href="{{ url()->previous() }}" class="btn btn-label-info btn-round me-2">Previous</a>
                </div>

                </form>

                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}'
                        });
                    </script>
                @endif


            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
        {{-- @include('layouts.adminfooter') --}}
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  @include('layouts.links')
  </body>
</html>
