<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
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

                        <li class="nav-item">
                            <a href="https://mass-specc.coop/2025-coopvention-registration/" class="nav-link"
                                title="Register for Coopvention" target="_blank">
                                <i class="fas fa-building"></i>
                                <p>Hotel Accomodation</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

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
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">

                            <button type="button"
                                class="btn btn-primary btn-lg d-flex align-items-center gap-2 shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="fas fa-chart-bar"></i> Generate Reports
                            </button>

                            <div class="modal fade" id="reportModal" tabindex="-1"
                                aria-labelledby="reportModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content shadow-lg border-0 rounded-4">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title fw-bold" id="reportModalLabel">
                                                <i class="fas fa-file-alt me-2"></i> Select a Report
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                    <i class="fas fa-user-friends me-2"></i> Summary of Cooperative Per
                                                    Region
                                                </a>

                                                <a href="{{ route('admin.reports.tshirt_sizes') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="tshirt_sizes">
                                                    <i class="fas fa-tshirt me-2"></i> T-Shirt Sizes Summary
                                                </a>

                                                <a href="{{ route('admin.reports.tshirt_sizes_list') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="tshirt_sizeslist">
                                                    <i class="fas fa-tshirt me-2"></i> T-Shirt Sizes List (All
                                                    Participants)
                                                </a>

                                                <a href="{{ route('admin.reports.officers') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="officers">
                                                    <i class="fas fa-user me-2"></i> List of Officers & Non Officers
                                                </a>

                                                <a href="{{ route('admin.reports.voting_per_region') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="voting_per_region">
                                                    <i class="fas fa-users me-2"></i> Voting Delegates Summary per
                                                    Region
                                                </a>

                                                <a href="{{ route('admin.reports.coop_registration_summary') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="coop_registration">
                                                    <i class="fas fa-building me-2"></i> Coop Registration Summary with
                                                    Breakdown
                                                </a>

                                                <a href="{{ route('admin.reports.coop_status_list') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="coop_status">
                                                    <i class="fas fa-clipboard-list me-2"></i> List of Coop
                                                    Registration Status
                                                </a>

                                                <button type="button"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    id="filterRegionBtn2" data-bs-toggle="modal"
                                                    data-bs-target="#regionFilterModal2">
                                                    <i class="fas fa-check me-2"></i> List of Voting Delegates
                                                </button>

                                                <a href="{{ route('admin.reports.participants_list_congress') }}"
                                                    class="list-group-item list-group-item-action py-3 fw-semibold"
                                                    data-report-type="participants_list_congress">
                                                    <i class="fas fa-users me-2"></i> List of Registered Delagate
                                                    Congresses
                                                </a>

                                                <div class="d-flex gap-3">

                                                    <a href="{{ route('admin.reports.coop_status_list') }}"
                                                        class="list-group-item list-group-item-action py-3 fw-semibold"
                                                        data-report-type="coop_status">
                                                        <i class="fas fa-clipboard-list me-2"></i> List of Coop
                                                        Registration Status
                                                    </a>

                                                    <button type="button"
                                                        class="list-group-item list-group-item-action py-3 fw-semibold"
                                                        id="filterRegionBtn" data-bs-toggle="modal"
                                                        data-bs-target="#regionFilterModal">
                                                        <i class="fas fa-filter me-2"></i> Filter List of Coop
                                                        Registration Status
                                                    </button>

                                                </div>

                                            </div>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="fw-bold text-secondary mb-0">📊 Report Preview:</h6>

                                                <div class="d-flex justify-content-between align-items-center gap-2">

                                                     <form action="{{ route('participants.voted.import') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <button class="btn btn-success dropdown-toggle px-4 custom-btn-dropdown" type="button"
                                                                onclick="document.getElementById('importFile').click()">
                                                                <i class="fas fa-upload"></i> Import Voted
                                                            </button>
                                                            <input type="file" id="importFile" name="import_file"
                                                                accept=".csv,.xlsx" style="display:none"
                                                                onchange="this.form.submit()">
                                                        </form>

                                                    <div class="dropdown">

                                                        <button
                                                            class="btn btn-success dropdown-toggle px-4 custom-btn-dropdown"
                                                            type="button" id="exportDropdown"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-download"></i> Export Options
                                                        </button>


                                                        <ul
                                                            class="dropdown-menu dropdown-menu-end shadow-lg custom-dropdown-menu">
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

                                            <div class="border rounded-3 overflow-hidden shadow-sm mt-3">
                                                <iframe id="reportFrame" src="" width="100%"
                                                    height="400px" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .dropdown-item2 {
                                padding: 10px 15px;
                                background-color: #f8f9fa;
                                /* Light background color */
                                color: #007bff;
                                /* Text color */
                                border-radius: 5px;
                                /* Rounded corners */
                                transition: background-color 0.3s, color 0.3s;
                                /* Smooth transition for hover effect */
                                text-decoration: none;
                                /* Remove underline */
                                display: block;
                                /* Ensure it behaves like a block element */
                            }

                            /* Hover effect */
                            .dropdown-item2:hover {
                                background-color: #007bff;
                                /* Dark background on hover */
                                color: #ffffff;
                                /* White text color on hover */
                                cursor: pointer;
                                /* Change cursor to pointer */
                            }

                            /* Optional: Active state styling (when selected) */
                            .dropdown-item2.active {
                                background-color: #0056b3;
                                /* Darker background for active item */
                                color: #ffffff;
                                /* White text for active item */
                            }
                        </style>


                        <!-- Modal for Region Filter -->
                        <div class="modal fade" id="regionFilterModal2" tabindex="-1"
                            aria-labelledby="regionFilterModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg"> <!-- or modal-xl -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="regionFilterModalLabel">Filter Voting Delegates by
                                            Region</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="dropdown">
                                            <!-- The button now shows the selected region -->
                                            <button class="btn btn-secondary dropdown-toggle w-100" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Select Region <span id="selectedRegion" class="text-muted">(All
                                                    Region)</span>
                                            </button>

                                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item2" href="#" data-region="all">All
                                                        Regions</a></li>

                                                @php
                                                    $regions = [
                                                        'Region I',
                                                        'Region II',
                                                        'Region III',
                                                        'Region IV-A',
                                                        'Region IV-B',
                                                        'Region V',
                                                        'Region VI',
                                                        'Region VII',
                                                        'Region VIII',
                                                        'Region IX',
                                                        'Region X',
                                                        'Region XI',
                                                        'Region XII',
                                                        'Region XIII',
                                                        'NCR',
                                                        'CAR',
                                                        'BARMM',
                                                        'ZBST',
                                                        'LUZON',
                                                    ];
                                                @endphp

                                                @foreach ($regions as $region)
                                                    <li><a class="dropdown-item2" href="#"
                                                            data-region="{{ $region }}">{{ $region }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <!-- Export and Preview Options -->
                                        <div class="mt-3">
                                            <!-- Preview Button -->
                                            <a id="previewButton" href="#" class="btn btn-info w-100">
                                                <i class="fas fa-eye me-2"></i> Preview Report
                                            </a>

                                            <!-- Export as Excel Button -->
                                            <a id="exportButton" href="#" class="btn btn-success w-100 mt-2">
                                                <i class="fas fa-file-excel me-2"></i> Export as Excel
                                            </a>
                                        </div>

                                        <!-- Container to show the preview content -->
                                        <div id="previewContent" class="mt-3"
                                            style="max-height: 500px; overflow-y: auto; display: none; border: 1px solid #ccc; padding: 15px;">
                                            <div class="text-center">
                                                <i class="fas fa-spinner fa-spin"></i> Loading preview...
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="regionFilterModal" tabindex="-1"
                            aria-labelledby="regionFilterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title d-flex align-items-center" id="regionFilterLabel">
                                            <i class="bi bi-funnel-fill me-2"></i> Filter Cooperatives
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="regionSelect" class="form-label fw-semibold text-muted">Select
                                                Region:</label>
                                            <select id="regionSelect" class="form-select custom-select">
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
                                        </div>

                                        <div class="mb-3">
                                            <label for="migsStatusSelect"
                                                class="form-label fw-semibold text-muted">Select Membership
                                                Status:</label>
                                            <select id="migsStatusSelect" class="form-select custom-select">
                                                <option value="">All</option>
                                                <option value="Migs">MIGS</option>
                                                <option value="Non-migs">Non-MIGS</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="registrationStatusSelect"
                                                class="form-label fw-semibold text-muted">Select GA Registration
                                                Status:</label>
                                            <select id="registrationStatusSelect" class="form-select custom-select">
                                                <option value="">All</option>
                                                <option value="Fully Registered">Fully Registered</option>
                                                <option value="Partial Registered">Partial Registered</option>
                                                <option value="Rejected">Not Registered</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="documentStatusSelect"
                                                class="form-label fw-semibold text-muted">Select Document
                                                Status:</label>
                                            <select id="documentStatusSelect" class="form-select custom-select">
                                                <option value="">All</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Accepted</option>
                                                <option value="Rejected">Declined</option>
                                            </select>
                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center modal-footer w-100">
                                            <h5 class="mt-3 text-muted"><i class="bi bi-bar-chart-line me-2"></i>📊
                                                Report Preview:</h5>
                                            <div>
                                                <button type="button" id="previewData" class="btn btn-info">Preview
                                                    Data</button>
                                                <button type="button" id="applyRegionFilter"
                                                    class="btn btn-success">Generate Excel</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
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
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mb-4">
                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-primary text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Cooperatives</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalCooperative) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-primary text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Registered Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-success text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Registered MIGS Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredMigsCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-danger text-center">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Registered NON-MIGS Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredNonMigsCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-success text-center">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Fully Registered Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($fullyRegisteredCoops) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-warning text-center">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Partially Registered Coops</p>
                                        <h4 class="card-title mb-0">{{ number_format($partiallyRegisteredCoops) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-secondary text-center">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Registered Participants</p>
                                        <h4 class="card-title mb-0">{{ number_format($registeredParticipants) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-danger text-center">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Registered MIGS Participants</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalMigsParticipants ?? 0) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-secondary text-center">
                                            <i class="fas fa-user-times"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Registered NON-MIGS Participants</p>
                                        <h4 class="card-title mb-0">
                                            {{ number_format($totalNonMigsParticipants ?? 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-stats card-round shadow-sm h-100">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <div class="col-icon me-3">
                                        <div class="icon-big text-success text-center">
                                            <i class="fas fa-hand-paper"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-category mb-1">Voting Delegates</p>
                                        <h4 class="card-title mb-0">{{ number_format($totalVoting) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card shadow-lg rounded-3">
                                <div class="bg-primary text-white text-center py-3 rounded-top">
                                    <h4 class="mb-0">Event Slot Status</h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row row-cols-1 row-cols-md-5 g-4">
                                        @foreach ($eventStatus as $eventId => $status)
                                            <div class="col">
                                                <div class="card border-0 shadow-sm text-center h-100">
                                                    <div class="card-body d-flex flex-column">
                                                        <div class="mb-3">
                                                            <div class="rounded-circle mx-auto d-flex justify-content-center align-items-center {{ $status['full'] ? 'bg-danger' : 'bg-info' }}"
                                                                style="width: 60px; height: 60px;">
                                                                <i class="fas fa-calendar-alt fa-lg text-white"></i>
                                                            </div>
                                                        </div>
                                                        <h6 class="text-muted mb-1">
                                                            {{ $status['name'] ?? 'Event ' . $eventId }}</h6>
                                                        <h5 class="mb-1 text-dark">
                                                            {{ $status['full'] ? 'Full' : $status['remaining'] . ' left' }}
                                                        </h5>
                                                        <span
                                                            class="badge mt-auto {{ $status['full'] ? 'bg-danger' : 'bg-secondary' }}">{{ $status['total'] }}
                                                            total</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- Registered Participants Card -->
                                        <div class="col">
                                            <div class="card border-0 shadow-sm text-center h-100">
                                                <div class="card-body d-flex flex-column">
                                                    <div class="mb-3">
                                                        <div class="rounded-circle mx-auto d-flex justify-content-center align-items-center {{ $registeredParticipants >= 1000 ? 'bg-danger' : 'bg-info' }}"
                                                            style="width: 60px; height: 60px;">
                                                            <i class="fas fa-calendar-alt fa-lg text-white"></i>
                                                        </div>
                                                    </div>
                                                    <h6 class="text-muted mb-1">Registered Participants</h6>
                                                    <h5 class="mb-1 text-dark">{{ 1025 - $registeredParticipants }}
                                                        left</h5>
                                                    <span
                                                        class="badge mt-auto {{ $registeredParticipants >= 1000 ? 'bg-danger' : 'bg-secondary' }}">1025
                                                        total</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-round shadow-lg">
                                <h3 class="p-4 text-center text-white bg-primary rounded-top">Cooperative Attendance
                                    Summary</h3>
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div
                                                    class="card-body d-flex flex-column align-items-center text-center p-3">
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
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div
                                                    class="card-body d-flex flex-column align-items-center text-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-success text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-user-friends fa-lg"></i>
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
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div
                                                    class="card-body d-flex flex-column align-items-center text-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-danger text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-user-times fa-lg"></i>
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
                                        <div class="col-md-3 mb-4">
                                            <div class="card card-stats card-round shadow-sm h-100">
                                                <div
                                                    class="card-body d-flex flex-column align-items-center text-center p-3">
                                                    <div class="col-icon me-3">
                                                        <div
                                                            class="icon-big text-primary text-center rounded-circle bg-light p-3">
                                                            <i class="fas fa-check-circle fa-lg"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="card-category mb-1 text-muted">Total Participants
                                                            Attended</p>
                                                        <h4 class="card-title mb-0 text-dark">
                                                            {{ number_format($totalAttendedParticipants) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-round shadow-lg">
                                <h3 class="p-4 text-center text-white bg-primary rounded-top">Participant Event
                                    Attendance Summary
                                </h3>
                                <div class="card-body p-4">
                                    <div class="row">
                                        @foreach ($events as $event)
                                            <div class="col-md-4 mb-4">
                                                <div class="card card-stats card-round shadow-sm h-100">
                                                    <div
                                                        class="card-body d-flex flex-column align-items-center text-center p-3">
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


                                    </div>
                                </div>
                            </div>

                            <div class="card card-round shadow-lg">
                                <h3 class="p-4 text-center text-white bg-primary rounded-top">Voting Delegates Summary
                                </h3>
                                <div class="card-body p-4">
                                    <div class="row">

                                        <div class="col-md-3 mb-3">
                                            <div class="card card-body border shadow-sm text-center h-100">
                                                <div class="icon-big text-primary text-center p-3 mb-2">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <p class="text-muted mb-1">Voting Delegates</p>
                                                <h4 class="text-dark">{{ $totalVoting }}</h4>
                                            </div>
                                        </div>
                                        {{-- Total Voted Delegates --}}
                                        <div class="col-md-3 mb-3">
                                            <div class="card card-body border shadow-sm text-center h-100">
                                                <div class="icon-big text-primary text-center p-3 mb-2">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <p class="text-muted mb-1">Voted Delegates</p>
                                                <h4 class="text-dark">{{ $votedDelegates }}</h4>
                                            </div>
                                        </div>

                                        {{-- Per Region Counts --}}
                                        @forelse($votingDelegatesPerRegion as $region => $count)
                                            <div class="col-md-3 mb-3">
                                                <div class="card card-body border shadow-sm text-center h-100">
                                                    <div class="icon-big text-primary text-center p-3 mb-2">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                    <p class="text-muted mb-1">{{ $region }}</p>
                                                    <h4 class="text-dark">{{ $count }}</h4>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-muted text-center">No regional data available.</p>
                                            </div>
                                        @endforelse
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
                                    <div class="carousel-inner">
                                        @foreach ($latestEvents as $index => $event)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div style="padding: 0 1px;">
                                                    <div class="card mb-4 rounded-3 event-card-carousel">
                                                        <div
                                                            class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                            <div class="d-flex">
                                                                <div class="text-center bg-light text-primary rounded-3 p-3"
                                                                    style="width: 70px;">
                                                                    <div style="font-size: 0.9rem;">
                                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M') }}
                                                                    </div>
                                                                    <div style="font-size: 1.5rem; font-weight: bold;">
                                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h5 class="mb-0" title="{{ $event->title }}">
                                                                        {{ Str::limit($event->title, 45) }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-sm btn-outline-light rounded-pill"
                                                                    type="button"
                                                                    id="dropdownMenuButton{{ $event->event_id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    More
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="dropdownMenuButton{{ $event->event_id }}">
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('events.index') }}">View
                                                                            Details</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="list-unstyled text-muted">
                                                                <li class="mb-2"><strong>📍 Venue:</strong>
                                                                    {{ $event->location }}</li>
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
                                        <span class="text-start flex-grow-1 ms-3">End of Registration for
                                            Non-Voting</span>
                                    </div>
                                    <div class="event-item">
                                        <span class="badge bg-secondary">May 23</span>
                                        <span class="text-start flex-grow-1 ms-3">Sectoral Congress 55th Co-op
                                            Leaders</span>
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

                            <div class="card mt-4 shadow-lg border-0 rounded-4 card-transition">
                                <div class="card-header header-status bg-primary text-white rounded-top-4">
                                    <h5><i class="fas fa-chart-bar me-2"></i> Voting Statistics</h5>
                                </div>
                                <div class="card-body bg-light rounded-bottom-4">
                                    <canvas id="votingDonutChart" style="max-height: 200px;"></canvas>
                                </div>
                            </div>

                            <div class="card mt-4 shadow-lg border-0 rounded-4 overflow-hidden card-transition">
                                <div
                                    class="card-header header-status bg-purple text-white rounded-top-4 position-relative">
                                    <h5><i class="fas fa-users me-2"></i> Attendance Overview</h5>
                                    <div class="header-overlay"></div>
                                </div>
                                <div class="card-body bg-light rounded-bottom-4">
                                    <canvas id="attendanceDonutChart" style="max-height: 200px;"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const donutCtx = document.getElementById('votingDonutChart').getContext('2d');
        const totalVoting = {{ $totalVoting }};
        const votedDelegates = {{ $votedDelegates }};
        const targetGoal = Math.floor(totalVoting * 0.5) + 1;
        const votingDonutChart = new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Voting Delegates', 'Voted Delegates', 'Target Goal'],
                datasets: [{
                    label: 'Voting Stats',
                    data: [totalVoting, votedDelegates, targetGoal],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.8)',
                        'rgba(0, 200, 255, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 12
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                animation: {
                    animateRotate: true,
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e1e2f',
                        titleColor: '#fff',
                        bodyColor: '#eee',
                        padding: 10,
                        cornerRadius: 8
                    }
                }
            }
        });
    </script>
    <script>
        const donutCtx2 = document.getElementById('attendanceDonutChart').getContext('2d');
        const registeredParticipants = {{ $registeredParticipants }};
        const attendedParticipants = {{ $totalAttendedParticipants }};
        const attendanceTarget = 1000;
        const attendanceDonutChart = new Chart(donutCtx2, {
            type: 'doughnut',
            data: {
                labels: ['Registered', 'Attended', 'Target Goal'],
                datasets: [{
                    label: 'Attendance Stats',
                    data: [registeredParticipants, attendedParticipants, attendanceTarget],
                    backgroundColor: [
                        'rgba(161, 140, 209, 0.85)',
                        'rgba(142, 45, 226, 0.85)',
                        'rgba(255, 99, 132, 0.85)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 14
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                animation: {
                    animateRotate: true,
                    duration: 1500,
                    easing: 'easeOutCirc'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#444',
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2c284e',
                        titleColor: '#fff',
                        bodyColor: '#eee',
                        cornerRadius: 10,
                        padding: 12
                    }
                }
            }
        });
    </script>
    <script>
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
        var exportBaseUrl = "{{ route('reports.export') }}";
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reportFrame = document.getElementById("reportFrame");
            const exportExcel = document.getElementById("exportExcel");
            const exportBaseUrl = "{{ route('reports.export') }}";
            document.querySelectorAll(".list-group-item").forEach(item => {
                item.addEventListener("click", function(event) {
                    event.preventDefault();
                    const reportType = this.getAttribute(
                        "data-report-type");
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
        document.addEventListener("DOMContentLoaded", function() {
            const applyRegionFilter = document.getElementById("applyRegionFilter");
            applyRegionFilter.addEventListener("click", function() {
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
        document.addEventListener("DOMContentLoaded", function() {
            const previewDataBtn = document.getElementById("previewData");
            const applyRegionFilter = document.getElementById("applyRegionFilter");
            const previewTableBody = document.getElementById("previewTableBody");
            previewDataBtn.addEventListener("click", function() {
                let selectedRegion = document.getElementById("regionSelect").value.trim();
                let migsStatus = document.getElementById("migsStatusSelect").value.trim();
                let registrationStatus = document.getElementById("registrationStatusSelect").value.trim();
                let documentStatus = document.getElementById("documentStatusSelect").value
                    .trim();
                fetch("{{ route('reports.preview.filtered_coop_status') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            region: selectedRegion || "All",
                            migs_status: migsStatus || "All",
                            registration_status: registrationStatus || "All",
                            document_status: documentStatus ||
                                "All"
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        previewTableBody.innerHTML = "";
                        if (data.length === 0) {
                            previewTableBody.innerHTML =
                                `<tr><td colspan="13" class="text-center">No data found</td></tr>`;
                            applyRegionFilter.disabled = true;
                            return;
                        }
                        applyRegionFilter.disabled = false;
                        data.forEach(coop => {
                            let registrationStatus = coop.registration_status === "Rejected" ?
                                "Unregistered" : coop.registration_status;
                            let row = `
                    <tr>
                        <td>${coop.name}</td>
                        <td>${coop.coop_identification_no}</td>
                        <td>${coop.region}</td>
                        <td>${coop.participants_count}</td>
                        <td>${registrationStatus}</td>
                        <td>${coop.membership_status}</td>
                        <td>${coop.documents?.['Financial Statement'] ?? 'Not Uploaded'}</td>
                        <td>${coop.documents?.['Resolution for Voting delegates'] ?? 'Not Uploaded'}</td>
                        <td>${coop.documents?.['Deposit Slip for Registration Fee'] ?? 'Not Uploaded'}</td>
                        <td>${coop.documents?.['Deposit Slip for CETF Remittance'] ?? 'Not Uploaded'}</td>
                        <td>${coop.documents?.['CETF Undertaking'] ?? 'Not Uploaded'}</td>
                        <td>${coop.documents?.['Certificate of Candidacy'] ?? 'Not Uploaded'}</td>
                        <td>${coop.documents?.['CETF Utilization invoice'] ?? 'Not Uploaded'}</td>
                    </tr>
                `;
                            previewTableBody.innerHTML += row;
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching preview data:", error);
                        previewTableBody.innerHTML =
                            `<tr><td colspan="13" class="text-center text-danger">Error loading data</td></tr>`;
                    });
            });
            applyRegionFilter.addEventListener("click", function() {
                let selectedRegion = document.getElementById("regionSelect").value.trim();
                let migsStatus = document.getElementById("migsStatusSelect").value.trim();
                let registrationStatus = document.getElementById("registrationStatusSelect").value.trim();
                let documentStatus = document.getElementById("documentStatusSelect").value
                    .trim();
                let exportUrl = "{{ route('reports.export.filtered_coop_status') }}";
                let params = new URLSearchParams({
                    region: selectedRegion || "All",
                    migs_status: migsStatus || "All",
                    registration_status: registrationStatus || "All",
                    document_status: documentStatus || "All"
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedRegion = null;

            // Dropdown item click event
            document.querySelectorAll('.dropdown-item2').forEach(function(item) {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    selectedRegion = item.getAttribute('data-region') === 'all' ? null : item
                        .getAttribute('data-region');

                    // Highlight the selected region (optional)
                    document.querySelectorAll('.dropdown-item2').forEach(function(el) {
                        el.classList.remove('active');
                    });
                    item.classList.add('active'); // Add active class to the clicked item

                    // Update the button text with the selected region
                    const regionText = selectedRegion ? selectedRegion : 'All Region';
                    document.getElementById('selectedRegion').textContent = `(${regionText})`;
                });
            });

            // Preview button click event
            document.getElementById('previewButton').addEventListener('click', function(event) {
                event.preventDefault();

                // Show loading spinner inside the preview content container
                const previewContent = document.getElementById('previewContent');
                previewContent.innerHTML =
                    '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading preview...</div>';
                previewContent.style.display = 'block'; // Show the preview content container

                // Fetch the preview data from the server
                const regionParam = selectedRegion ? `region=${selectedRegion}` : '';
                fetch(`{{ route('admin.reports.participants_list') }}?${regionParam}`)
                    .then(response => response.text())
                    .then(html => {
                        // Only insert the body content from the response (avoid adding any unwanted Bootstrap structure)
                        const previewBody = html.match(/<body.*?>(.*?)<\/body>/s);
                        if (previewBody && previewBody[1]) {
                            previewContent.innerHTML = previewBody[
                                1]; // Insert only the inner body content
                        } else {
                            previewContent.innerHTML = 'Failed to load preview content.';
                        }
                    })
                    .catch(err => {
                        previewContent.innerHTML = 'Failed to load preview.';
                    });
            });

            // Export button click event
            document.getElementById('exportButton').addEventListener('click', function(event) {
                event.preventDefault();
                if (selectedRegion !== null) {
                    window.location.href =
                        `{{ route('admin.reports.export_participants') }}?region=${selectedRegion}`;
                } else {
                    window.location.href = `{{ route('admin.reports.export_participants') }}`;
                }
            });
        });
    </script>

</body>

</html>
