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
            <a href="{{route('participantViewerDashboard')}}" class="logo">
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
                      href="{{route('participantViewerDashboard')}}"
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
                  <p>Resource Speakers</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="cooperative">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{route('speakerlistparticipant')}}">
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
                        <a href="{{route('events_participant')}}">
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
                      <a class="dropdown-item" href="{{ route('participant.profile.user.edit') }}">My Profile</a>
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
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">
                       Participant Dashboard
                    </h3>
                    <p class="text-muted text-nowrap">
                        Logged in as: <strong>{{ Auth::user()->name }}</strong>
                        @if($cooperative)
                            <br> Cooperative: <strong>{{ $cooperative->name }}</strong>
                        @else
                            | No Cooperative Assigned
                        @endif
                    </p>
                </div>
                <div class="ms-md-auto py-2 py-md-0 p-6">
                {{-- <a href="#" id="viewDocumentsBtn" class="btn btn-primary btn-round">View Uploaded Documents</a> --}}
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
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Registration Status Updated</p>
                                            <h4 class="card-title">{{ \Carbon\Carbon::parse($latestRegistration->date_submitted)->format('M d, Y') }}</h4>
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
                                            <h4 class="card-title">{{ $latestRegistration->delegate_type }}</h4>
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
                                        <div class="icon-big text-center
                                            {{ $latestRegistration->registration_status === 'Approved' ? 'icon-success' : ($latestRegistration->registration_status === 'Pending' ? 'icon-warning' : 'icon-danger') }}
                                            bubble-shadow-small">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Registration Status</p>
                                            <h4 class="card-title">{{ $latestRegistration->registration_status }}</h4>
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
                                        <div class="icon-big text-center
                                            {{ $latestRegistration->membership_status === 'Active' ? 'icon-info' : 'icon-secondary' }}
                                            bubble-shadow-small">
                                            <i class="fas fa-file-upload"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Membership Status</p>
                                            <h4 class="card-title">{{ $latestRegistration->membership_status }}</h4>
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
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Participant Details</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Participant ID:</strong> {{ $participant->participant_id }}</li>
                                <li class="list-group-item"><strong>Name:</strong> {{ $participant->first_name }} {{ $participant->middle_name ?? '' }} {{ $participant->last_name }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $participant->email }}</li>
                                <li class="list-group-item"><strong>Gender:</strong> {{ $participant->gender }}</li>
                                <li class="list-group-item"><strong>Phone Number:</strong> {{ $participant->phone_number ?? 'N/A' }}</li>
                                <li class="list-group-item"><strong>Designation:</strong> {{ $participant->designation ?? 'N/A' }}</li>
                                <li class="list-group-item"><strong>Delegate Type:</strong> {{ $participant->delegate_type }}</li>
                            </ul>



                            <!-- QR Code Section -->
                            <div class="text-center mt-4">
                                <h6 class="text-muted">QR Code</h6>
                                <div class="p-3 border rounded bg-light d-inline-block">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(route('participantViewerDashboard', ['participant_id' => $participant->participant_id])) }}&size=200x200"
                                         alt="QR Code" class="img-fluid" id="qrCodeImage"/>
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
                    <p class="text-danger font-weight-bold">You are not associated with any participant record.</p>
                </div>
            @endif


              <div class="col-md-4">
                @if($event)
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">{{ $event->title }}</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                        id="dropdownMenuButton{{ $event->event_id }}" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        More Options
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $event->event_id }}">
                                        <a class="dropdown-item" href="{{route('events_participant')}}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-category">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} -
                            {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $event->description }}</p>
                        <ul>
                            <li><strong>📍 Venue:</strong> {{ $event->location }}</li>
                            <li><strong>🕒 Time:</strong> 9:00 AM - 5:00 PM</li>
                            <li><strong>🎤 Guest Speakers:</strong>
                                @if($event->speakers->count() > 0)
                                    {{ $event->speakers->pluck('name')->implode(', ') }}
                                @else
                                    No speakers listed
                                @endif
                            </li>
                            <li><strong>📌 Activities:</strong> Presentations, Q&A Sessions, Voting</li>
                        </ul>

                    </div>
                </div>
                @else
                <p>No upcoming events at the moment.</p>
                @endif



                @if($event)
                <div class="card card-round">
                  <div class="card-body pb-0">
                    <h2 class="mb-2">Event Notice</h2>
                    <p class="text-muted">Join us for the upcoming {{ $event->title }}!</p>
                    <div class="pull-in sparkline-fix">
                      <!-- You can insert a related event image or a calendar icon here -->
                      <div id="eventNoticeChart"></div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div>
                      <strong>Notice:</strong> The {{ $event->title }} will take place on   {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} -
                      {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }} Don't miss out on this important event!
                      </div>
                    </div>
                  </div>
                    @else
                  <p>No upcoming events at the moment.</p>
                  @endif
              </div>
            </div>


        </div>


         @include('layouts.adminfooter')

      </div>


    </div>

   @include('layouts.links')
  </body>
</html>
