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
</style>
<style>
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

    @media (max-width: 576px) {

        /* For small screens */
        .modal-dialog {
            max-width: 90%;
            margin: auto;
        }
    }
</style>

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
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">My
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
                            <h3 class="fw-bold mb-3">Admin Dashboard</h3>
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
                            <div class="modal fade" id="reportModal" tabindex="-1"
                                aria-labelledby="reportModalLabel" aria-hidden="true">
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


                                                <a href="{{ route('admin.reports.summary_delegates') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="summary_delegates">
                                                    <i class="fas fa-user-friends me-2"></i> Summary of Delegates Per
                                                    Congress
                                                </a>


                                                <a href="{{ route('admin.reports.tshirt_sizes') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="tshirt_sizes">
                                                    <i class="fas fa-tshirt me-2"></i> T-Shirt Sizes (All or Per
                                                    Congress)
                                                </a>


                                                <a href="{{ route('admin.reports.coop_registration_summary') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="coop_registration">
                                                    <i class="fas fa-building me-2"></i> Coop Registration Summary with
                                                    Breakdown
                                                </a>



                                                <a href="{{ route('admin.reports.participants_list') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="participants_list">
                                                    <i class="fas fa-users me-2"></i> List of Voting Delegates
                                                </a>

                                                <div class="d-flex gap-3">
                                                    <a href="{{ route('admin.reports.coop_status_list') }}" class="list-group-item list-group-item-action py-3 fw-semibold" data-report-type="coop_status">
                                                        <i class="fas fa-clipboard-list me-2"></i> List of Coop Registration Status
                                                    </a>

                                                    <button type="button" class="list-group-item list-group-item-action py-3 fw-semibold" id="filterRegionBtn" data-bs-toggle="modal" data-bs-target="#regionFilterModal">
                                                        <i class="fas fa-filter me-2"></i> Filter List of Coop Registration Status
                                                    </button>

                                                </div>

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

                        </div>

                        <div class="modal fade" id="regionFilterModal" tabindex="-1" aria-labelledby="regionFilterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg"> <!-- Increased size for better preview -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="regionFilterLabel">Filter Cooperatives</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="regionSelect">Select Region:</label>
                                        <select id="regionSelect" class="form-select">
                                            <option value="">All Regions</option>
                                            <option value="Region I">Region I</option>
                                            <option value="Region II">Region II</option>
                                            <option value="Region III">Region III</option>
                                            <option value="Region IV-A">Region IV-A</option>
                                            <option value="Region IV-B">Region IV-B</option>
                                            <option value="Region V">Region V</option>
                                            <option value="Region VI">Region VI</option>
                                            <option value="Region VII">Region VII</option>
                                            <option value="Region VIII">Region VIII</option>
                                            <option value="Region IX">Region IX</option>
                                            <option value="Region X">Region X</option>
                                            <option value="Region XI">Region XI</option>
                                            <option value="Region XII">Region XII</option>
                                            <option value="Region XIII">Region XIII</option>
                                            <option value="NCR">NCR</option>
                                            <option value="CAR">CAR</option>
                                            <option value="BARMM">BARMM</option>
                                            <option value="ZBST">ZBST</option>
                                            <option value="LUZON">LUZON</option>
                                        </select>

                                        <label for="migsStatusSelect">Select MIGS Status:</label>
                                        <select id="migsStatusSelect" class="form-select">
                                            <option value="">All</option>
                                            <option value="Migs">MIGS</option>
                                            <option value="Non-migs">Non-MIGS</option>
                                        </select>

                                        <label for="registrationStatusSelect">Select GA Registration Status:</label>
                                        <select id="registrationStatusSelect" class="form-select">
                                            <option value="">All</option>
                                            <option value="Fully Registered">Fully Registered</option>
                                            <option value="Partial Registered">Partial Registered</option>
                                        </select>

                                        <!-- Table to Preview Filtered Data -->
                                        <h5 class="mt-3">Preview</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Cooperative Name</th>
                                                        <th>Coop ID</th>
                                                        <th>Region</th>
                                                        <th>No. of Participants</th>
                                                        <th>GA Registration Status</th>
                                                        <th>GA Membership Status</th>
                                                        <th>Financial Statement</th>
                                                        <th>Resolution for Voting Delegates</th>
                                                        <th>Deposit Slip for Registration Fee</th>
                                                        <th>Deposit Slip for CETF Remittance</th>
                                                        <th>CETF Undertaking</th>
                                                        <th>Certificate of Candidacy</th>
                                                        <th>CETF Utilization Invoice</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="previewTableBody">
                                                    <tr>
                                                        <td colspan="13" class="text-center">No data available</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="previewData" class="btn btn-info">Preview Data</button>
                                        <button type="button" id="applyRegionFilter" class="btn btn-primary">Generate Excel</button>
                                    </div>
                                </div>
                            </div>
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

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-primary text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Registered Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-success text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Registered Migs Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredMigsCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Registered Non-Migs Coops -->
                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-danger text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Registered Non-Migs Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredNonMigsCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fully Registered Participants -->
                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-success text-center">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Fully Registered Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($fullyRegisteredCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Partially Registered Coops -->
                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-warning text-center">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Partially Registered Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($partiallyRegisteredCoops) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-secondary text-center">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Registered Participants</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredParticipants) }}</h4>
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
                                        <p class="card-category mb-1">Registered MIGS Participants</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalMigsParticipants ?? 0) }}
                                        </h4>
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
                                        <p class="card-category mb-1">Registered NON-MIGS Participants</p>
                                        <h4 class="card-title mb-0">
                                            {{ number_format($totalNonMigsParticipants ?? 0) }}</h4>
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
                                            <i class="fas fa-hand-paper"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="card-category mb-1">Total Voting Delegates</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalVoting) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">


                            <div class="card card-round shadow-lg">
                                <h3 class="p-4 text-center text-white bg-primary rounded-top">Attendance Status</h3>
                                <!-- Title -->

                                <div class="card-body p-4">
                                    <div class="row">
                                        <!-- Total Coop Attended -->
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-info text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-users fa-lg"></i> <!-- Total Coop Icon -->
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-category mb-1 text-muted">Total Coop Attended
                                                        </p>
                                                        <h4 class="card-title mb-0 text-dark">
                                                            {{ number_format($totalCoopAttended) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total MIGS Coop Attended -->
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-success text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-user-friends fa-lg"></i>
                                                            <!-- MIGS Coop Icon -->
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-category mb-1 text-muted">Attended MIGS COOPS
                                                        </p>
                                                        <h4 class="card-title mb-0 text-dark">
                                                            {{ number_format($totalMigsAttended) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total NON-MIGS Coop Attended -->
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-danger text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-user-times fa-lg"></i>
                                                            <!-- NON-MIGS Coop Icon -->
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-category mb-1 text-muted">Attended NON-MIGS
                                                            COOPS</p>
                                                        <h4 class="card-title mb-0 text-dark">
                                                            {{ number_format($totalNonMigsAttended) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total Attended Voting Participants -->
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-primary text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-check-circle fa-lg"></i>
                                                            <!-- Voting Icon -->
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-category mb-1 text-muted">Total Participants
                                                            Attended</p>
                                                        <h4 class="card-title mb-0 text-dark">
                                                            {{ number_format($totalVotingParticipants) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-round shadow-lg">
                                <h3 class="p-4 text-center text-white bg-primary rounded-top">Event Attendance Status
                                </h3> <!-- Title -->


                                <div class="card-body p-4">
                                    <div class="row">
                                        @foreach ($events as $event)
                                            <div class="col-md-4 mb-4">
                                                <div class="card card-stats card-round shadow-sm h-100">
                                                    <div class="card-body d-flex align-items-center p-3">
                                                        <div class="col-icon me-3">
                                                            <div
                                                                class="icon-big text-primary text-center rounded-circle bg-light p-3">
                                                                <i class="fas fa-calendar-check fa-lg"></i>
                                                                <!-- Event Icon -->
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="card-category mb-1 text-muted">
                                                                {{ $event->title }}</p>
                                                            <h4 class="card-title mb-0 text-dark">
                                                                {{ number_format($event->participants_count) }}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-md-4 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-primary text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-user"></i>
                                                            <!-- Event Icon -->
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-category mb-1 text-muted">
                                                            Voted Delegates
                                                        <h4 class="card-title mb-0 text-dark">
                                                            0
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    data-bs-interval="7000" data-bs-wrap="true">

                                    <style>
                                        .card-title {
                                            white-space: nowrap;  /* Prevents text from wrapping */
                                            overflow: hidden;     /* Hides overflowing text */
                                            text-overflow: ellipsis; /* Adds '...' when text is too long */
                                            max-width: 80%;  /* Adjust based on your layout */
                                            display: inline-block;
                                            vertical-align: middle;
                                        }
                                    </style>

                                    <div class="carousel-inner">
                                        @foreach ($latestEvents as $index => $event)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div style="padding: 0 1px;">
                                                    <div class="card card-primary card-round mb-3">
                                                        <div class="card-header">
                                                            <div class="card-head-row">
                                                                <div class="card-title" title="{{ $event->title }}">{{ $event->title }}</div> <!-- Tooltip added -->
                                                                <div class="card-tools">
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-sm btn-label-light dropdown-toggle"
                                                                            type="button"
                                                                            id="dropdownMenuButton{{ $event->event_id }}"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            More Options
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $event->event_id }}">
                                                                            <a class="dropdown-item" href="{{ route('events.index') }}">View Details</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-category">
                                                                {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul>
                                                                <li><strong>📍 Venue:</strong> {{ $event->location }}</li>
                                                                <li><strong>🎤 Guest Speakers:</strong>
                                                                    @if ($event->speakers->count() > 0)
                                                                        {{ $event->speakers->pluck('name')->implode(', ') }}
                                                                    @else
                                                                        No speakers listed
                                                                    @endif
                                                                </li>
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



                            <style>
                                .event-card {
                                    transition: 0.3s;
                                    max-width: 550px;
                                    margin: auto;
                                    border-radius: 15px;
                                    overflow: hidden;
                                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                                }

                                .event-card:hover {
                                    transform: scale(1.02);
                                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
                                }

                                .event-card-header {
                                    background: linear-gradient(45deg, #007bff, #00c6ff);
                                    color: white;
                                    padding: 15px;
                                    text-align: center;
                                }

                                .event-card-header h5 {
                                    margin-bottom: 5px;
                                    font-weight: bold;
                                }

                                .event-card-body {
                                    padding: 20px;
                                    display: flex;
                                    flex-direction: column;
                                    gap: 12px;
                                }

                                .event-item {
                                    display: flex;
                                    align-items: center;
                                    padding: 12px 15px;
                                    transition: 0.3s;
                                    border-radius: 10px;
                                    background: #f9f9f9;
                                    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                                }

                                .event-item:hover {
                                    background: #f1f1f1;
                                    transform: scale(1.02);
                                }

                                .event-item .badge {
                                    font-size: 14px;
                                    padding: 8px 12px;
                                    min-width: 60px;
                                    text-align: center;
                                    font-weight: bold;
                                    border-radius: 10px;
                                }

                                .event-footer {
                                    background: linear-gradient(45deg, #ff6f61, #ff9068);
                                    color: white;
                                    padding: 15px;
                                    text-align: center;
                                    font-weight: bold;
                                    cursor: pointer;
                                    transition: 0.3s;
                                    border-bottom-left-radius: 15px;
                                    border-bottom-right-radius: 15px;
                                }

                                .event-footer:hover {
                                    background: linear-gradient(45deg, #ff5733, #ff784f);
                                    transform: scale(1.02);
                                }
                            </style>

                            <div class="card event-card">
                                <div class="event-card-header">
                                    <h5><i class="fas fa-calendar-alt"></i> Important Dates</h5>
                                    <small>Don't miss the General Assembly 2025!</small>
                                </div>
                                <div class="event-card-body">
                                    <div class="event-item">
                                        <span class="badge bg-primary">Mar 17</span>
                                        <span class="text-start flex-grow-1 ms-3">Start of Online Registration</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-success">Apr 01</span>
                                        <span class="text-start flex-grow-1 ms-3">Start of Filing Candidacy</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-danger">May 17</span>
                                        <span class="text-start flex-grow-1 ms-3">End of Filing of Candidacy</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-warning text-dark">May 21</span>
                                        <span class="text-start flex-grow-1 ms-3">Ceremonial Opening of Election</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-info">May 22</span>
                                        <span class="text-start flex-grow-1 ms-3">End of Registration for Non-Voting</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-secondary">May 23</span>
                                        <span class="text-start flex-grow-1 ms-3">Sectoral Congress 55th Co-op Leaders</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-primary">May 24</span>
                                        <span class="text-start flex-grow-1 ms-3">55th Co-op Leaders Assembly</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-success">May 25</span>
                                        <span class="text-start flex-grow-1 ms-3">51st General Assembly</span>
                                    </div>
                                </div>
                                <div class="event-footer">
                                    🚀 Be part of this amazing event!
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


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('registrationChart').getContext('2d');
            var registrationChart = new Chart(ctx, {
                type: 'bar', // Change to 'bar' for a bar chart
                data: {
                    labels: [
                        'Fully Registered Coops',
                        'Partially Registered Coops',
                        'Fully Registered Participants',
                        'Partially Registered Participants',
                    ],
                    datasets: [{
                        label: 'Number of Registrations',
                        data: [
                            {{ $fullyRegisteredCoops }},
                            {{ $partiallyRegisteredCoops }},
                            {{ $fullyRegisteredParticipants }},
                            {{ $partiallyRegisteredParticipants }},
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.6)', // Green
                            'rgba(255, 193, 7, 0.6)', // Yellow
                            'rgba(23, 162, 184, 0.6)', // Blue
                            'rgba(220, 53, 69, 0.6)', // Red
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(23, 162, 184, 1)',
                            'rgba(220, 53, 69, 1)',
                        ],
                        borderWidth: 2,
                        borderRadius: 5, // Optional, to round the corners of the bars
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top', // Positions the legend at the top
                            labels: {
                                // This callback will format the label to include the number
                                generateLabels: function(chart) {
                                    var labels = Chart.defaults.plugins.legend.labels.generateLabels(
                                        chart);
                                    labels.forEach(function(label, index) {
                                        label.text = label.text + ': ' + chart.data.datasets[0]
                                            .data[index];
                                    });
                                    return labels;
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    // Display the label along with the value in the tooltip
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    },
                    // Displaying the numbers on top of the bars
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'easeInOutQuad',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 14
                                },
                                // Displaying the number on the y-axis
                                callback: function(value) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            });

            // Add data labels above the bars (numbers)
            registrationChart.options.plugins.datalabels = {
                anchor: 'end',
                align: 'top',
                formatter: function(value, ctx) {
                    return value; // Display the numeric value on top of each bar
                },
                font: {
                    size: 14,
                    weight: 'bold'
                }
            };
            registrationChart.update();
        });
    </script>


    @include('layouts.links')
    <!-- JavaScript -->
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const applyRegionFilter = document.getElementById("applyRegionFilter");

    applyRegionFilter.addEventListener("click", function () {
        let selectedRegion = document.getElementById("regionSelect").value.trim();
        let migsStatus = document.getElementById("migsStatusSelect").value.trim();
        let registrationStatus = document.getElementById("registrationStatusSelect").value.trim();

        let exportUrl = "{{ route('reports.export.filtered_coop_status') }}"; // Laravel route

        let params = new URLSearchParams({
            region: selectedRegion || "All",
            migs_status: migsStatus || "All",
            registration_status: registrationStatus || "All"
        });

        // Redirect to export URL with filters
        window.location.href = exportUrl + "?" + params.toString();
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const previewDataBtn = document.getElementById("previewData");
        const applyRegionFilter = document.getElementById("applyRegionFilter");
        const previewTableBody = document.getElementById("previewTableBody");

        previewDataBtn.addEventListener("click", function () {
            let selectedRegion = document.getElementById("regionSelect").value.trim();
            let migsStatus = document.getElementById("migsStatusSelect").value.trim();
            let registrationStatus = document.getElementById("registrationStatusSelect").value.trim();

            fetch("{{ route('reports.preview.filtered_coop_status') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    region: selectedRegion || "All",
                    migs_status: migsStatus || "All",
                    registration_status: registrationStatus || "All"
                })
            })
            .then(response => response.json())
            .then(data => {
                previewTableBody.innerHTML = ""; // Clear previous data

                if (data.length === 0) {
                    previewTableBody.innerHTML = `<tr><td colspan="13" class="text-center">No data found</td></tr>`;
                    applyRegionFilter.disabled = true;
                    return;
                }

                applyRegionFilter.disabled = false; // Enable Generate Excel button

                data.forEach(coop => {
    let registrationStatus = coop.registration_status === "Rejected" ? "Unregistered" : coop.registration_status;

    let row = `
        <tr>
            <td>${coop.name}</td>
            <td>${coop.coop_identification_no}</td>
            <td>${coop.region}</td>
            <td>${coop.participants_count}</td>
            <td>${registrationStatus}</td>
            <td>${coop.membership_status}</td>
            <td>${coop.documents?.['Financial Statement'] ?? 'Not Uploaded'}</td>
            <td>${coop.documents?.['Resolution for Voting Delegates'] ?? 'Not Uploaded'}</td>
            <td>${coop.documents?.['Deposit Slip for Registration Fee'] ?? 'Not Uploaded'}</td>
            <td>${coop.documents?.['Deposit Slip for CETF Remittance'] ?? 'Not Uploaded'}</td>
            <td>${coop.documents?.['CETF Undertaking'] ?? 'Not Uploaded'}</td>
            <td>${coop.documents?.['Certificate of Candidacy'] ?? 'Not Uploaded'}</td>
            <td>${coop.documents?.['CETF Utilization Invoice'] ?? 'Not Uploaded'}</td>
        </tr>
    `;
    previewTableBody.innerHTML += row;
});
            })
            .catch(error => {
                console.error("Error fetching preview data:", error);
                previewTableBody.innerHTML = `<tr><td colspan="13" class="text-center text-danger">Error loading data</td></tr>`;
            });
        });

        applyRegionFilter.addEventListener("click", function () {
            let selectedRegion = document.getElementById("regionSelect").value.trim();
            let migsStatus = document.getElementById("migsStatusSelect").value.trim();
            let registrationStatus = document.getElementById("registrationStatusSelect").value.trim();

            let exportUrl = "{{ route('reports.export.filtered_coop_status') }}";

            let params = new URLSearchParams({
                region: selectedRegion || "All",
                migs_status: migsStatus || "All",
                registration_status: registrationStatus || "All"
            });

            window.location.href = exportUrl + "?" + params.toString();
        });
    });
    </script>





    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setInterval(() => {
                location.reload();
            }, 180000);
        });
    </script>

</body>

</html>
