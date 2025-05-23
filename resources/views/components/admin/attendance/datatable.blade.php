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

                        <li class="nav-item">
                            <a href="https://mass-specc.coop/2025-coopvention-registration/" class="nav-link" title="Register for Coopvention" target="_blank">
                                <i class="fas fa-building"></i>
                                <p>Hotel Accomodation</p>
                            </a>
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
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted">Present
                                                Participant</label>
                                            <div class="input-group">
                                                <div
                                                    class="d-flex align-items-center justify-content-start gap-3 w-100">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 45px; height: 45px;">
                                                        <i class="fa fa-users fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-0">
                                                            {{ $totalParticipantsWithAttendance }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted">Present
                                                Cooperative</label>
                                            <div class="input-group">
                                                <div
                                                    class="d-flex align-items-center justify-content-start gap-3 w-100">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 45px; height: 45px;">
                                                        <i class="fa fa-users fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-0">
                                                            {{ $totalCoopAttended }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <label>Show
                                                <select id="showEntries" class="form-select form-select-sm"
                                                    style="width: auto; display: inline;">
                                                    <option value="5"
                                                        {{ request('limit') == 5 ? 'selected' : '' }}>5</option>
                                                    <option value="10"
                                                        {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                </select> entries
                                            </label>
                                        </div>

                                    </div>

                                    <div>
                                        <style>
                                            #clear-date-range {
                                                transition: all 0.3s ease;
                                                border-top-left-radius: 0;
                                                border-bottom-left-radius: 0;
                                            }

                                            #clear-date-range:hover {
                                                background-color: #dc3545;
                                                color: #fff;
                                                transform: scale(1.05);
                                            }
                                        </style>

                                    </div>

                                    <form method="GET" class="p-4 bg-white rounded-3 shadow-sm mb-4">
                                        <div class="row g-3 align-items-end">

                                            <!-- Date Range -->
                                            <div class="col-12 col-md-4">
                                                <label class="form-label fw-bold">Date Range</label>
                                                <div class="input-group shadow-sm">
                                                    <input type="text" id="date-range" class="form-control"
                                                        placeholder="Select date & time range">
                                                    <button type="button" id="clear-date-range"
                                                        class="btn btn-danger d-flex align-items-center px-3"
                                                        title="Clear Date Range">
                                                        <i class="fa fa-times fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Hidden fields for start and end datetime -->
                                            <input type="hidden" name="start_datetime" id="start_datetime"
                                                value="{{ request('start_datetime') }}">
                                            <input type="hidden" name="end_datetime" id="end_datetime"
                                                value="{{ request('end_datetime') }}">

                                            <!-- Search -->
                                            <div class="col-12 col-md-4">
                                                <label class="form-label fw-semibold text-muted">Search
                                                    Participant</label>
                                                <div class="input-group shadow-sm">
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Enter name or ID..."
                                                        value="{{ request('search') }}">
                                                    <button type="submit" class="btn btn-primary px-4">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Print Button -->
                                            <div class="col-12 col-md-2 d-grid">
                                                <label class="form-label fw-semibold text-muted">Print List</label>
                                                <button type="button" onclick="printAttendance()"
                                                    class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                                    <i class="fa fa-print"></i> Print
                                                </button>
                                            </div>

                                            <!-- Excel Button -->
                                            <div class="col-12 col-md-2 d-grid">
                                                <label class="form-label fw-semibold text-muted">Generate
                                                    Report</label>
                                                <a class="btn btn-outline-success d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                                    href="{{ route('export-event-participants') }}">
                                                    <i class="fas fa-file-excel" style="color: #2a9d8f;"></i> Excel
                                                </a>
                                            </div>

                                            
                                        </div>
                                    </form>



                                    <div class="p-4 bg-white rounded-3 shadow-sm mb-4">
                                        <div class="row align-items-center g-3">

                                            <!-- Event Selector -->
                                            <div class="col-12 col-md-5">
                                                <label for="eventSelect" class="form-label fw-bold">Select
                                                    Event</label>
                                                <select id="eventSelect" name="event_id"
                                                    class="form-select shadow-sm" required>
                                                    <option value="" disabled selected>Select event</option>
                                                    @foreach ($events as $eventOption)
                                                        <option value="{{ $eventOption->event_id }}"
                                                            {{ old('event_id') == $eventOption->event_id ? 'selected' : '' }}>
                                                            {{ $eventOption->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Event Link Indicator -->
                                            <div
                                                class="col-12 col-md-auto d-flex align-items-center justify-content-center">
                                                <div class="d-flex flex-column align-items-center gap-1 text-muted">
                                                    <i class="fa fa-link fs-4"></i>
                                                    <small class="text-center">Select Event for Scanning</small>
                                                </div>
                                            </div>

                                            <!-- QR Scanner Button -->
                                            <div class="col-12 col-md-5">
                                                <label class="form-label fw-bold invisible">Open QR Scanner</label>
                                                <button id="openQRModal"
                                                    class="btn btn-outline-primary d-flex align-items-center gap-2 shadow-sm w-100"
                                                    disabled data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                                                    <i class="fa fa-qrcode"></i> Open QR Scanner
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                      <div class="modal fade" id="qrScannerModal" tabindex="-1" aria-labelledby="qrScannerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                          <div class="modal-content rounded-4 shadow-lg border-0">
                                            <div class="modal-header bg-dark text-white border-0 rounded-top-4">
                                              <h5 class="modal-title d-flex align-items-center gap-2" id="qrScannerModalLabel">
                                                <i class="fas fa-qrcode"></i> Scan QR Code
                                              </h5>
                                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-light rounded-bottom-4">
                                              <div class="text-center p-3">
                                                <div id="qr-reader"></div>
                                                <p class="mt-3 text-muted small">Place your QR code within the frame</p>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>




                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Event Attended</th>
                                                    <th>Assigned Cooperative</th>
                                                    <th>Attendance Date & Time</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    {{-- <th>Congress Type</th> --}}
                                                    <th>QR Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($participants as $eventParticipant)
                                                    <tr>
                                                        <td>{{ $eventParticipant->event->title ?? 'N/A' }}</td>
                                                        <td>{{ optional($eventParticipant->participant->cooperative)->name ?? 'N/A' }}
                                                        </td>
                                                        <td>
                                                            {{ $eventParticipant->attendance_datetime
                                                                ? \Carbon\Carbon::parse($eventParticipant->attendance_datetime)->format('F j, Y g:i A')
                                                                : 'Not Attended' }}
                                                        </td>
                                                        <td>{{ $eventParticipant->participant->first_name }}</td>
                                                        <td>{{ $eventParticipant->participant->last_name }}</td>
                                                        {{-- <td>{{ $eventParticipant->participant->congress_type ?? 'N/A' }} --}}
                                                        </td>
                                                        <td>
                                                            @if ($eventParticipant->participant && $eventParticipant->participant->participant_id)
                                                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(route('adminDashboard', ['participant_id' => $eventParticipant->participant->participant_id])) }}&size=100x100"
                                                                    alt="QR Code"
                                                                    style="width: 100px; height: 100px;">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td class="no-print">
                                                            <div class="form-button-action d-flex">
                                                                <a href="{{ route('attendance.show', $eventParticipant->participant->participant_id) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Participant Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                <form class="delete-attendance-form" data-id="{{ $eventParticipant->id }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-link btn-danger btn-lg delete-attendance-btn" data-bs-toggle="tooltip" title="Delete Attendance">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>



                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">No participants found
                                                        </td>
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

                                    <!-- Pagination info -->
                                    <div class="text-center mt-2">
                                        <small>
                                            @if ($participants->total() > 0)
                                                Showing {{ $participants->firstItem() }} to
                                                {{ $participants->lastItem() }} of
                                                {{ $participants->total() }} entries
                                            @else
                                                No entries found.
                                            @endif
                                        </small>
                                    </div>

                                    <!-- Mobile-friendly, centered pagination -->
                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="w-100" style="overflow-x: auto;">
                                            <div class="d-flex justify-content-center"
                                                style="min-width: max-content;">
                                                {{ $participants->appends([
                                                        'search' => request('search'),
                                                    ])->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
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
    <script>
        document.getElementById('showEntries').addEventListener('change', function() {
            let url = new URL(window.location.href);
            url.searchParams.set('limit', this.value);
            window.location.href = url.href;
        });
    </script>



    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert -->
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-attendance-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
                    const attendanceId = form.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will permanently delete the attendance record.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.setAttribute('action', `/attendance/${attendanceId}`);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        const dateRangePicker = flatpickr("#date-range", {
            mode: "range",
            enableTime: true,
            dateFormat: "Y-m-d h:i K", // 12-hour format with AM/PM
            time_24hr: false,
            defaultDate: [
                "{{ request('start_datetime') }}",
                "{{ request('end_datetime') }}"
            ],
            onChange: function(selectedDates) {
                if (selectedDates.length === 2) {
                    document.getElementById('start_datetime').value = formatDateTime(selectedDates[0]);
                    document.getElementById('end_datetime').value = formatDateTime(selectedDates[1]);
                }
            }
        });

        document.getElementById('clear-date-range').addEventListener('click', function() {
            dateRangePicker.clear();
            document.getElementById('start_datetime').value = '';
            document.getElementById('end_datetime').value = '';
        });

        function formatDateTime(date) {
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            return new Intl.DateTimeFormat('en-US', options).format(date).replace(',', '');
        }
    </script>


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
                         <th>Event Attended</th>
                        <th>Cooperative</th>
                        <th>Attendance Date & Time</th>
                        <th>First Name</th>
                        <th>Last Name</th>

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
        let qrScanner;

        async function requestCameraPermission() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                stream.getTracks().forEach(track => track.stop()); // Stop the stream after permission is granted
            } catch (err) {
                console.error("Camera permission denied:", err);
            }
        }

        function checkEventSelection() {
            const eventSelect = document.getElementById('eventSelect');
            const openQRModal = document.getElementById('openQRModal');
            openQRModal.disabled = !eventSelect.value;
        }

        async function startQRScanner() {
            const eventSelect = document.getElementById("eventSelect");
            const selectedEvent = eventSelect.value;

            if (!selectedEvent) {
                Swal.fire({
                    icon: "warning",
                    title: "No Event Selected",
                    text: "Please select an event first before scanning.",
                });
                const modal = bootstrap.Modal.getInstance(document.getElementById("qrScannerModal"));
                modal.hide();
                return;
            }

            await requestCameraPermission(); // Ensure camera permission is requested

            qrScanner = new Html5Qrcode("qr-reader");

            try {
                let devices = await navigator.mediaDevices.enumerateDevices();
                let cameraId = devices.find(device => device.kind === "videoinput")?.deviceId;

                if (cameraId) {
                    qrScanner.start(
                        cameraId, {
                            fps: 10,
                            qrbox: {
                                width: 215,
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
        }

        document.addEventListener("DOMContentLoaded", function() {
            const eventSelect = document.getElementById('eventSelect');

            // Initial check on page load
            checkEventSelection();

            // Enable/disable button on event selection change
            eventSelect.addEventListener('change', checkEventSelection);

            document.getElementById("qrScannerModal").addEventListener("shown.bs.modal", async function() {
                if (typeof Html5Qrcode === "undefined") {
                    console.error("Html5Qrcode is NOT loaded!");
                    return;
                }

                await requestCameraPermission();

                const selectedEvent = eventSelect.value;

                if (!selectedEvent) {
                    Swal.fire({
                        icon: "warning",
                        title: "No Event Selected",
                        text: "Please select an event first before scanning.",
                    });
                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                        'qrScannerModal'));
                    modal.hide();
                    return;
                }

                qrScanner = new Html5Qrcode("qr-reader");
                try {
                    let devices = await navigator.mediaDevices.enumerateDevices();
                    let cameraId = null;
                    devices.forEach(device => {
                        if (device.kind === "videoinput") {
                            cameraId = device.deviceId;
                            return; // Select the first video input device found
                        }
                    });


                    if (cameraId) {
                        qrScanner.start(
                            cameraId, {
                                fps: 10,
                                qrbox: {
                                    width: 215,
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

            document.getElementById("qrScannerModal").addEventListener("hidden.bs.modal", function() {
                if (qrScanner) {
                    qrScanner.stop().catch(err => console.warn("Error stopping scanner:", err));
                }
            });
        });

        function handleScannedQR(decodedText, qrScanner) {
            console.log("Scanned QR Code:", decodedText);

            // ✅ Stop the scanner immediately to prevent multiple detections
            if (qrScanner) {
                qrScanner.stop().catch(err => console.warn("Error stopping scanner:", err));
            }

            let participantId = null;
            let coopId = null;

            try {
                const url = new URL(decodedText);
                const pathParts = url.pathname.split('/');

                // ✅ Attempt to extract `participant_id` from the URL path (e.g., `/scan/123`)
                if (!isNaN(pathParts[pathParts.length - 1])) {
                    participantId = pathParts[pathParts.length - 1];
                }

                // ✅ Attempt to extract `participant_id` from query parameters (`?participant_id=123`)
                const params = new URLSearchParams(url.search);
                if (params.get("participant_id")) {
                    participantId = params.get("participant_id");
                }

                // ✅ Extract `coop_id` from query parameters (`?coop_id=456`)
                if (params.get("coop_id")) {
                    coopId = params.get("coop_id");
                }

                console.log("Extracted Participant ID:", participantId, "Coop ID:", coopId);
            } catch (e) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid QR Code",
                    text: "QR code does not contain a valid URL.",
                }).then(() => {
                    closeScannerModal();
                });
                return;
            }

            // ✅ If the scanned QR is for a cooperative (admin dashboard access)
            if (coopId && !isNaN(coopId.trim())) {
                console.log("Redirecting to Admin Dashboard for Coop ID:", coopId);
                Swal.fire({
                    icon: "info",
                    title: "Redirecting...",
                    text: "Opening Admin Dashboard.",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = `/Admin/Dashboard?coop_id=${coopId}`;
                });
                return;
            }

            // ✅ If the scanned QR is for a participant (attendance tracking)
            if (!participantId || isNaN(participantId.trim())) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid QR Code",
                    text: "No valid participant ID found.",
                }).then(() => {
                    closeScannerModal();
                });
                return;
            }

            const eventId = document.getElementById("eventSelect").value;
            if (!eventId) {
                Swal.fire({
                    icon: "warning",
                    title: "No Event Selected",
                    text: "Please select an event before scanning.",
                }).then(() => {
                    closeScannerModal();
                });
                return;
            }

            console.log("Processing Participant ID:", participantId, "for Event ID:", eventId);

            fetch(`/scan-qr?participant_id=${participantId}&event_id=${eventId}`, {
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
                        }).then(() => {
                            closeScannerModal();
                        });
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Attendance Recorded!",
                            text: data.success,
                        }).then(() => {
                            closeScannerModal();
                            location.reload();
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "Scan Failed",
                        text: `Failed to record attendance. Error: ${error.message || 'Unknown error'}`,
                    }).then(() => {
                        closeScannerModal();
                    });
                });
        }

        function closeScannerModal(qrScanner) {
            if (qrScanner) {
                qrScanner.stop().catch(err => console.warn("Error stopping scanner:", err));
            }
            const modal = bootstrap.Modal.getInstance(document.getElementById('qrScannerModal'));
            if (modal) {
                modal.hide();
            }
        }

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
