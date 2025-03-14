<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<style>
    .list-group-item {
        transition: background-color 0.3s ease, transform 0.2s ease;
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: rgba(0, 123, 255, 0.1);
        /* Light blue background */
        transform: translateY(-3px);
        /* Slight lift effect */
    }

    .list-group-item:hover .badge {
        filter: brightness(1.2);
        /* Slightly brighten the badge */
    }

    /* Style the Prev and Next buttons */
    #eventsCarousel .carousel-control-prev,
    #eventsCarousel .carousel-control-next {
        width: 40px;
        height: 40px;
        background-color: white;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        /* Optional: always visible */
    }

    #eventsCarousel .carousel-control-prev-icon,
    #eventsCarousel .carousel-control-next-icon {
        filter: invert(32%) sepia(93%) saturate(2115%) hue-rotate(203deg) brightness(90%) contrast(90%);
        width: 20px;
        height: 20px;
    }

    #eventsCarousel .carousel-control-prev {
        left: -20px;
        /* Adjust position if needed */
    }

    #eventsCarousel .carousel-control-next {
        right: -20px;
        /* Adjust position if needed */
    }
</style>

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

                        {{-- <li class="nav-item">
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
                        </li> --}}

                        {{-- <li class="nav-item">
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
                        </li> --}}

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
                        </li> --}}

                        {{-- <li class="nav-item">
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
                        </li> --}}

                        {{-- <li class="nav-item">
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
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Support Dashboard</h3>
                            <h6 class="text-muted">MASS-SPECC Online Registration System</h6>
                            {{-- <p class="text-muted text-nowrap">
                    Logged in as: <strong>{{ Auth::user()->name }}</strong>
                    @if ($coop)
                        | Cooperative: <strong>{{ $coop->name }}</strong>
                    @else
                        | No Cooperative Assigned
                    @endif
                </p> --}}
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">

                            <!-- Button to open the modal -->
                            <button type="button"
                                class="btn btn-primary btn-lg d-flex align-items-center gap-2 shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="fas fa-chart-bar"></i> Generate Reports
                            </button>

                            <!-- Report Modal -->
                            <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content shadow-lg border-0 rounded-4">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title fw-bold" id="reportModalLabel">
                                                <i class="fas fa-file-alt me-2"></i> Select a Report
                                            </h5>
                                            {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                        </div>

                                        <div class="modal-body">
                                            <h6 class="fw-bold text-secondary mb-3">📌 Choose a report to view:</h6>
                                            <div class="list-group list-group-flush">
                                                <a href="{{ route('admin.reports') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="voting_delegates">
                                                    <i class="fas fa-users me-2"></i> Voting Delegates Status/Count
                                                    Report
                                                </a>
                                                <a href="{{ route('admin.reports.documents_status') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="documents_status">
                                                    <i class="fas fa-file-signature me-2"></i> Status Report on
                                                    Documents Required
                                                </a>


                                                <a href="#"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold">
                                                    <i class="fas fa-user-friends me-2"></i> Summary of Delegates Per
                                                    Congress
                                                </a>
                                                <a href="#"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold">
                                                    <i class="fas fa-tshirt me-2"></i> T-Shirt Sizes (All or Per
                                                    Congress)
                                                </a>
                                                <a href="#"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold">
                                                    <i class="fas fa-building me-2"></i> Coop Registration Summary with
                                                    Breakdown
                                                </a>
                                            </div>

                                            <hr class="my-4">
                                            <h6 class="fw-bold text-secondary">📊 Report Preview:</h6>
                                            <div class="border rounded-3 overflow-hidden shadow-sm">
                                                <iframe id="reportFrame" src="" width="100%"
                                                    height="400px" frameborder="0"></iframe>
                                            </div>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary px-4"
                                                data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i> Close
                                            </button>

                                            <!-- Export Options -->
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle px-4" type="button"
                                                    id="exportDropdown" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-download"></i> Export Options
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                                    <li><a class="dropdown-item d-flex align-items-center gap-2"
                                                            href="#" onclick="printReport()">
                                                            <i class="fas fa-print"></i> Print or Export as PDF
                                                        </a></li>
                                                    <li><a class="dropdown-item d-flex align-items-center gap-2"
                                                            href="#" id="exportExcel" target="_blank">
                                                            <i class="fas fa-file-excel"></i> Export as Excel
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>
                                @media (max-width: 576px) {

                                    /* For small screens */
                                    .modal-dialog {
                                        max-width: 90%;
                                        margin: auto;
                                    }
                                }
                            </style>

                            <div class="modal fade" id="qrScannerModal" tabindex="-1"
                                aria-labelledby="qrScannerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="qrScannerModalLabel">Scan QR Code</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div id="qr-reader" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="text" id="qr-input-field"
                                style="position: absolute; opacity: 0; width: 1px; height: 1px;" />
                            <div id="qr-display"></div>

                        </div>
                        <div id="scanner-container" style="display:none;">
                            <video id="preview" width="100%" height="auto"></video>
                        </div>

                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3 mb-4">

                        <!-- Cooperative -->
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-primary text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Cooperatives</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalCooperative) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Participants -->
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-success text-center">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Participants</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalParticipants) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Attended -->
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-info text-center">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Total Attended</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalAttended) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Attended Migs -->
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-warning text-center">
                                            <i class="fas fa-user-friends"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Attended Migs</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalMigsAttended) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Migs Participants -->
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-danger text-center">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Migs Members</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalMigsParticipants) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Non-Migs Participants -->
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-secondary text-center">
                                            <i class="fas fa-user-times"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Non-Migs Members</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalNonMigsParticipants) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8">


                            <div class="card card-round">
                                <h3 class="p-3 text-center"> Registration Overview</h3> <!-- Added title -->
                                <div class="card-header d-flex justify-content-between align-items-center">


                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <!-- Display the totals as button-like elements -->
                                        <div class="btn btn-success">
                                            <strong>Fully Registered Coops</strong>: {{ $fullyRegisteredCoops }}
                                        </div>
                                        <div class="btn btn-warning">
                                            <strong>Partially Registered Coops</strong>:
                                            {{ $partiallyRegisteredCoops }}
                                        </div>
                                        <div class="btn btn-info">
                                            <strong>Fully Registered Participants</strong>:
                                            {{ $fullyRegisteredParticipants }}
                                        </div>
                                        <div class="btn btn-danger">
                                            <strong>Partially Registered Participants</strong>:
                                            {{ $partiallyRegisteredParticipants }}
                                        </div>
                                        <!-- Button to open the modal -->

                                    </div>

                                </div>

                                <div class="card-body h-100">
                                    <canvas id="registrationChart" style="height: 100rem;"></canvas>
                                </div>
                            </div>

                        </div>

                        <div class="modal" tabindex="-1" id="overviewModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Registration Overview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Overview content to be printed -->
                                        <div id="overviewContent">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-primary">
                                                        <th>Category</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Fully Registered Coops</td>
                                                        <td>{{ $fullyRegisteredCoops }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Partially Registered Coops</td>
                                                        <td>{{ $partiallyRegisteredCoops }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fully Registered Participants</td>
                                                        <td>{{ $fullyRegisteredParticipants }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Partially Registered Participants</td>
                                                        <td>{{ $partiallyRegisteredParticipants }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Print button -->
                                        <button id="printOverview" class="btn btn-primary">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4">
                            @if ($latestEvents->count() > 0)
                                <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="2000" data-bs-wrap="true">

                                    <div class="carousel-inner">
                                        @foreach ($latestEvents as $index => $event)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div style="padding: 0 2px;"> <!-- Added 10px padding -->
                                                    <div class="card card-primary card-round mb-3">
                                                        <div class="card-header">
                                                            <div class="card-head-row">
                                                                <div class="card-title">{{ $event->title }}</div>
                                                                <div class="card-tools">

                                                                </div>
                                                            </div>
                                                            <div class="card-category">
                                                                {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <p>{{ $event->description }}</p>
                                                            <ul>
                                                                <li><strong>📍 Venue:</strong> {{ $event->location }}
                                                                </li>
                                                                <li><strong>🕒 Time:</strong> 9:00 AM - 5:00 PM</li>
                                                                <li><strong>🎤 Guest Speakers:</strong>
                                                                    @if ($event->speakers->count() > 0)
                                                                        {{ $event->speakers->pluck('name')->implode(', ') }}
                                                                    @else
                                                                        No speakers listed
                                                                    @endif
                                                                </li>
                                                                <li><strong>📌 Activities:</strong> Presentations, Q&A
                                                                    Sessions, Voting</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Prev/Next buttons -->
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#eventsCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#eventsCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>

                                </div>
                            @else
                                <p>No upcoming events at the moment.</p>
                            @endif



                            <div class="card shadow-lg border-0 rounded-3 overflow-hidden"
                                style="transition: 0.3s; max-width: 500px; margin: auto;">
                                <div class="card-header text-white bg-primary rounded-top">
                                    <h5 class="mb-1"><i class="fas fa-calendar-alt"></i> Dates to Remember!</h5>
                                    <small>Join us for the upcoming General Assembly 2024!</small>
                                </div>
                                <div class="card-body p-3" style="max-height: 300px; overflow-y: auto;">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-primary">Feb - Apr</span>
                                            <span class="text-start flex-grow-1 ms-2">Presentation of 2024 election
                                                guidelines.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-success">March 4</span>
                                            <span class="text-start flex-grow-1 ms-2">Start of delegate
                                                registration.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-danger">May 20</span>
                                            <span class="text-start flex-grow-1 ms-2">Start of filing Certificate of
                                                Candidacy.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-warning text-dark">May 22-24</span>
                                            <span class="text-start flex-grow-1 ms-2">End of COC filing, CETF
                                                remittance & voter registration.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-info">May 22</span>
                                            <span class="text-start flex-grow-1 ms-2">Mock election & Elecom
                                                review.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-secondary">May 23</span>
                                            <span class="text-start flex-grow-1 ms-2">Candidate profiles sent to voting
                                                delegates.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-primary">May 27</span>
                                            <span class="text-start flex-grow-1 ms-2">Ceremonial opening of
                                                elections.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-success">May 28</span>
                                            <span class="text-start flex-grow-1 ms-2">Online voting continues.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-danger">May 29</span>
                                            <span class="text-start flex-grow-1 ms-2">54th Leaders Congress & Election
                                                closing.</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span class="badge bg-warning text-dark">May 30</span>
                                            <span class="text-start flex-grow-1 ms-2">Holy Mass & Proclamation of
                                                winners.</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-light rounded-bottom">
                                    <span class="badge bg-primary p-2"
                                        style="cursor: pointer; transition: 0.3s;">Don't miss this event!</span>
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
        // Open the modal when the "Preview Overview" button is clicked
        document.getElementById("openModal").addEventListener("click", function() {
            var myModal = new bootstrap.Modal(document.getElementById('overviewModal'));
            myModal.show();
        });

        // Print the overview content when the "Print" button is clicked
        document.getElementById("printOverview").addEventListener("click", function() {
            var printContent = document.getElementById('overviewContent').innerHTML;
            var newWindow = window.open('', '', 'height=600,width=800');
            newWindow.document.write('<html><head><title>Print Preview</title></head><body>');
            newWindow.document.write(printContent);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        });
    </script>
    <!-- Load jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Load autoTable plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <!-- Load your custom script -->
    <script src="{{ asset('js/registration-overview.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('registrationChart').getContext('2d');
            var registrationChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Fully Registered Coops',
                        'Partially Registered Coops',
                        'Fully Registered Participants',
                        'Partially Registered Participants',
                        // 'Total Events',

                    ],
                    datasets: [{
                        label: 'Number of Registrations',
                        data: [
                            {{ $fullyRegisteredCoops }},
                            {{ $partiallyRegisteredCoops }},
                            {{ $fullyRegisteredParticipants }},
                            {{ $partiallyRegisteredParticipants }},
                            // {{ $totalEvents }},

                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.6)', // Green
                            'rgba(255, 193, 7, 0.6)', // Yellow
                            'rgba(23, 162, 184, 0.6)', // Blue
                            'rgba(220, 53, 69, 0.6)', // Red
                            'rgba(102, 16, 242, 0.6)', // Purple for Events
                            'rgba(232, 62, 140, 0.6)' // Pink for Speakers
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(23, 162, 184, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(102, 16, 242, 1)',
                            'rgba(232, 62, 140, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert -->

    <script>
        var exportBaseUrl = "{{ route('reports.export') }}";
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reportFrame = document.getElementById("reportFrame");
            const exportExcel = document.getElementById("exportExcel");


            // Get the base export URL from a data attribute in the button
            const exportBaseUrl = "{{ route('reports.export') }}";

            document.querySelectorAll(".list-group-item").forEach(item => {
                item.addEventListener("click", function(event) {
                    event.preventDefault();
                    const reportType = this.getAttribute(
                        "data-report-type"); // Add a data attribute for report type
                    const reportUrl = this.getAttribute("href");

                    if (reportUrl) {
                        reportFrame.src = reportUrl;
                        exportExcel.href = exportBaseUrl + "?report=" + encodeURIComponent(
                            reportType) + "&export=excel";
                    }
                });
            });

        });

        function printReport() {
            var iframe = document.getElementById('reportFrame').contentWindow;
            iframe.focus();
            iframe.print();
        }
    </script>

    @include('layouts.links')
</body>

</html>
