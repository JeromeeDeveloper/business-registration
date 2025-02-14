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
          <!-- Navbar Header -->
          @include('layouts.adminnav')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Participant Registration</h3>
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
                  <a href="#">Registration</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Participant Registration Form</div>
                  </div>
                  <form id="participantForm" method="POST" action="{{ route('participant.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Coop Selection -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="coop_id">Cooperative</label>
                                    <select class="form-control @error('coop_id') is-invalid @enderror" name="coop_id" id="coop_id">
                                        <option value="">Select Cooperative</option>
                                        @foreach($cooperatives as $coop)
                                            <option value="{{ $coop->coop_id }}" {{ old('coop_id') == $coop->coop_id ? 'selected' : '' }}>
                                                {{ $coop->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('coop_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <!-- User ID (Hidden) -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}" />

                            <!-- User Display -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select class="form-control" name="user_id" id="user_id" disabled>
                                        <!-- Displaying the user's full name in the dropdown -->
                                        <option value="{{ auth()->user()->user_id }}">
                                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" />
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" placeholder="Enter Middle Name" value="{{ old('middle_name') }}" />
                                    @error('middle_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" />
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nickname -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="nickname">Nickname</label>
                                    <input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" id="nickname" placeholder="Enter Nickname" value="{{ old('nickname') }}" />
                                    @error('nickname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number') }}" />
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Designation -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" placeholder="Enter Designation" value="{{ old('designation') }}" />
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Congress Type -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="congress_type">Congress Type</label>
                                    <input type="text" class="form-control @error('congress_type') is-invalid @enderror" name="congress_type" id="congress_type" placeholder="Enter Congress Type" value="{{ old('congress_type') }}" />
                                    @error('congress_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Religious Affiliation -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="religious_affiliation">Religious Affiliation</label>
                                    <input type="text" class="form-control @error('religious_affiliation') is-invalid @enderror" name="religious_affiliation" id="religious_affiliation" placeholder="Enter Religious Affiliation" value="{{ old('religious_affiliation') }}" />
                                    @error('religious_affiliation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- T-shirt Size -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="tshirt_size">T-shirt Size</label>
                                    <select class="form-control @error('tshirt_size') is-invalid @enderror" name="tshirt_size" id="tshirt_size">
                                        <option value="">Select Size</option>
                                        <option value="XS" {{ old('tshirt_size') == 'XS' ? 'selected' : '' }}>XS</option>
                                        <option value="S" {{ old('tshirt_size') == 'S' ? 'selected' : '' }}>S</option>
                                        <option value="M" {{ old('tshirt_size') == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="L" {{ old('tshirt_size') == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="XL" {{ old('tshirt_size') == 'XL' ? 'selected' : '' }}>XL</option>
                                        <option value="XXL" {{ old('tshirt_size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                        <option value="XXXL" {{ old('tshirt_size') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                    </select>
                                    @error('tshirt_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- MSP Officer -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="is_msp_officer">Is MSP Officer</label>
                                    <select class="form-control @error('is_msp_officer') is-invalid @enderror" name="is_msp_officer" id="is_msp_officer">
                                        <option value="Yes" {{ old('is_msp_officer') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ old('is_msp_officer') == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_msp_officer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- MSP Officer Position -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="msp_officer_position">MSP Officer Position</label>
                                    <input type="text" class="form-control @error('msp_officer_position') is-invalid @enderror" name="msp_officer_position" id="msp_officer_position" placeholder="Enter MSP Officer Position" value="{{ old('msp_officer_position') }}" />
                                    @error('msp_officer_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Delegate Type -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="delegate_type">Delegate Type</label>
                                    <select class="form-control @error('delegate_type') is-invalid @enderror" name="delegate_type" id="delegate_type">
                                        <option value="Voting" {{ old('delegate_type') == 'Voting' ? 'selected' : '' }}>Voting</option>
                                        <option value="Non-Voting" {{ old('delegate_type') == 'Non-Voting' ? 'selected' : '' }}>Non-Voting</option>
                                    </select>
                                    @error('delegate_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

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
