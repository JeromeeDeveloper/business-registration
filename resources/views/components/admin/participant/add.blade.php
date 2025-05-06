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
                  <a href="#">Add</a>
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
                    <form id="participantForm" method="POST" action="{{ route('participant.add') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="d-flex justify-content-between text-center gap-2">
                                    @foreach ($eventStatus as $status)
                                        <div class="alert {{ $status['full'] ? 'alert-danger' : 'alert-info' }} mb-0" role="alert">
                                            <strong>{{ $status['name'] }}:</strong>
                                            {{ $status['full'] ? "Full ({$status['total']} slots)" : "{$status['remaining']} slots remaining out of {$status['total']}" }}
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Coop Selection -->
                                <div class="col-md-6 col-lg-4">

                                    <div class="form-group">
                                        <label for="coop_id">Cooperative</label>
                                        <select class="form-control @error('coop_id') is-invalid @enderror" name="coop_id" id="coop_id" required>
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

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Participant Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}" required/>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="phone_number">Participant Phone Number</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number') }}" />
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- First Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required/>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" placeholder="Enter Middle Name" value="{{ old('middle_name') }}" required/>
                                        @error('middle_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required/>
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
                                        <label for="gender">Sex</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                                            <option value="" disabled selected>Select Sex</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            {{-- <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option> --}}
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone Number -->


                                <!-- Designation -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" placeholder="Enter Designation" value="{{ old('designation') }}" required/>
                                        @error('designation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="event_ids">Congress</label>

                                        <div class="dropdown">
                                            <!-- Dropdown Button -->
                                            <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false" id="selectedEventsBtn"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Selected Congresses">
                                                Select Congresses
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <ul class="dropdown-menu p-3 shadow w-100" style="max-height: 300px; overflow-y: auto;" onclick="event.stopPropagation();">

                                                <!-- Search Input (optional) -->
                                                <li class="mb-3">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Search..." onkeyup="filterEvents(this)">
                                                </li>

                                                @foreach ($events as $event)
                                                    <li class="mb-2 event-item">
                                                        <label for="event_{{ $event->event_id }}"
                                                               class="d-flex align-items-center gap-2 py-1 px-2 rounded hover-shadow-sm w-100"
                                                               style="cursor: pointer;">
                                                               <input class="form-check-input event-checkbox me-2"
                                                               type="checkbox" name="event_ids[]"
                                                               value="{{ $event->event_id }}"
                                                               id="event_{{ $event->event_id }}"
                                                               data-exclusive="{{ in_array($event->event_id, [13, 14, 15]) ? 'gender-youth' : '' }}">


                                                            <span>
                                                                {{ $event->title }}
                                                            </span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Styling for hover effect -->

                                <!-- Script -->
                                <script>
                                    // Update selected events in the dropdown button
                                    const updateSelectedEvents = () => {
                                        const selectedCheckboxes = document.querySelectorAll('.event-checkbox:checked');
                                        const selected = Array.from(selectedCheckboxes).map(cb => cb.parentElement.textContent.trim());

                                        const button = document.getElementById('selectedEventsBtn');

                                        if (selected.length === 0) {
                                            button.textContent = 'Select Congresses';
                                            button.removeAttribute('title');
                                        } else {
                                            const visible = selected.slice(0, 2);
                                            const extra = selected.length - visible.length;
                                            button.textContent = extra > 0
                                                ? `${visible.join(', ')} +${extra} more`
                                                : visible.join(', ');

                                            button.title = selected.join(', ');
                                        }
                                    };

                                    // Event listener for checkbox changes
                                    document.querySelectorAll('.event-checkbox').forEach(cb => {
                                        cb.addEventListener('change', updateSelectedEvents);
                                    });

                                    // Filter events based on input search
                                    function filterEvents(input) {
                                        const filter = input.value.toLowerCase();
                                        document.querySelectorAll('.event-item').forEach(item => {
                                            const text = item.textContent.toLowerCase();
                                            item.style.display = text.includes(filter) ? '' : 'none';
                                        });
                                    }

                                    // Enable Bootstrap tooltips
                                    document.addEventListener('DOMContentLoaded', () => {
                                        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                        tooltipTriggerList.map(t => new bootstrap.Tooltip(t));
                                        updateSelectedEvents(); // initial load
                                    });
                                </script>


                                <!-- T-shirt Size -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="tshirt_size">T-shirt Size</label>
                                        <select class="form-control @error('tshirt_size') is-invalid @enderror" name="tshirt_size" id="tshirt_size">
                                            <option value="" disabled selected>Select T-shirt Size</option>
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
                                        <label for="is_msp_officer">MASS-SPECC Officer</label>
                                        <select class="form-control @error('is_msp_officer') is-invalid @enderror" name="is_msp_officer" id="is_msp_officer" required>
                                            <option value="" disabled {{ old('is_msp_officer') == '' ? 'selected' : '' }}>Select Status</option>
                                            <option value="No" {{ old('is_msp_officer') == 'No' ? 'selected' : '' }}>No</option>
                                            <option value="Yes" {{ old('is_msp_officer') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        @error('is_msp_officer')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- MSP Officer Position -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="msp_officer_position">MASS-SPECC Officer Position</label>
                                        <input type="text" class="form-control @error('msp_officer_position') is-invalid @enderror"
                                               name="msp_officer_position" id="msp_officer_position"
                                               placeholder="Enter MSP Officer Position"
                                               value="{{ old('msp_officer_position') }}"
                                               {{ old('is_msp_officer') == 'Yes' ? '' : 'disabled' }} />
                                        @error('msp_officer_position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Delegate Type -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="delegate_type">Delegate Type</label>
                                        <select class="form-control @error('delegate_type') is-invalid @enderror" name="delegate_type" id="delegate_type" required>
                                            <option value="" disabled selected>Select Delegate Type</option>
                                            <option value="Voting" {{ old('delegate_type') == 'Voting' ? 'selected' : '' }}>Voting</option>
                                            <option value="Non-Voting" {{ old('delegate_type') == 'Non-Voting' ? 'selected' : '' }}>Non-Voting</option>
                                        </select>
                                        @error('delegate_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-label-info btn-round me-2">Submit</button>
                                    <button type="button" class="btn btn-primary btn-round" onclick="window.location.href='{{ route('participants.index') }}'">Back</button>
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
                    mspOfficerPosition.value = "";
                }
            }

            // Run on page load to set initial state
            togglePositionField();

            // Add event listener to the dropdown
            isMspOfficer.addEventListener("change", togglePositionField);
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("participantForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Processing...',
                text: 'Please wait while we register the participant.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            this.submit(); // Submit the form after showing the loader
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.event-checkbox');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                if (this.dataset.exclusive === 'gender-youth' && this.checked) {
                    checkboxes.forEach(otherCb => {
                        if (otherCb !== this &&
                            otherCb.dataset.exclusive === 'gender-youth') {
                            otherCb.checked = false;
                        }
                    });
                }
            });
        });
    });
</script>



    @include('layouts.links')
  </body>
</html>
