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
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Attendance</a>
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
                                    <form method="GET" class="mb-3">
                                        <div class="row g-3 align-items-end">
                                            <!-- Total Participants -->
                                            <div class="col-md-2">
                                                <label class="form-label fw-bold">Present Participants</label>
                                                <div class="input-group shadow-sm">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <input type="text" class="form-control text-center fw-bold"
                                                        value="{{ $totalParticipantsWithAttendance }}" readonly>
                                                </div>
                                            </div>

                                            <!-- Start Date & Time -->
                                            <div class="col-md-2">
                                                <label class="form-label fw-bold">Start Date & Time</label>
                                                <div class="input-group shadow-sm">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="datetime-local" name="start_datetime"
                                                        class="form-control" value="{{ request('start_datetime') }}">
                                                </div>
                                            </div>

                                            <!-- End Date & Time -->
                                            <div class="col-md-2">
                                                <label class="form-label fw-bold">End Date & Time</label>
                                                <div class="input-group shadow-sm">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="datetime-local" name="end_datetime"
                                                        class="form-control" value="{{ request('end_datetime') }}">
                                                </div>
                                            </div>

                                            <!-- Search Box -->
                                            <div class="col-md-2">
                                                <label class="form-label fw-bold">Enter Participant Info</label>
                                                <div class="input-group shadow-sm">
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Search..." value="{{ request('search') }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- QR Scanner Button -->
                                            <div class="col-md-2">
                                                <label class="form-label fw-bold d-block">QR Scanner</label>
                                                <a href="#" id="scan-qr-btn"
                                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center shadow-sm gap-2"
                                                    data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                                                    <i class="fa fa-qrcode"></i> Scan QR
                                                </a>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-bold d-block">Print Attendance List</label>
                                                <button type="button" onclick="printAttendance()"
                                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center shadow-sm gap-2">
                                                    <i class="fa fa-print"></i> Print Attendance List
                                                </button>
                                            </div>

                                        </div>
                                    </form>


                                    <div class="modal fade" id="qrScannerModal" tabindex="-1"
                                        aria-labelledby="qrScannerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="qrScannerModalLabel"><i
                                                            class="fa fa-qrcode"></i> Scan QR Code</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <div id="qr-reader" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Responsive Modal Styling -->
                                    <style>
                                        @media (max-width: 576px) {
                                            .modal-dialog {
                                                max-width: 90%;
                                                margin: auto;
                                            }
                                        }
                                    </style>
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
                                                <td>{{ optional($participant->cooperative)->name ?? 'N/A' }}</td>
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
                                                        <td class="no-print">
                                                            <div class="form-button-action">
                                                                <a href="{{ route('attendance.show', $participant->participant_id) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Participant Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
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
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert -->
    <script>
        function printAttendance() {
            var tableClone = document.querySelector("table tbody").cloneNode(true);

            // Remove action buttons before printing
            tableClone.querySelectorAll(".no-print").forEach(el => el.remove());

            var printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write(`
        <html>
        <head>
            <title>Attendance List</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f4f4f4; }
                .no-print { display: none; } /* Hide actions column when printing */
            </style>
        </head>
        <body>
            <h2>Attended Participants List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cooperative</th>
                        <th>Attendance Date & Time</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Congress Type</th>
                        <th>QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableClone.innerHTML}
                </tbody>
            </table>
            <script>
                window.onload = function() {
                    window.print();
                    setTimeout(() => window.close(), 1000);
                };
            <\/script>
        </body>
        </html>
    `);
            printWindow.document.close();
        }
    </script>
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

        // dynamic scan url

        // function handleScannedQR(decodedText, qrScanner) {
        //     console.log("Scanned QR Code:", decodedText);

        //     let participantId;

        //     try {
        //         const url = new URL(decodedText);
        //         const pathSegments = url.pathname.split("/");
        //         participantId = pathSegments[pathSegments.length - 1];
        //     } catch (e) {
        //         participantId = decodedText.trim();
        //     }

        //     if (isNaN(participantId) || participantId === "") {
        //         Swal.fire({
        //             icon: "error",
        //             title: "Invalid QR Code",
        //             text: "No valid participant ID found.",
        //         });
        //         return;
        //     }

        //     console.log("Extracted Participant ID:", participantId);

        //     const baseUrl = window.location.origin; // Automatically gets the correct base URL

        //     fetch(`${baseUrl}/scan-qr?participant_id=${participantId}`, {
        //         method: "GET",
        //         headers: { "Accept": "application/json" },
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         if (data.error) {
        //             let iconType = data.error.includes("already recorded") ? "warning" : "error";
        //             Swal.fire({
        //                 icon: iconType,
        //                 title: "Scan Error",
        //                 text: data.error,
        //             });
        //         } else {
        //             Swal.fire({
        //                 icon: "success",
        //                 title: "Attendance Recorded!",
        //                 text: data.success,
        //             });
        //         }
        //         qrScanner.stop();
        //     })
        //     .catch(error => {
        //         console.error("QR Code Scan Error:", error);
        //         Swal.fire({
        //             icon: "error",
        //             title: "Scan Failed",
        //             text: "Failed to record attendance.",
        //         });
        //     });
        // }

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
</body>

</html>
