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
                    <a href="{{ route('supportDashboard') }}" class="logo">
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
                            <a href="{{ route('supportDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('supportview') }}">
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
                            <div class="collapse show" id="participant">
                                <ul class="nav nav-collapse">
                                    <li class="active">
                                        <a href="{{ route('support.participants.index') }}">
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
                                        <a href="{{ route('support.attendance.index') }}">
                                            <span class="sub-item">Manage attendance</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        

                        {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#user">
                                <i class="fas fa-user"></i>
                                <p>User</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="user">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('users.index') }}">
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
                                        <a href="{{ route('events.index') }}">
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
                        <a href="{{ route('supportDashboard') }}" class="logo">
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
              <h3 class="fw-bold mb-3">Participants</h3>
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
                  <a href="#">Participant</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">View</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Participants</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Modal -->
                    <form id="participantForm">
                        <div class="card-body">
                            <div class="row">
                                <!-- Coop Selection -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="coop_id">Cooperative</label>
                                        <div>{{ $participant->cooperative->name ?? 'N/A' }}</div> <!-- Display cooperative name -->
                                    </div>
                                </div>

                               <!-- User Display -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="user_id">User Account</label>
                                        <div>{{ $participant->user->name ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div>{{ $participant->email }}</div>
                                    </div>
                                </div>

                                <!-- First Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <div>{{ $participant->first_name }}</div>
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <div>{{ $participant->middle_name ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <div>{{ $participant->last_name }}</div>
                                    </div>
                                </div>

                                <!-- Nickname -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="nickname">Nickname</label>
                                        <div>{{ $participant->nickname ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div>{{ $participant->gender }}</div>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <div>{{ $participant->phone_number }}</div>
                                    </div>
                                </div>

                                <!-- Designation -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <div>{{ $participant->designation ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="reference_number">Access Key</label>
                                        <div>{{ $participant->reference_number ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <!-- Congress Type -->
                                {{-- <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="congress_type">Congress Type</label>
                                        <div>{{ $participant->congress_type ?? 'N/A' }}</div>
                                    </div>
                                </div> --}}

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Congress</label>
                                        <div class="border p-2 rounded" style="min-height: 45px; background-color: #f8f9fa;">
                                            @if ($participant->events->isNotEmpty())
                                                @foreach ($participant->events as $event)
                                                    <span class="badge bg-primary">{{ $event->title }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No congress types selected.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <!-- Religious Affiliation -->
                                {{-- <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="religious_affiliation">Religious Affiliation</label>
                                        <div>{{ $participant->religious_affiliation ?? 'N/A' }}</div>
                                    </div>
                                </div> --}}

                                <!-- T-shirt Size -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="tshirt_size">T-shirt Size</label>
                                        <div>{{ $participant->tshirt_size ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <!-- MSP Officer -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="is_msp_officer">MASS-SPECC Officer</label>
                                        <div>{{ $participant->is_msp_officer ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <!-- MSP Officer Position -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="msp_officer_position">MASS-SPECC Officer Position</label>
                                        <div>{{ $participant->msp_officer_position ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="qr_code">QR Code</label>
                                        <div class="Qr">
                                            <!-- QR Code Image -->
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(route('adminDashboard', ['participant_id' => $participant->participant_id])) }}&size=200x200" alt="QR Code" id="qrCodeImage"/>

                                            <!-- Download Button -->
                                            <a href="{{ route('download.qr4', ['participant_id' => $participant->participant_id]) }}" class="btn btn-label-info btn-round">
                                                Download QR Code
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="gender">Attendance</label>
                                        <div>
                                            {{ $participant->attendance_datetime
                                                ? \Carbon\Carbon::parse($participant->attendance_datetime)->format('F j, Y g:i A')
                                                : 'N/A' }}
                                        </div>
                                    </div>
                                </div>



                                 <!-- Delegate Type -->
                                 <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="delegate_type">Delegate Type</label>
                                        <div>{{ $participant->delegate_type ?? 'N/A' }}</div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-label-info btn-round me-2" type="button" onclick="window.location.href='{{ route('participants.index') }}'">Back</button>
                        </div>
                    </form>

                    {{-- <div class="d-flex justify-content-center mt-3">
                        {{ $participants->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                    </div> --}}
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            @include('layouts.adminfooter')
      </div>
    </div>

    @include('layouts.links')
  </body>
</html>
