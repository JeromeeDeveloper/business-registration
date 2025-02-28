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
                    <div class="collapse show" id="participant">
                      <ul class="nav nav-collapse">
                        <li class="active">
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
                            <a href="{{'events.index'}}">
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
                    <a href="#">Dashboard</a>
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
                    <form id="participantForm" action="{{ route('participants.update', $participant->participant_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- Coop Selection -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="coop_id">Cooperative</label>
                                        <select class="form-control" name="coop_id">
                                            <option value="" disabled>Select Cooperative</option>
                                            @foreach ($cooperatives as $cooperative)
                                                <option value="{{ $cooperative->coop_id }}"
                                                    {{ $participant->coop_id == $cooperative->coop_id ? 'selected' : '' }}>
                                                    {{ $cooperative->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <!-- User Display -->
                                {{-- <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="user_id">User Account</label>
                                        <input type="text" class="form-control" value="{{ $participant->user->name ?? 'N/A' }}" disabled>
                                    </div>
                                </div> --}}

                                <!-- First Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $participant->first_name) }}" required>
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name', $participant->middle_name) }}">
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $participant->last_name) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $participant->email) }}" required>

                                        @error('email')
                                            <div class="alert alert-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="reference_number">Reference Number</label>
                                        <input type="text" class="form-control" name="reference_number" value="{{ old('reference_number', $participant->reference_number) }}" readonly>
                                    </div>
                                </div>

                                <!-- Nickname -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="nickname">Nickname</label>
                                        <input type="text" class="form-control" name="nickname" value="{{ old('nickname', $participant->nickname) }}">
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="Male" {{ old('gender', $participant->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $participant->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender', $participant->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $participant->phone_number) }}">
                                    </div>
                                </div>

                                <!-- Designation -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" name="designation" value="{{ old('designation', $participant->designation) }}">
                                    </div>
                                </div>

                                <!-- Congress Type -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="congress_type">Congress Type</label>
                                        <input type="text" class="form-control" name="congress_type" value="{{ old('congress_type', $participant->congress_type) }}">
                                    </div>
                                </div>

                                <!-- Is MSP Officer -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="is_msp_officer">Is MSP Officer</label>
                                        <select class="form-control" name="is_msp_officer" id="is_msp_officer">
                                            <option value="Yes" {{ old('is_msp_officer', $participant->is_msp_officer) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="No" {{ old('is_msp_officer', $participant->is_msp_officer) == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- MSP Officer Position -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="msp_officer_position">MSP Officer Position</label>
                                        <input type="text" class="form-control" name="msp_officer_position" id="msp_officer_position"
                                               value="{{ old('msp_officer_position', $participant->msp_officer_position) }}"
                                               {{ old('is_msp_officer', $participant->is_msp_officer) == 'Yes' ? '' : 'disabled' }}>
                                    </div>
                                </div>

                                <!-- Religious Affiliation -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="religious_affiliation">Religious Affiliation</label>
                                        <input type="text" class="form-control" name="religious_affiliation" value="{{ old('religious_affiliation', $participant->religious_affiliation) }}">
                                    </div>
                                </div>

                                <!-- T-Shirt Size -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="tshirt_size">T-Shirt Size</label>
                                        <select class="form-control" name="tshirt_size">
                                            <option value="XS" {{ old('tshirt_size', $participant->tshirt_size) == 'XS' ? 'selected' : '' }}>XS</option>
                                            <option value="S" {{ old('tshirt_size', $participant->tshirt_size) == 'S' ? 'selected' : '' }}>S</option>
                                            <option value="M" {{ old('tshirt_size', $participant->tshirt_size) == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ old('tshirt_size', $participant->tshirt_size) == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ old('tshirt_size', $participant->tshirt_size) == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="XXL" {{ old('tshirt_size', $participant->tshirt_size) == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            <option value="XXXL" {{ old('tshirt_size', $participant->tshirt_size) == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Delegate Type -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="delegate_type">Delegate Type</label>
                                        <select class="form-control" name="delegate_type">
                                            <option value="Voting" {{ old('delegate_type', $participant->delegate_type) == 'Voting' ? 'selected' : '' }}>Voting</option>
                                            <option value="Non-Voting" {{ old('delegate_type', $participant->delegate_type) == 'Non-Voting' ? 'selected' : '' }}>Non-Voting</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-label-info btn-round">Update</button>
                            <button type="button" class="btn btn-primary btn-round" onclick="window.location.href='{{ route('participants.index') }}'">Back</button>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let isMspOfficer = document.getElementById("is_msp_officer");
            let mspOfficerPosition = document.getElementById("msp_officer_position");

            function togglePositionField() {
                if (isMspOfficer.value === "Yes") {
                    mspOfficerPosition.removeAttribute("disabled");
                    mspOfficerPosition.setAttribute("required", "required");
                } else {
                    mspOfficerPosition.setAttribute("disabled", "disabled");
                    mspOfficerPosition.removeAttribute("required");
                    mspOfficerPosition.value = ""; // Clear the input if disabled
                }
            }

            // Set initial state based on loaded values
            togglePositionField();

            // Listen for dropdown changes
            isMspOfficer.addEventListener("change", togglePositionField);
        });
        </script>
    @include('layouts.links')
  </body>
</html>
