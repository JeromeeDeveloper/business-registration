<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
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
                            {{-- <a href="{{ route('admin.reports') }}" class="btn btn-label-info btn-round me-2"
                                target="_blank">Generate Reports</a> --}}
                            <!-- Button to trigger modal -->
                            {{-- <a href="#" id="scan-qr-btn" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                    Scan QR Code
                </a> --}}

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
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Registration Overview</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="registrationChart"></canvas>
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
                                                                        <div class="dropdown-menu"
                                                                            aria-labelledby="dropdownMenuButton{{ $event->event_id }}">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('events.index') }}">View
                                                                                Details</a>
                                                                        </div>
                                                                    </div>
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


                            @if ($latestEvent)
                                <div class="card card-round">
                                    <div class="card-body pb-0">
                                        <h2 class="mb-2">Event Notice</h2>
                                        <p class="text-muted">Join us for the upcoming General Assembly (2025)!</p>
                                        <div class="pull-in sparkline-fix">
                                            <!-- You can insert a related event image or a calendar icon here -->
                                            <div id="eventNoticeChart"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div>
                                            <strong>Notice:</strong> The General Assembly will take place on
                                            {{ \Carbon\Carbon::parse($latestEvent->start_date)->format('F d, Y') }} -
                                            {{ \Carbon\Carbon::parse($latestEvent->end_date)->format('F d, Y') }} Don't
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
            </div>


            @include('layouts.adminfooter')

        </div>


    </div>
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
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let qrScanner;

            document.getElementById("qrScannerModal").addEventListener("shown.bs.modal", async function() {
                if (typeof Html5Qrcode === "undefined") {
                    console.error("Html5Qrcode is NOT loaded!");
                    return;
                }

                qrScanner = new Html5Qrcode("qr-reader");
                try {
                    let devices = await navigator.mediaDevices.enumerateDevices();
                    let cameraId = null;

                    // Look for DroidCam or other cameras
                    devices.forEach(device => {
                        if (device.label.toLowerCase().includes("droidcam")) {
                            cameraId = device.deviceId;
                        }
                    });

                    if (cameraId) {
                        qrScanner.start(
                            cameraId, {
                                fps: 10,
                                qrbox: {
                                    width: 250,
                                    height: 250
                                }
                            },
                            decodedText => handleScannedQR(decodedText, qrScanner),
                            errorMessage => console.warn(errorMessage)
                        ).catch(err => console.error("Error starting QR scanner:", err));
                    }
                } catch (err) {
                    console.error("Error accessing cameras:", err);
                }
            });

            // Stop QR scanner when modal closes
            document.getElementById("qrScannerModal").addEventListener("hidden.bs.modal", function() {
                if (qrScanner) {
                    qrScanner.stop().catch(err => console.warn("Error stopping scanner:", err));
                }
            });
        });

        function handleScannedQR(decodedText, qrScanner) {
            console.log("Scanned QR Code:", decodedText);

            let participantId;

            try {
                // Try to extract ID from a URL
                const url = new URL(decodedText);
                const pathSegments = url.pathname.split("/"); // Split path into segments
                participantId = pathSegments[pathSegments.length - 1]; // Get last segment (ID)
            } catch (e) {
                // If it's not a valid URL, assume it's a direct numeric ID
                participantId = decodedText.trim();
            }

            // Ensure participantId is a valid number
            if (isNaN(participantId) || participantId === "") {
                Swal.fire({
                    icon: "error",
                    title: "Invalid QR Code",
                    text: "No valid participant ID found.",
                });
                return;
            }

            console.log("Extracted Participant ID:", participantId);

            fetch(`/scan-qr?participant_id=${participantId}`, {
                    method: "GET",
                    headers: {
                        "Accept": "application/json"
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        let iconType = data.error.includes("already recorded") ? "warning" : "error";
                        Swal.fire({
                            icon: iconType,
                            title: "Scan Error",
                            text: data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Attendance Recorded!",
                            text: data.success,
                        });
                    }
                    qrScanner.stop();
                })
                .catch(error => {
                    console.error("QR Code Scan Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Scan Failed",
                        text: "Failed to record attendance.",
                    });
                });
        }




        // Function to use DroidCam IP as a video source
        function useDroidCamIP(qrScanner, ip) {
            let videoElement = document.createElement("video");
            videoElement.src = ip;
            videoElement.setAttribute("autoplay", "");
            videoElement.setAttribute("playsinline", "");

            videoElement.addEventListener("loadedmetadata", function() {
                qrScanner.start(
                    videoElement, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    decodedText => handleScannedQR(decodedText, qrScanner),
                    errorMessage => console.warn(errorMessage)
                ).catch(err => console.error("Error starting QR scanner:", err));
            });

            document.getElementById("qr-reader").appendChild(videoElement);
        }
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
