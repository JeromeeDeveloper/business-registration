<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>
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

                        @php
                            // Check if the current date is May 22
                            $isMay22 = now()->format('m-d') === '05-22';

                            // Check if the participant count exceeds 1000
                            $participantCount = \App\Models\Participant::whereNotNull('coop_id')->count();
                            $isMaxedParticipants = $participantCount >= 1000;
                        @endphp

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#participant"
                                class="{{ $isMay22 || $isMaxedParticipants ? 'disabled' : '' }}"
                                aria-disabled="{{ $isMay22 || $isMaxedParticipants ? 'true' : 'false' }}">
                                <i class="fas fa-users"></i>
                                <p>Participant</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="participant">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ $isMay22 || $isMaxedParticipants ? '#' : route('coop.index') }}"
                                            class="{{ $isMay22 || $isMaxedParticipants ? 'disabled' : '' }}">
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
                                    <span class="mb-2 mb-md-0">Logged in as: <strong>{{ Auth::user()->name }}</strong></span>
                                    @if ($coop)
                                        <span class="mx-2 d-none d-md-inline">|</span>
                                        <span>Cooperative: <strong>{{ $coop->name }}</strong></span>
                                    @else
                                        <span class="mx-2 d-none d-md-inline">|</span>
                                        <span>No Cooperative Assigned</span>
                                    @endif
                                </p>
                            </div>
                            <ul class="navbar-nav topbar-nav align-items-center">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-user me-2"></i>
                                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('participant.profile.edit') }}">My Profile</a></li>
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

                    <div class="d-flex flex-column flex-md-row align-items-center text-center text-md-start pt-2 pb-4">
                        <div>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3 class="fw-bold mb-0 text-nowrap me-2">Cooperative Dashboard</h3>

                                <div class="position-relative d-inline-block">
                                    <button class="btn rounded-circle notice-icon attention" type="button"
                                        id="noticeToggle" data-bs-toggle="collapse" data-bs-target="#noticeBox"
                                        aria-expanded="false" aria-controls="noticeBox" title="View Notice">
                                        <i class="fa fa-info-circle text-primary fs-5"></i>
                                    </button>

                                    <!-- Notice Box -->
                                    <div class="collapse position-absolute mt-2 end-0" id="noticeBox"
                                        style="z-index: 999; min-width: 300px;">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-3">
                                                <h6 class="text-danger fw-bold mb-2">
                                                    <i class="fa fa-exclamation-triangle me-1"></i>Important Notice
                                                </h6>
                                                <p class="mb-0 text-dark">
                                                    Participant registration will be <strong>disabled on May 22</strong>, and editing will be <strong>disabled on May 13</strong>. Additionally, registration will be <strong>closed once 1000 participants</strong> have been reached. Current total: <strong>{{ $totalParticipantsforall }}</strong>.
                                                    <span id="cutoff-message" class="mt-2 text-danger fw-bold"></span>
                                                </p>

                                                <script>
                                                    const cutoffDate = '2025-05-10';  // Example cutoff date (YYYY-MM-DD)
                                                    const cutoffMessage = document.getElementById('cutoff-message');
                                                    const today = new Date().toISOString().split('T')[0];

                                                    if (today >= cutoffDate) {
                                                        cutoffMessage.textContent = ` ⚠️ Participant registration and editing are now closed due to the cutoff date of ${cutoffDate}.`;
                                                    } else {
                                                        cutoffMessage.textContent = ` ⚠️ The cutoff date for t-shirt registration is ${cutoffDate}.`;
                                                    }
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Action Buttons Container -->
                        <div
                            class="d-flex flex-column flex-sm-row gap-3 w-100 justify-content-center justify-content-md-end py-3">

                            <!-- Register Participants -->
                            @php
                                $isMay22 = now()->format('m-d') === '05-22';
                            @endphp

                            @php
                                // Check if the current date is May 22
                                $isMay22 = now()->format('m-d') === '05-22';

                                // Check if the participant count exceeds 1000
                                $participantCount = \App\Models\Participant::whereNotNull('coop_id')->count();
                                $isMaxedParticipants = $participantCount >= 1000;
                            @endphp

                            <a href="{{ $isMay22 || $isMaxedParticipants ? '#' : route('coopparticipantadd') }}"
                                class="btn btn-primary btn-lg action-btn {{ $isMay22 || $isMaxedParticipants ? 'disabled' : '' }}"
                                {{ $isMay22 || $isMaxedParticipants ? 'aria-disabled=true' : '' }}
                                onclick="{{ $isMay22 || $isMaxedParticipants ? 'return false;' : '' }}">
                                <i class="fas fa-user-plus me-2"></i> Register Participants
                            </a>

                            {{-- <a class="btn btn-primary btn-lg action-btn" href="{{ route('coopparticipantadd') }}">add</a> --}}

                            <a class="btn btn-info btn-lg action-btn pulse-btn" data-bs-toggle="modal"
                                data-bs-target="#documentsModal">
                                <i class="fas fa-file me-2"></i> Upload Documents
                            </a>

                            <!-- Cooperative Profile (Conditional) -->
                            @if ($coop)
                                <a href="{{ route('cooperativeprofile', ['coop_id' => $coop->coop_id]) }}"
                                    class="btn btn-success btn-lg action-btn">
                                    <i class="fas fa-building me-2"></i> Cooperative Profile
                                </a>
                            @else
                                <a class="btn btn-warning btn-lg action-btn">
                                    <i class="fas fa-exclamation-circle me-2"></i> No Cooperative Associated
                                </a>
                            @endif

                        </div>

                        <!-- Documents Modal -->
                        <div class="modal fade" id="documentsModal" tabindex="-1"
                            aria-labelledby="documentsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow-lg">

                                    <!-- Modal Header -->
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-bold" id="documentsModalLabel">Manage Documents</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body text-center">
                                        @php
                                            $user = Auth::user();
                                            $cooperative = $user->cooperative;
                                            $hasDocuments = $cooperative
                                                ? $cooperative->uploadedDocuments()->exists()
                                                : false;
                                        @endphp

                                        <!-- Status Message -->
                                        <div
                                            class="alert rounded-pill py-2 px-4 d-inline-flex align-items-center mb-4
                    {{ $hasDocuments ? 'alert-success' : 'alert-warning' }}">
                                            <i
                                                class="fas {{ $hasDocuments ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-2"></i>
                                            {{ $hasDocuments ? 'Documents uploaded. You can upload again or view them.' : 'No documents uploaded yet. Please upload now.' }}
                                        </div>

                                        <!-- Upload & View Buttons -->
                                        <div class="d-flex flex-column gap-2">
                                            <a id="uploadBtn" href="#"
                                                class="btn btn-primary btn-lg action-btn">
                                                <i class="fas fa-upload me-2"></i>
                                                {{ $hasDocuments ? 'Upload Again' : 'Upload Now' }}
                                            </a>

                                            @if ($hasDocuments)
                                                <a href="#" id="viewDocumentsBtn"
                                                    class="btn btn-secondary btn-lg action-btn">
                                                    <i class="fas fa-file-alt me-2"></i> View Uploaded Documents
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>



                    <!-- Dashboard Cards -->
                    <div class="row">
                        <!-- Registration Status -->
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Registration Status</p>
                                                <h4
                                                    class="event-title
                                                    {{ $registrationStatus === 'Fully Registered'
                                                        ? 'text-success'
                                                        : ($registrationStatus === 'Partial Registered'
                                                            ? 'text-warning'
                                                            : 'text-danger') }}">
                                                    {{ $registrationStatus === 'Rejected' ? 'Not Registered' : $registrationStatus }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Membership Status -->
                        <div class="col-sm-6 col-md-4">
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
                                                <p class="card-category">Membership Status</p>
                                                <h4
                                                    class="event-title {{ $membershipStatus === 'Migs' ? 'text-success' : 'text-danger' }}">
                                                    {{ strtoupper($membershipStatus === 'Migs' ? 'Migs' : 'Non-migs') }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Participants -->
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total Participants</p>
                                                <h4 class="card-title">
                                                    {{ $totalParticipants }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Registered Voting Delegate -->
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Registered Voting Delegates</p>
                                                <h4 class="card-title">
                                                    {{ $currentVotingCount }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Entitled Voting Delegate -->
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Entitled Voting Delegates</p>
                                                <h4 class="card-title">
                                                    {{ $votes }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Uploaded Documents -->
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-file-upload"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Uploaded Documents</p>
                                                <a href="#" id="viewDocumentsBtn2">
                                                    <h4 class="card-title">
                                                        {{ $totalDocuments }} / 7
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-round shadow-lg border-0 rounded-4">
                                <!-- Card Header -->
                                <div class="card-header bg-primary text-white rounded-top-4">
                                    <div class="card-head-row">
                                        <div class="card-title text-white fw-bold">📊 CETF Calculator</div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!-- Caution Message -->
                                    <p class="alert alert-warning text-center rounded-pill py-2 mt-4">
                                        ⚠️ This calculation is for testing purposes only and is not recorded.
                                    </p>

                                    <!-- Form -->
                                    <form id="cetfForm" class="d-flex flex-column gap-4">
                                        <!-- Formula Display Section -->
                                        <div class="mt-4 p-4 border rounded shadow-sm bg-light">
                                            <p class="fw-semibold fs-5 mb-0">
                                                CETF Required = <span class="fw-bold text-primary">(Total Income *
                                                    0.05) * 0.30 - CETF Remittance to MSP</span>
                                            </p>
                                        </div>

                                        <div class="form-group position-relative">
                                            <label for="totalIncome" class="fw-semibold mb-2">Total Income (Latest
                                                Audited FS)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="fas fa-chart-line"></i></span>
                                                <input type="number" class="form-control form-control-lg" id="totalIncome"
                                                    required />
                                            </div>
                                        </div>

                                        <div class="form-group position-relative">
                                            <label for="cetfRemittance" class="fw-semibold mb-2">CETF Remittance to
                                                MSP</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="fas fa-hand-holding-usd"></i></span>
                                                <input type="number" class="form-control form-control-lg" id="cetfRemittance"
                                                    readonly />
                                            </div>
                                        </div>

                                        <div class="form-group position-relative">
                                            <label for="cetfRequired" class="fw-semibold mb-2">CETF Required</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="fas fa-file-invoice-dollar"></i></span>
                                                <input type="text" class="form-control form-control-lg" id="cetfRequired"
                                                    readonly />
                                            </div>
                                        </div>

                                        <!-- Compute Button -->
                                        <button type="button" class="btn btn-primary btn-lg btn-round mt-4 shadow-sm"
                                            onclick="calculateCETF()">
                                            <i class="fas fa-calculator me-2"></i> Compute
                                        </button>
                                    </form>
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
                                                                    <li><a class="dropdown-item" href="{{ route('schedule') }}">View Details</a></li>
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
                            <!-- Floating Notice with Close Button -->
                            <div class="floating-notice">
                                <button class="close-btn" onclick="closeNotice()">×</button>
                                <div class="notice-content">
                                    <p><strong>Notice:</strong> To ensure you get your preferred t-shirt size,
                                        please <strong>register early!</strong> Sizes will be available on a
                                        first-come, first-served basis.</p>
                                </div>
                            </div>

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


                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.adminfooter')

        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function closeNotice() {
            document.querySelector('.floating-notice').style.display = 'none';
        }
        setTimeout(closeNotice, 15000);
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (!empty($missingDocuments) || !empty($declinedDocuments))
                let issues = [];

                @if (!empty($missingDocuments))
                    issues.push({
                        title: '📌 Reminders',
                        list: [
                            @foreach ($missingDocuments as $doc)
                                "{{ $doc }}",
                            @endforeach
                        ],
                        message: "These are the remaining documents for your submission. Please upload them as soon as possible."
                    });
                @endif

                @if (!empty($declinedDocuments))
                    issues.push({
                        title: '⚠️ Declined Documents',
                        list: [
                            @foreach ($declinedDocuments as $doc)
                                "{{ $doc }}",
                            @endforeach
                        ],
                        message: "These documents were declined and need to be re-uploaded."
                    });
                @endif

                let message = issues.map(issue => `
                <h3 style="margin-bottom: 5px;">${issue.title}</h3>
                <ul style="text-align: left; margin-bottom: 10px;">
                    ${issue.list.map(doc => `<li>📄 ${doc}</li>`).join('')}
                </ul>
                <p>${issue.message}</p>
            `).join('<hr>');

                Swal.fire({
                    icon: 'warning',
                    // title: '🔔 Important Notice!',
                    html: message,
                    timer: 15000, // Auto-closes after 10 seconds
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonText: '📤 Upload Now',
                    showCloseButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                            "{{ route('documents') }}"; // Update with actual upload route
                    }
                });
            @endif
        });
    </script>

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
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('viewDocumentsBtn2')?.addEventListener('click', function() {
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
