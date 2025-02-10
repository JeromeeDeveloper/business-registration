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
            <a href="{{route('participantDashboard')}}" class="logo">
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
                      href=""
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
                        <a href="">
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
                        <a href="">
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
          @include('layouts.adminnav')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                  <h3 class="fw-bold mb-3">Participant Dashboard</h3>
                  <h6 class="op-7 mb-2">MASS-SPECC Assembly Registration Overview</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    @if ($participant && $participant->cooperative)
                    <a href="{{ route('cooperativeprofile', ['participant_id' => $participant->participant_id, 'coop_id' => $participant->cooperative->coop_id]) }}" class="btn btn-label-info btn-round me-2">Cooperative Profile</a>
                @else
                    <span>No Cooperative Associated</span>
                @endif

                  <a href="{{route('documents.view')}}" class="btn btn-primary btn-round">View Uploaded documents</a>
                </div>
              </div>

              <!-- Dashboard Cards -->
              <div class="row">
                <!-- Registration Status -->
                <div class="col-sm-6 col-md-3">
                  <div class="card card-stats card-round">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-icon">
                          <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-user-check"></i>
                          </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                          <div class="numbers">
                            <p class="card-category">Registration Status</p>
                            <h4 class="card-title text-success">Completed</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <!-- Registration Section -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                            <p class="card-category">Registration Open (March 15-17, 2025)</p>
                            {{-- <h4 class="card-title">March 15-17, 2025</h4> --}}
                            @php
                            $user = Auth::user();
                            $hasParticipant = $user->participant()->exists();
                            @endphp

                            @if ($hasParticipant)
                                <p class="text-success mt-2">Already registered.</p>
                            @else
                                <a href="{{ route('participant.register') }}" class="btn btn-sm btn-outline-info mt-2">Register Now</a>
                            @endif

                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                 <!-- Upload Required Documents -->
                 <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-icon">
                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                              <i class="fas fa-file-upload"></i>
                            </div>
                          </div>
                          <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                              <p class="card-category">Required Documents</p>
                              {{-- <h4 class="card-title text-danger">Pending</h4> --}}
                              @php
                              $user = Auth::user();
                              $participant = $user->participant ?? null;
                              $hasDocuments = $participant ? $participant->uploadedDocuments()->exists() : false;
                                @endphp

                                @if ($hasDocuments)
                                    <p class="text-success mt-2">Already uploaded.</p>
                                @else
                                    <a href="{{ route('documents') }}" class="btn btn-sm btn-outline-primary mt-2">Upload Now</a>
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                <!-- Assigned Committees & Voting Status -->
                <div class="col-sm-6 col-md-3">
                  <div class="card card-stats card-round">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-icon">
                          <div class="icon-big text-center icon-secondary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                          </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Committee & Voting</p>
                                <span class="text-success">
                                    {{ $participant->delegate_type ?? 'N/A' }}
                                </span>
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
                          <div class="card-title">CETF Calculator</div>
                          <div class="card-tools">
                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                              <span class="btn-label">
                                <i class="fa fa-pencil"></i>
                              </span>
                              Export
                            </a>
                            <a href="#" class="btn btn-label-info btn-round btn-sm">
                              <span class="btn-label">
                                <i class="fa fa-print"></i>
                              </span>
                              Print
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <form id="cetfForm">
                          <div class="form-group">
                            <label for="totalAsset">Total Asset (Latest Audited FS)</label>
                            <input type="number" class="form-control" id="totalAsset" required />
                          </div>
                          <div class="form-group">
                            <label for="totalIncome">Total Income (Latest Audited FS)</label>
                            <input type="number" class="form-control" id="totalIncome" required />
                          </div>
                          <div class="form-group">
                            <label for="cetfRemittance">CETF Remittance to MSP</label>
                            <input type="number" class="form-control" id="cetfRemittance" required />
                          </div>
                          <div class="form-group">
                            <label for="cetfRequired">CETF Required</label>
                            <input type="text" class="form-control" id="cetfRequired" readonly />
                          </div>
                          <button type="button" class="btn btn-primary mt-3" onclick="calculateCETF()">Compute</button>
                        </form>
                      </div>
                    </div>
                  </div>

              <div class="col-md-4">
                <div class="card card-primary card-round">
                    <div class="card-header">
                      <div class="card-head-row">
                        <div class="card-title">General Assembly</div>
                        <div class="card-tools">
                          <div class="dropdown">
                            <button
                              class="btn btn-sm btn-label-light dropdown-toggle"
                              type="button"
                              id="dropdownMenuButton"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                              More Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">View Details</a>
                              <a class="dropdown-item" href="#">Register</a>
                              <a class="dropdown-item" href="#">Export Schedule</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-category">March 25 - April 02, 2025</div>
                    </div>
                    <div class="card-body">
                      <p>
                        Join us for the **Annual General Assembly**, where we will discuss key updates,
                        organizational progress, and future plans. All members are encouraged to attend.
                      </p>
                      <ul>
                        <li><strong>📍 Venue:</strong> Grand Convention Center</li>
                        <li><strong>🕒 Time:</strong> 9:00 AM - 5:00 PM</li>
                        <li><strong>🎤 Guest Speakers:</strong> Industry Experts & Leadership Panel</li>
                        <li><strong>📌 Activities:</strong> Presentations, Q&A Sessions, Voting</li>
                      </ul>
                      <a href="#" class="btn btn-sm btn-outline-primary mt-2">Register Now</a>
                    </div>
                  </div>

                  <div class="card card-round">
                    <div class="card-body pb-0">
                      <h2 class="mb-2">Event Notice</h2>
                      <p class="text-muted">Join us for the upcoming General Assembly!</p>
                      <div class="pull-in sparkline-fix">
                        <!-- You can insert a related event image or a calendar icon here -->
                        <div id="eventNoticeChart"></div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="alert alert-info">
                        <strong>Notice:</strong> The General Assembly will take place on March 15-17, 2025. Don't miss out on this important event!
                      </div>
                    </div>
                  </div>

              </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="card card-round">
                    <div class="card-body">
                      <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Resource Speakers</div>
                        <div class="card-tools">
                          <div class="dropdown">
                            <button
                              class="btn btn-icon btn-clean me-0"
                              type="button"
                              id="dropdownMenuButton"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                              <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-list py-4">
                        <!-- Resource Speaker 1 -->
                        <div class="item-list">
                          <div class="avatar">
                            <span class="avatar-title rounded-circle border border-white">CF</span>
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Jimmy Denis</div>
                            <div class="status">Keynote Speaker</div>
                          </div>
                          <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button>
                        </div>

                        <!-- Resource Speaker 2 -->
                        <div class="item-list">
                          <div class="avatar">
                            <span class="avatar-title rounded-circle border border-white">CF</span>
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Chandra Felix</div>
                            <div class="status">Guest Speaker</div>
                          </div>
                          <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button>
                        </div>

                        <!-- Resource Speaker 3 -->
                        <div class="item-list">
                          <div class="avatar">
                            <span class="avatar-title rounded-circle border border-white">CF</span>
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Talha</div>
                            <div class="status">Panelist</div>
                          </div>
                          <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button>
                        </div>

                        <!-- Resource Speaker 4 -->
                        <div class="item-list">
                          <div class="avatar">
                            <span class="avatar-title rounded-circle border border-white">CF</span>
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Chad</div>
                            <div class="status">Speaker</div>
                          </div>
                          <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button>
                        </div>

                        <!-- Resource Speaker 5 -->
                        <div class="item-list">
                          <div class="avatar">
                            <span
                              class="avatar-title rounded-circle border border-white bg-primary"
                              >H</span
                            >
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Hizrian</div>
                            <div class="status">Workshop Facilitator</div>
                          </div>
                          <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button>
                        </div>

                        <!-- Resource Speaker 6 -->
                        <div class="item-list">
                          <div class="avatar">
                            <span
                              class="avatar-title rounded-circle border border-white bg-secondary"
                              >F</span
                            >
                          </div>
                          <div class="info-user ms-3">
                            <div class="username">Farrah</div>
                            <div class="status">Moderator</div>
                          </div>
                          <button class="btn btn-icon btn-link op-8 me-1">
                            <i class="far fa-envelope"></i>
                          </button>
                          <button class="btn btn-icon btn-link btn-danger op-8">
                            <i class="fas fa-ban"></i>
                          </button>
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
