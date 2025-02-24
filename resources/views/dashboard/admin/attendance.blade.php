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
                    <a href="{{ route('adminDashboard') }}" class="logo">
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
                            <a href="{{ route('adminDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('adminview') }}">
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
                                        <a href="{{ route('participants.index') }}">
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
                            <div class="collapse show" id="attendance">
                              <ul class="nav nav-collapse">
                                <li class="active">
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
                        <a href="{{ route('adminDashboard') }}" class="logo">
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
                        <h3 class="fw-bold mb-3">Attendance</h3>
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
                                <a href="#">Attendance</a>
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
                                        <h4 class="card-title">Attendance</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <!-- Search Form -->
                                    <div>

                                    </div>
                                    <form method="GET" class="mb-2">
                                        <div class="row g-2">
                                            <!-- Start Date & Time -->
                                            <div class="col-12 col-md-4">
                                                <label class="form-label fw-bold">Start Date & Time</label>
                                                <div class="input-group w-100">
                                                    <span class="input-group-text bg-primary text-white"><i class="fa fa-calendar"></i></span>
                                                    <input type="datetime-local" name="start_datetime" class="form-control" value="{{ request('start_datetime') }}">
                                                </div>
                                            </div>

                                            <!-- End Date & Time -->
                                            <div class="col-12 col-md-4">
                                                <label class="form-label fw-bold">End Date & Time</label>
                                                <div class="input-group w-100">
                                                    <span class="input-group-text bg-primary text-white"><i class="fa fa-calendar"></i></span>
                                                    <input type="datetime-local" name="end_datetime" class="form-control" value="{{ request('end_datetime') }}">
                                                </div>
                                            </div>

                                            <!-- Search Box -->
                                            <div class="col-12 col-md-4">
                                                <label class="form-label fw-bold">Search</label>
                                                <div class="input-group w-100">
                                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>



                                    <!-- Table Display -->
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Registration Status</th> --}}
                                                    <th>Assigned Cooperative</th>
                                                    <th>Attendance Date & Time</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Congress Type</th>
                                                    <th>QR Code</th>
                                                    <th>Action</th>
                                                    {{-- <th>Manage Status</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($participants as $participant)
                                                    <tr>
                                                        {{-- <td>{{ $participant->registration->status ?? 'Pending' }}</td> --}}
                                                        <td>{{ optional($participant->cooperative)->name ?? 'N/A' }}
                                                        </td>
                                                        <td>
                                                            {{ $participant->attendance_datetime ? \Carbon\Carbon::parse($participant->attendance_datetime)->format('F j, Y g:i A') : 'Not Attended' }}
                                                        </td>
                                                        <td>{{ $participant->first_name }}</td>
                                                        <td>{{ $participant->last_name }}</td>
                                                        <td>{{ $participant->congress_type ?? 'N/A' }}</td>
                                                        <td>
                                                            @if ($participant->qr_code)
                                                                <img src="{{ asset('storage/' . $participant->qr_code) }}"
                                                                    alt="QR Code"
                                                                    style="width: 100px; height: 100px;">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a href="{{ route('attendance.show', $participant->participant_id) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Participant Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                        </td>

                                                <td>
                                            </td>
                                    </div>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No participants found</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                    </table>
                                </div>

                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: '{{ session('success') == 'Deleted!' ? 'Deleted!' : 'Success!' }}',
                                            text: '{{ session('success') }}',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>
                                @endif
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $participants->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                                </div>
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
