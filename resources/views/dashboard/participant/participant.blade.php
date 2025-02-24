<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
</head>

<body>
    <style>
        .wrapper{
            overflow-x: hidden;
        }

        @media (max-width: 992px) {
         .main-panel .row {
        --bs-gutter-x: 1px;
        }
        }

        /* Small screens (mobile) */
        @media (max-width: 768px) {
            .main-panel .row {
                --bs-gutter-x: 1px;
            }
        }

        /* Extra small screens */
        @media (max-width: 576px) {
            .main-panel .row {
                --bs-gutter-x: 1px;
            }
        }
    </style>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('participantDashboard') }}" class="logo">
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
                            <a href="{{ route('participantDashboard') }}" class="collapsed">
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
                            <a data-bs-toggle="collapse" href="#participant">
                                <i class="fas fa-users"></i>
                                <p>Participant</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="participant">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('coop.index') }}">
                                            <span class="sub-item">Participants</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#cooperative">
                                <i class="fas fa-users"></i>
                                <p>Resource Speakers</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="cooperative">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('speakerlist') }}">
                                            <span class="sub-item">List of Resource Speakers</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#user">
                                <i class="fas fa-user"></i>
                                <p>Events Schedule</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="user">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('schedule') }}">
                                            <span class="sub-item">List of Events</span>
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
                        <a href="" class="logo">
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
                                            <a class="dropdown-item" href="{{ route('participant.profile.edit') }}">My
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

                    <div class="d-flex flex-column flex-md-row align-items-center text-center text-md-start pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Cooperative Dashboard</h3>
                        </div>
                        <div
                            class="d-flex flex-column flex-sm-row gap-2 w-100 justify-content-center justify-content-md-end py-2 py-md-0">
                            @if ($coop)
                                <a href="{{ route('cooperativeprofile', ['coop_id' => $coop->coop_id]) }}"
                                    class="btn btn-label-info btn-round me-2">
                                    Cooperative Profile
                                </a>
                            @else
                                <a class="btn btn-info btn-round">No Cooperative Associated Yet</a>
                            @endif
                            <a href="#" id="viewDocumentsBtn" class="btn btn-primary btn-round">View Uploaded
                                Documents</a>
                        </div>
                    </div>

                    <!-- Dashboard Cards -->
                    <div class="row">
                        <!-- Registration Status -->
                        <!-- Registration Status -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Registration Status</p>
                                                <h4
                                                    class="card-title
                            {{ $registrationStatus === 'Fully Registered'
                                ? 'text-success'
                                : ($registrationStatus === 'Partial Registered'
                                    ? 'text-warning'
                                    : 'text-danger') }}">
                                                    {{ $registrationStatus }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Membership Status -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Membership Status</p>
                                                <h4
                                                    class="card-title
                            {{ $membershipStatus === 'Migs' ? 'text-success' : 'text-danger' }}">
                                                    {{ $membershipStatus === 'Migs' ? 'Migs' : 'Non-migs' }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Registration Section -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Registration Open (March 15-17, 2025)</p>
                                                {{-- <h4 class="card-title">March 15-17, 2025</h4> --}}
                                                <a href="{{ route('coop.index') }}"
                                                    class="btn btn-sm btn-outline-info mt-2">Register Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Required Documents -->
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                                <i class="fas fa-file-upload"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Required Documents</p>
                                                @php
                                                    $user = Auth::user();
                                                    $cooperative = $user->cooperative; // Get the cooperative of the logged-in user
                                                    $hasDocuments = $cooperative
                                                        ? $cooperative->uploadedDocuments()->exists()
                                                        : false;
                                                    $registrationStatus =
                                                        $cooperative && $cooperative->registration
                                                            ? $cooperative->registration->status
                                                            : 'Pending';
                                                @endphp

                                                <button id="uploadBtn" class="btn btn-sm btn-outline-primary mt-2">
                                                    {{ $hasDocuments ? 'Upload Again' : 'Upload Now' }}
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-round">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">CETF Calculator</div>
                                            <div class="card-tools">
                                                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-label-info btn-round btn-sm">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="cetfForm">
                                            <div class="form-group">
                                                <label for="totalAsset">Total Asset (Latest Audited FS)</label>
                                                <input type="number" class="form-control" id="totalAsset"
                                                    required />
                                            </div>
                                            <div class="form-group">
                                                <label for="totalIncome">Total Income (Latest Audited FS)</label>
                                                <input type="number" class="form-control" id="totalIncome"
                                                    required />
                                            </div>
                                            <div class="form-group">
                                                <label for="cetfRemittance">CETF Remittance to MSP</label>
                                                <input type="number" class="form-control" id="cetfRemittance"
                                                    required />
                                            </div>
                                            <div class="form-group">
                                                <label for="cetfRequired">CETF Required</label>
                                                <input type="text" class="form-control" id="cetfRequired"
                                                    readonly />
                                            </div>
                                            <button type="button" class="btn btn-primary mt-3"
                                                onclick="calculateCETF()">Compute</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                @if ($event)
                                    <div class="card card-primary card-round">
                                        <div class="card-header">
                                            <div class="card-head-row">
                                                <div class="card-title">{{ $event->title }}</div>
                                                <div class="card-tools">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-label-light dropdown-toggle"
                                                            type="button"
                                                            id="dropdownMenuButton{{ $event->event_id }}"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            More Options
                                                        </button>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton{{ $event->event_id }}">
                                                            <a class="dropdown-item"
                                                                href="{{ route('schedule') }}">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-category">
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} -
                                                {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $event->description }}</p>
                                            <ul>
                                                <li><strong>📍 Venue:</strong> {{ $event->location }}</li>
                                                <li><strong>🕒 Time:</strong> 9:00 AM - 5:00 PM</li>
                                                <li><strong>🎤 Guest Speakers:</strong>
                                                    @if ($event->speakers->count() > 0)
                                                        {{ $event->speakers->pluck('name')->implode(', ') }}
                                                    @else
                                                        No speakers listed
                                                    @endif
                                                </li>
                                                <li><strong>📌 Activities:</strong> Presentations, Q&A Sessions, Voting
                                                </li>
                                            </ul>
                                            <a href="#" class="btn btn-sm btn-outline-primary mt-2">Register
                                                Now</a>
                                        </div>
                                    </div>
                                @else
                                    <p>No upcoming events at the moment.</p>
                                @endif


                                @if ($event)
                                    <div class="card card-round">
                                        <div class="card-body pb-0">
                                            <h2 class="mb-2">Event Notice</h2>
                                            <p class="text-muted">Join us for the upcoming {{ $event->title }}!</p>
                                            <div class="pull-in sparkline-fix">
                                                <!-- You can insert a related event image or a calendar icon here -->
                                                <div id="eventNoticeChart"></div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="alert alert-info">
                                                <strong>Notice:</strong> The General Assembly will take place on
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} -
                                                {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }} Don't
                                                miss out on this important event!
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>No upcoming events at the moment.</p>
                                @endif
                            </div>
                        </div>

                    </div>

                    @include('layouts.adminfooter')

                </div>


            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('uploadBtn')?.addEventListener('click', function() {
                        @if (!$cooperative)
                            Swal.fire({
                                icon: 'warning',
                                title: 'Cooperative Required',
                                text: 'You need to be associated with a cooperative to upload documents.',
                                confirmButtonText: 'OK'
                            });
                        @else
                            window.location.href = "{{ route('documents') }}"; // Redirect if cooperative exists
                        @endif
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('viewDocumentsBtn')?.addEventListener('click', function() {
                        @if (!$hasDocuments)
                            Swal.fire({
                                icon: 'info',
                                title: 'No Documents Found',
                                text: 'You have not uploaded any documents yet.',
                                confirmButtonText: 'OK'
                            });
                        @else
                            window.location.href =
                            "{{ route('documents.view') }}"; // Redirect if there are documents
                        @endif
                    });
                });
            </script>


            <script>
                function calculateCETF() {
                    let totalIncome = parseFloat(document.getElementById('totalIncome').value) || 0;
                    let cetfRequired = (totalIncome * 0.05) * 0.30;
                    document.getElementById('cetfRequired').value = cetfRequired.toFixed(2);
                }
            </script>
            @include('layouts.links')
</body>

</html>
