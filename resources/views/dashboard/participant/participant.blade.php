<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
</head>

<body>

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

        .wrapper {
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
                            <div>
                                <h3 class="fw-bold mb-3 text-nowrap">Cooperative Dashboard</h3>
                            </div>
                            <p
                                class="text-muted text-nowrap d-flex flex-column flex-md-row align-items-center justify-content-center">
                                <span>Logged in as: <strong>{{ Auth::user()->name }}</strong></span>

                                @if ($coop)
                                    <span class="mx-2 d-none d-md-inline">|</span>
                                    <span>Cooperative: <strong>{{ $coop->name }}</strong></span>
                                @else
                                    <span class="mx-2 d-none d-md-inline">|</span>
                                    <span>No Cooperative Assigned</span>
                                @endif
                            </p>

                        </div>

                        <!-- Action Buttons Container -->
                        <div
                            class="d-flex flex-column flex-sm-row gap-3 w-100 justify-content-center justify-content-md-end py-3">

                            <!-- Register Participants -->
                            <a href="{{ route('coopparticipantadd') }}" class="btn btn-primary btn-lg action-btn">
                                <i class="fas fa-user-plus me-2"></i> Register Participants
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

                            <!-- Upload Documents (Triggers Modal) -->
                            <a class="btn btn-info btn-lg action-btn" data-bs-toggle="modal"
                                data-bs-target="#documentsModal">
                                <i class="fas fa-file me-2"></i> Upload Documents
                            </a>

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

                        <!-- Custom Styling -->
                        <style>
                            /* Button Enhancements */
                            .action-btn {
                                padding: 12px 24px;
                                border-radius: 50px;
                                transition: all 0.3s ease-in-out;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                            }

                            .action-btn:hover {
                                transform: scale(1.05);
                                box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
                            }

                            /* Modal Styling */
                            .modal-content {
                                background: rgba(255, 255, 255, 0.95);
                                backdrop-filter: blur(10px);
                            }

                            .modal-header {
                                border-bottom: none;
                            }
                        </style>


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
                                                    class="card-title
                                                    {{ $registrationStatus === 'Fully Registered'
                                                        ? 'text-success'
                                                        : ($registrationStatus === 'Partial Registered'
                                                            ? 'text-warning'
                                                            : 'text-danger') }}">
                                                    {{ $registrationStatus === 'Rejected' ? 'Not Available' : $registrationStatus }}
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
                                                    class="card-title {{ $membershipStatus === 'Migs' ? 'text-success' : 'text-danger' }}">
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

                    <div class="row mt-4">
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
                                <div class="card card-round shadow-lg h-100 border-0 rounded-4">
                                    <!-- Card Header -->
                                    <div class="card-header bg-primary text-white rounded-top-4">
                                        <div class="card-head-row">
                                            <div class="card-title text-white fw-bold">📊 CETF Calculator</div>
                                        </div>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <!-- Caution Message -->
                                        <p class="alert alert-warning text-center rounded-pill py-2">
                                            ⚠️ This calculation is for testing purposes only and is not recorded.
                                        </p>

                                        <!-- Form -->
                                        <form id="cetfForm" class="d-flex flex-column gap-3">
                                            <div class="form-group position-relative">
                                                <label for="totalAsset" class="fw-semibold">Total Asset (Latest
                                                    Audited FS)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                                    <input type="number" class="form-control" id="totalAsset"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label for="totalIncome" class="fw-semibold">Total Income (Latest
                                                    Audited FS)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-chart-line"></i></span>
                                                    <input type="number" class="form-control" id="totalIncome"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label for="cetfRemittance" class="fw-semibold">CETF Remittance to
                                                    MSP</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-hand-holding-usd"></i></span>
                                                    <input type="number" class="form-control" id="cetfRemittance"
                                                        readonly />
                                                </div>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label for="cetfRequired" class="fw-semibold">CETF Required</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-file-invoice-dollar"></i></span>
                                                    <input type="text" class="form-control" id="cetfRequired"
                                                        readonly />
                                                </div>
                                            </div>

                                            <!-- Compute Button -->
                                            <button type="button"
                                                class="btn btn-primary btn-lg btn-round mt-3 shadow-sm"
                                                onclick="calculateCETF()">
                                                <i class="fas fa-calculator me-2"></i> Compute
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <style>
                                    .card-head-row {
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                        gap: 10px;
                                    }

                                    .card-title {
                                        flex-grow: 1;
                                        /* Allows the title to take up available space */
                                        white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        font-weight: bold;
                                    }

                                    .card-tools {
                                        flex-shrink: 0;
                                        /* Prevents the tools section from shrinking */
                                    }
                                </style>

                                @if ($latestEvents->count() > 0)
                                    <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel"
                                        data-bs-interval="2000" data-bs-wrap="true">
                                        <div class="carousel-inner">
                                            @foreach ($latestEvents as $index => $event)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div style="padding: 0 2px;">
                                                        <div class="card card-primary card-round mb-3">
                                                            <div class="card-header">
                                                                <div class="card-head-row">
                                                                    <div class="card-title"
                                                                        title="{{ $event->title }}">
                                                                        {{ $event->title }}</div>
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
                                                                                    href="{{ route('schedule') }}">View
                                                                                    Calendar</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-category">
                                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                                    {{-- -
                                                                    {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }} --}}
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                {{-- <p>{{ $event->description }}</p> --}}
                                                                <ul>
                                                                    <li><strong>📍 Venue:</strong>
                                                                        {{ $event->location }}</li>
                                                                    {{-- <li><strong>🕒 Time:</strong> 9:00 AM - 5:00 PM</li> --}}
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
                                    .floating-notice {
                                        position: fixed;
                                        bottom: 20px;
                                        right: 20px;
                                        background-color: #f8d7da;
                                        color: #721c24;
                                        padding: 15px 25px;
                                        border-radius: 5px;
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                        z-index: 9999;
                                        width: auto;
                                        max-width: 300px;
                                        display: flex;
                                        flex-direction: column;
                                        /* Align content vertically */
                                    }

                                    .notice-content {
                                        font-family: Arial, sans-serif;
                                        font-size: 14px;
                                        max-width: 240px;
                                    }

                                    .floating-notice p {
                                        margin: 0;
                                    }

                                    .floating-notice strong {
                                        font-weight: bold;
                                    }

                                    .close-btn {
                                        background: none;
                                        border: none;
                                        font-size: 20px;
                                        color: #721c24;
                                        cursor: pointer;
                                        position: absolute;
                                        top: 5px;
                                        right: 10px;
                                    }
                                </style>

                                <!-- Floating Notice with Close Button -->
                                <div class="floating-notice">
                                    <button class="close-btn" onclick="closeNotice()">×</button>
                                    <div class="notice-content">
                                        <p><strong>Notice:</strong> To ensure you get your preferred t-shirt size,
                                            please <strong>register early!</strong> Sizes will be available on a
                                            first-come, first-served basis.</p>
                                    </div>
                                </div>

                                <script>
                                    // Function to close the floating notice
                                    function closeNotice() {
                                        document.querySelector('.floating-notice').style.display = 'none';
                                    }
                                </script>




                                <div class="card shadow-lg border-0 rounded-3 overflow-hidden"
                                    style="transition: 0.3s; max-width: 500px; margin: auto;">
                                    <div class="card-header text-white bg-primary rounded-top">
                                        <h5 class="mb-1"><i class="fas fa-calendar-alt"></i> Dates To Remember!</h5>
                                        <small>Join us for the upcoming General Assembly 2025!</small>
                                    </div>
                                    <div class="card-body p-3" style="max-height: 300px; overflow-y: auto;">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-primary">Mar 17</span>
                                                <span class="text-start flex-grow-1 ms-2">Start of Online
                                                    Registration</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-success">Apr 01</span>
                                                <span class="text-start flex-grow-1 ms-2">Start of Filing
                                                    Candidacy</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-danger">May 17</span>
                                                <span class="text-start flex-grow-1 ms-2">End of Filing of
                                                    Candidacy</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-warning text-dark">May 21</span>
                                                <span class="text-start flex-grow-1 ms-2">Ceremonial Opening of
                                                    Election</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-info">May 22</span>
                                                <span class="text-start flex-grow-1 ms-2">End of Reg for
                                                    Non-Voting</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-secondary">May 23</span>
                                                <span class="text-start flex-grow-1 ms-2">SECTORAL CONGRESS 55th CO-OP
                                                    LEADERS</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-primary">May 24</span>
                                                <span class="text-start flex-grow-1 ms-2">55th CO-OP LEADERS</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="badge bg-success">May 25</span>
                                                <span class="text-start flex-grow-1 ms-2">51st General Assembly</span>
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
