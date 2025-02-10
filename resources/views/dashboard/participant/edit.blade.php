<!DOCTYPE html>
<html lang="en">
 <head>
    @include('layouts.adminheader')
 </head>
  <body>
    <div class="wrapper">
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
              <h3 class="fw-bold mb-3">Participants</h3>
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
                  <a href="#">Participants</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Edit</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Participants</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Modal -->
                    <form id="participantForm" action="{{ route('cooperativeprofile.update', ['participant_id' => $participant->participant_id, 'coop_id' => $participant->coop_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="coop_id" class="form-label">Cooperative</label>
                                        <div class="form-control-plaintext border rounded p-2 bg-light">
                                            {{ $participant->cooperative->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- User Display -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="user_id" class="form-label">User</label>
                                        <div class="form-control-plaintext border rounded p-2 bg-light">
                                            {{ auth()->user()->name }}
                                        </div>
                                    </div>
                                </div>

                                <!-- First Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ $participant->first_name }}">
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" value="{{ $participant->middle_name ?? '' }}">
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ $participant->last_name }}">
                                    </div>
                                </div>

                                <!-- Nickname -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="nickname">Nickname</label>
                                        <input type="text" class="form-control" name="nickname" value="{{ $participant->nickname ?? '' }}">
                                    </div>
                                </div>

                                <!-- Gender (Dropdown) -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="Male" {{ $participant->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $participant->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ $participant->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{ $participant->phone_number }}">
                                    </div>
                                </div>

                                <!-- Designation -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" name="designation" value="{{ $participant->designation ?? '' }}">
                                    </div>
                                </div>

                                <!-- Congress Type (Dropdown) -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="congress_type">Congress Type</label>
                                        <select class="form-control" name="congress_type">
                                            <option value="">Select Congress Type</option>
                                            <option value="Type A" {{ $participant->congress_type == 'Type A' ? 'selected' : '' }}>Type A</option>
                                            <option value="Type B" {{ $participant->congress_type == 'Type B' ? 'selected' : '' }}>Type B</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Religious Affiliation (Dropdown) -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="religious_affiliation">Religious Affiliation</label>
                                        <select class="form-control" name="religious_affiliation">
                                            <option value="">Select Religious Affiliation</option>
                                            <option value="Catholic" {{ $participant->religious_affiliation == 'Catholic' ? 'selected' : '' }}>Catholic</option>
                                            <option value="Christian" {{ $participant->religious_affiliation == 'Christian' ? 'selected' : '' }}>Christian</option>
                                            <option value="Muslim" {{ $participant->religious_affiliation == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                            <option value="Other" {{ $participant->religious_affiliation == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- T-shirt Size (Dropdown) -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="tshirt_size">T-shirt Size</label>
                                        <select class="form-control" name="tshirt_size">
                                            <option value="">Select T-shirt Size</option>
                                            @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $size)
                                                <option value="{{ $size }}" {{ $participant->tshirt_size == $size ? 'selected' : '' }}>{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- MSP Officer (Dropdown) -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="is_msp_officer">Is MSP Officer</label>
                                        <select class="form-control" name="is_msp_officer">
                                            <option value="Yes" {{ $participant->is_msp_officer == 'Yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="No" {{ $participant->is_msp_officer == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- MSP Officer Position -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="msp_officer_position">MSP Officer Position</label>
                                        <input type="text" class="form-control" name="msp_officer_position" value="{{ $participant->msp_officer_position ?? '' }}">
                                    </div>
                                </div>

                                <!-- Delegate Type (Dropdown) -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="delegate_type">Delegate Type</label>
                                        <select class="form-control" name="delegate_type">
                                            <option value="Voting" {{ $participant->delegate_type == 'Voting' ? 'selected' : '' }}>Voting</option>
                                            <option value="Non-Voting" {{ $participant->delegate_type == 'Non-Voting' ? 'selected' : '' }}>Non-Voting</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-info" type="button" onclick="window.history.back()">Back</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>



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
  </body>
</html>
