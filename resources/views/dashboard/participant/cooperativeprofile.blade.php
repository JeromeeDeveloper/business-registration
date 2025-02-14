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
                      href="{{route('participantDashboard')}}"
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
                        <a href="{{route('speakerlist')}}">
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
                        <a href="{{route('schedule')}}">
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
          @include('layouts.adminnav')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Participant Information</h3>
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
                  <a href="#">Participant</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Information</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header alignment">
                    <div class="card-title">Participant Information</div>
                    <a href="{{ route('cooperativeprofile.edit', ['participant_id' => $participant->participant_id, 'coop_id' => $cooperative->coop_id]) }}" class="btn btn-warning btn-round me-2">
                        Edit Cooperative Profile
                    </a>

                  </div>
                  <form id="participantForm">
                    <div class="card-body">
                        <div class="row">
                            <!-- Coop Selection -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="coop_id">Cooperative</label>
                                    <div>{{ $participant->cooperative->name ?? 'N/A' }}</div> <!-- Display cooperative name -->
                                </div>
                            </div>

                            <!-- User Display -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <div>{{ auth()->user()->name }}</div>
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <div>{{ $participant->first_name }}</div>
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <div>{{ $participant->middle_name ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <div>{{ $participant->last_name }}</div>
                                </div>
                            </div>

                            <!-- Nickname -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="nickname">Nickname</label>
                                    <div>{{ $participant->nickname ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <div>{{ $participant->gender }}</div>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <div>{{ $participant->phone_number }}</div>
                                </div>
                            </div>

                            <!-- Designation -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <div>{{ $participant->designation ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Congress Type -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="congress_type">Congress Type</label>
                                    <div>{{ $participant->congress_type ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Religious Affiliation -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="religious_affiliation">Religious Affiliation</label>
                                    <div>{{ $participant->religious_affiliation ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- T-shirt Size -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="tshirt_size">T-shirt Size</label>
                                    <div>{{ $participant->tshirt_size ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- MSP Officer -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="is_msp_officer">Is MSP Officer</label>
                                    <div>{{ $participant->is_msp_officer === 'Yes' ? 'Yes' : 'No' }}</div>
                                </div>
                            </div>

                            <!-- MSP Officer Position -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="msp_officer_position">MSP Officer Position</label>
                                    <div>{{ $participant->msp_officer_position ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Delegate Type -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="delegate_type">Delegate Type</label>
                                    <div>{{ $participant->delegate_type ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-info" type="button" onclick="window.location.href='{{ route('participantDashboard') }}'">Back</button>
                    </div>
                </form>

            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>

    </div>
  @include('layouts.links')
  </body>
</html>
