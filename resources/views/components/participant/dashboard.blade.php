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
                    <a href="{{ route('participantViewerDashboard') }}" class="logo">
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
                            <a href="{{ route('participantViewerDashboard') }}" class="collapsed">
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
                                <p>Resource Speakers</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="cooperative">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('speakerlistparticipant') }}">
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
                                        <a href="{{ route('events_participant') }}">
                                            <span class="sub-item">List of Events</span>
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
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between w-100">
                            <div class="text-center text-md-start mb-2 mb-md-0">
                                <p class="text-muted mb-0">
                                    <span>Logged in as: <strong>{{ Auth::user()->name }}</strong></span>
                                    @if ($cooperative)
                                        <span class="d-none d-md-inline mx-2">|</span>
                                        <span>Cooperative: <strong>{{ $cooperative->name }}</strong></span>
                                    @else
                                        <span class="d-none d-md-inline mx-2">|</span>
                                        <span>No Cooperative Assigned</span>
                                    @endif
                                </p>
                            </div>

                            <ul class="navbar-nav topbar-nav align-items-center">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-user me-2"></i>
                                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><h6 class="dropdown-header">{{ Auth::user()->email }}</h6></li>
                                        <li><a class="dropdown-item" href="{{ route('participant.profile.user.edit') }}">My Profile</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">
                                Participant Dashboard
                            </h3>

                        </div>
                        <div class="ms-md-auto py-2 py-md-0 p-6">

                            <a href="#qr_here" class="augment-scroll-btn" aria-label="Scroll to QR Code">
                                <div class="augment-scroll-arrow"></div>
                            </a>

                        </div>
                    </div>
                    <!-- Dashboard Cards -->
                    <div class="row">
                        @if ($gaRegistrations->isNotEmpty())
                            @php $latestRegistration = $gaRegistrations->first(); @endphp
                            <!-- Registration Status -->
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <!-- Icon -->
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>

                                            <!-- Stats -->
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category mb-1">Congresses to be Attended</p>

                                                    @if (!empty($participant) && $participant->events && $participant->events->isNotEmpty())
                                                    @foreach ($participant->events as $event)
                                                        <span class="badge bg-primary me-1">{{ $event->title }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">No congress types to attend.</span>
                                                @endif


                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Approved Registrations -->
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Delegate Type</p>
                                                    <h4 class="card-title">{{ $latestRegistration->delegate_type }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Registrations -->
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center
                                            {{ $latestRegistration->registration_status === 'Approved' ? 'icon-success' : ($latestRegistration->registration_status === 'Pending' ? 'icon-warning' : 'icon-danger') }}
                                            bubble-shadow-small">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Registration Status</p>
                                                    <h4>
                                                        {{ $latestRegistration->registration_status === 'Rejected' ? 'Not Available' : $latestRegistration->registration_status }}
                                                    </h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rejected Registrations -->
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center
                                            {{ $latestRegistration->membership_status === 'Active' ? 'icon-info' : 'icon-secondary' }}
                                            bubble-shadow-small">
                                                    <i class="fas fa-file-upload"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Membership Status</p>
                                                    <h4 class="card-title">
                                                        {{ strtoupper($latestRegistration->membership_status) }}
                                                    </h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No GA registration records found.</p>
                        @endif

                        @if ($participant)
                            <div class="col-md-8 mx-auto">
                                <div class="card shadow-lg rounded-lg border-0">
                                    <div class="card-header bg-primary text-white rounded-top">
                                        <h5 class="mb-0">Participant Details</h5>
                                    </div>
                                    <div id="qr_here" class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Name: </strong>&nbsp;
                                                {{ $participant->first_name }} {{ $participant->middle_name ?? '' }}
                                                {{ $participant->last_name }}</li>
                                            <li class="list-group-item"><strong>Nickname: </strong>&nbsp;
                                                {{ $participant->nickname ?? 'N/A' }}</li>
                                            <li class="list-group-item"><strong>Access Key: </strong>&nbsp;
                                                {{ $participant->reference_number }}</li>
                                            <li class="list-group-item"><strong>Email: </strong>&nbsp;
                                                {{ $participant->email }}</li>
                                            <li class="list-group-item"><strong>Gender: </strong>&nbsp;
                                                {{ $participant->gender }}</li>
                                            <li class="list-group-item"><strong>T-shirt Size: </strong>&nbsp;
                                                {{ $participant->tshirt_size }}</li>
                                            <li class="list-group-item"><strong>Phone Number: </strong>&nbsp;
                                                {{ $participant->phone_number ?? 'N/A' }}</li>
                                            <li class="list-group-item"><strong>Designation: </strong>&nbsp;
                                                {{ $participant->designation ?? 'N/A' }}</li>
                                            <li class="list-group-item"><strong>Delegate Type: </strong>&nbsp;
                                                {{ $participant->delegate_type }}</li>
                                        </ul>
                                        <!-- QR Code Section -->
                                        <div class="text-center mt-4">
                                            <h6 class="text-muted">QR Code</h6>
                                            <div class="p-3 border rounded bg-light d-inline-block">
                                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(route('participantViewerDashboard', ['participant_id' => $participant->participant_id])) }}&size=200x200"
                                                    alt="QR Code" class="img-fluid" id="qrCodeImage" />
                                            </div>

                                            <!-- Download Button -->
                                            <div class="mt-3">
                                                <a href="{{ route('download.qr2', ['participant_id' => $participant->participant_id]) }}"
                                                    class="btn btn-label-info btn-round">
                                                    <i class="fas fa-download"></i> Download QR Code
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center mt-4">
                                <p class="text-danger font-weight-bold">You are not associated with any participant
                                    record.</p>
                            </div>
                        @endif



                        <div class="col-md-4">
                            @if ($latestEvents->count() > 0)
                                <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="7000" data-bs-wrap="true">

                                    <div class="carousel-inner">
                                        @foreach ($latestEvents as $index => $event)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <div style="padding: 0 1px;">
                                                    <div class="card mb-4 rounded-3 event-card-carousel">
                                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                            <div class="d-flex">
                                                                <!-- 📅 Mini Calendar Box -->
                                                                <div class="text-center bg-light text-primary rounded-3 p-3" style="width: 70px;">
                                                                    <div style="font-size: 0.9rem;">
                                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M') }}
                                                                    </div>
                                                                    <div style="font-size: 1.5rem; font-weight: bold;">
                                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}
                                                                    </div>
                                                                </div>

                                                                <!-- 📋 Event Title -->
                                                                <div class="ms-3">
                                                                    <h5 class="mb-0" title="{{ $event->title }}">{{ Str::limit($event->title, 45) }}</h5>
                                                                </div>
                                                            </div>

                                                            <!-- ⚙️ More Options Dropdown -->
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-light rounded-pill" type="button" id="dropdownMenuButton{{ $event->event_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    More
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $event->event_id }}">
                                                                    <li><a class="dropdown-item" href="{{ route('events_participant') }}">View Details</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="card-body">
                                                            <ul class="list-unstyled text-muted">
                                                                <li class="mb-2"><strong>📍 Venue:</strong> {{ $event->location }}</li>
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
                                    max-height: 400px;
                                    overflow-y: auto;
                                    padding: 15px;
                                }

                                .event-item {
                                    display: flex;
                                    align-items: center;
                                    padding: 10px 15px;
                                    transition: 0.3s;
                                    border-bottom: 1px solid #ddd;
                                }

                                .event-item:hover {
                                    background: #f8f9fa;
                                    transform: scale(1.01);
                                }

                                .event-item .badge {
                                    font-size: 14px;
                                    padding: 8px 12px;

                                    text-align: center;
                                    font-weight: bold;
                                    border-radius: 10px;
                                }

                                .event-footer {
                                    background: linear-gradient(45deg, #ff6f61, #ff9068);
                                    color: white;
                                    padding: 12px;
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


                @include('layouts.adminfooter')

            </div>


        </div>

        @include('layouts.links')
</body>

</html>

<script>
document.querySelector('.augment-scroll-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));

    target.scrollIntoView({
        behavior: 'smooth'
    });

    // Add animation class to target
    target.classList.add('augment-scroll-reveal');

    // Remove animation class after it completes
    setTimeout(() => {
        target.classList.remove('augment-scroll-reveal');
    }, 800);
});
</script>




