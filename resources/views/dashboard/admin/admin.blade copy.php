<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.adminheader')
        <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{route('adminDashboard')}}" class="logo">
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
                      href="{{route('adminDashboard')}}"
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
                        <a href="{{route('adminview')}}">
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
              <a href="{{route('adminDashboard')}}" class="logo">
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
          <nav
          class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
          <div class="container-fluid">
            <nav
              class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
            >

            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-user dropdown hidden-caret">

                <a
                  class="dropdown-toggle profile-pic"
                  data-bs-toggle="dropdown"
                  href="#"
                  aria-expanded="false"
                >
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
                      <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
                      <div class="dropdown-divider"></div>
                      <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                          @csrf
                      </form>
                      <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
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
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Admin Dashboard</h3>
                <h6 class="text-muted">MASS-SPECC Online Registration System</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('admin.reports') }}" class="btn btn-label-info btn-round me-2" target="_blank">Generate Reports</a>
              <!-- Button to trigger modal -->
<a href="#" id="scan-qr-btn" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
    Scan QR Code
</a>

<!-- Bootstrap Modal -->
<div class="modal fade" id="qrScannerModal" tabindex="-1" aria-labelledby="qrScannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrScannerModalLabel">Scan QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qr-reader" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>

                <input type="text" id="qr-input-field" style="position: absolute; opacity: 0; width: 1px; height: 1px;" />
                <div id="qr-display"></div>

              </div>
              <div id="scanner-container" style="display:none;">
                <video id="preview" width="100%" height="auto"></video>
            </div>

            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Cooperatives</p>
                                        <h4 class="card-title">{{ number_format($totalCooperative) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Participants</p>
                                        <h4 class="card-title">{{ number_format($totalParticipants) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-microphone"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Speakers</p>
                                        <h4 class="card-title">{{ number_format($totalSpeakers) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Events</p>
                                        <h4 class="card-title">{{ number_format($totalEvents) }}</h4>
                                    </div>
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
                                <div class="card-title">Registration Overview</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="registrationChart"></canvas>
                        </div>
                    </div>
                </div>

                  <div class="col-md-4">
                    @if($latestEvent)
                    <div class="card card-primary card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ $latestEvent->title }}</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $latestEvent->event_id }}" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            More Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $latestEvent->event_id }}">
                                            <a class="dropdown-item" href="{{route('schedule')}}">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-category">
                                {{ \Carbon\Carbon::parse($latestEvent->start_date)->format('F d, Y') }} -
                                {{ \Carbon\Carbon::parse($latestEvent->end_date)->format('F d, Y') }}
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{ $latestEvent->description }}</p>
                            <ul>
                                <li><strong>📍 Venue:</strong> {{ $latestEvent->location }}</li>
                                <li><strong>🕒 Time:</strong> 9:00 AM - 5:00 PM</li>
                                <li><strong>🎤 Guest Speakers:</strong>
                                    @if($latestEvent->speakers->count() > 0)
                                        {{ $latestEvent->speakers->pluck('name')->implode(', ') }}
                                    @else
                                        No speakers listed
                                    @endif
                                </li>
                                <li><strong>📌 Activities:</strong> Presentations, Q&A Sessions, Voting</li>
                            </ul>
                            <a href="#" class="btn btn-sm btn-outline-primary mt-2">Register Now</a>
                        </div>
                    </div>
                    @else
                    <p>No upcoming events at the moment.</p>
                    @endif

                    @if($latestEvent)
                    <div class="card card-round">
                      <div class="card-body pb-0">
                        <h2 class="mb-2">Event Notice</h2>
                        <p class="text-muted">Join us for the upcoming {{ $latestEvent->title }}!</p>
                        <div class="pull-in sparkline-fix">
                          <!-- You can insert a related event image or a calendar icon here -->
                          <div id="eventNoticeChart"></div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="alert alert-info">
                          <strong>Notice:</strong> The {{ $latestEvent->title }} will take place on   {{ \Carbon\Carbon::parse($latestEvent->start_date)->format('F d, Y') }} -
                          {{ \Carbon\Carbon::parse($latestEvent->end_date)->format('F d, Y') }} Don't miss out on this important event!
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
    document.addEventListener("DOMContentLoaded", function () {
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
                    'rgba(232, 62, 140, 0.6)'  // Pink for Speakers
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
        document.addEventListener("DOMContentLoaded", function () {
    let qrScanner;

    document.getElementById("qrScannerModal").addEventListener("shown.bs.modal", async function () {
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
                    cameraId,
                    { fps: 10, qrbox: { width: 250, height: 250 } },
                    decodedText => handleScannedQR(decodedText, qrScanner),
                    errorMessage => console.warn(errorMessage)
                ).catch(err => console.error("Error starting QR scanner:", err));
            }
        } catch (err) {
            console.error("Error accessing cameras:", err);
        }
    });

    // Stop QR scanner when modal closes
    document.getElementById("qrScannerModal").addEventListener("hidden.bs.modal", function () {
        if (qrScanner) {
            qrScanner.stop().catch(err => console.warn("Error stopping scanner:", err));
        }
    });
});

        // Function to handle QR code scan results
        function handleScannedQR(decodedText, qrScanner) {
            console.log("Scanned QR Code:", decodedText);

            let participantId;
            try {
                const urlParams = new URL(decodedText);
                participantId = urlParams.searchParams.get("participant_id");
            } catch (e) {
                participantId = decodedText; // Assume QR contains ID directly
            }

            if (!participantId) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid QR Code",
                    text: "No participant ID found.",
                });
                return;
            }

            fetch(`/scan-qr?participant_id=${participantId}`, {
                method: "GET",
                headers: { "Accept": "application/json" },
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    if (data.error.includes("already recorded")) {
                        // If attendance is already recorded
                        Swal.fire({
                            icon: "warning",
                            title: "Already Scanned",
                            text: "You have already scanned this QR code!",
                        });
                    } else {
                        // Other errors
                        Swal.fire({
                            icon: "error",
                            title: "Attendance Error",
                            text: data.error,
                        });
                    }
                } else {
                    // Success
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

            videoElement.addEventListener("loadedmetadata", function () {
                qrScanner.start(
                    videoElement,
                    { fps: 10, qrbox: { width: 250, height: 250 } },
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
