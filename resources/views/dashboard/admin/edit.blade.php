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
                <div class="collapse show" id="cooperative">
                  <ul class="nav nav-collapse">
                    <li class="active">
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
                <div class="collapse" id="participant">
                  <ul class="nav nav-collapse">
                    <li>
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
                        <a href="{{route('events.index')}}">
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
              <h3 class="fw-bold mb-3">Edit Cooperative</h3>
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
                  <a href="#">Cooperative</a>
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
                    <div class="card-title">Cooperative Edit Form</div>
                  </div>
                  <form action="{{ route('cooperatives.update', $coop->coop_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Coop Name -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="name">Cooperative Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $coop->name }}" placeholder="Enter Cooperative Name" />
                                </div>
                            </div>

                            <!-- Contact Person -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ $coop->contact_person }}" placeholder="Enter Contact Person" />
                                </div>
                            </div>

                            <!-- Cooperative Type -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="type">Cooperative Type</label>
                                    <input type="text" class="form-control" name="type" id="type" value="{{ $coop->type }}" placeholder="Enter Cooperative Type" />
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input class="form-control" id="address" name="address" value="{{ $coop->address }}" placeholder="Enter Address" />
                                </div>
                            </div>

                            <!-- Region -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <select class="form-control" name="region" id="region">
                                        <option disabled>Select Region</option>
                                        @foreach([
                                            'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
                                            'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
                                            'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'
                                        ] as $region)
                                            <option value="{{ $region }}" {{ $coop->region == $region ? 'selected' : '' }}>
                                                {{ $region }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- Phone Number -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{ $coop->phone_number }}" placeholder="Enter Phone Number" />
                                </div>
                            </div>

                          <!-- Email -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $coop->email) }}" placeholder="Enter Email" />

                                        {{-- Show error only if the email is different from the cooperative's current email --}}
                                        @if ($errors->has('email') && old('email') !== $coop->email)
                                            <div class="alert alert-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>



                            <!-- TIN -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="tin">TIN</label>
                                    <input type="text" class="form-control" name="tin" id="tin" value="{{ $coop->tin }}" placeholder="Enter TIN" />
                                </div>
                            </div>

                            <!-- Coop Identification No -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="coop_identification_no">Cooperative ID</label>
                                    <input type="text" class="form-control" name="coop_identification_no" id="coop_identification_no" value="{{ $coop->coop_identification_no }}" placeholder="Enter Coop ID" />
                                </div>
                            </div>

                            <!-- BOD Chairperson -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="bod_chairperson">BOD Chairperson</label>
                                    <input type="text" class="form-control" name="bod_chairperson" id="bod_chairperson" value="{{ $coop->bod_chairperson }}" placeholder="Enter BOD Chairperson" />
                                </div>
                            </div>

                            <!-- General Manager/CEO -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="general_manager_ceo">General Manager/CEO</label>
                                    <input type="text" class="form-control" name="general_manager_ceo" id="general_manager_ceo" value="{{ $coop->general_manager_ceo }}" placeholder="Enter Manager/CEO" />
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="services_availed">Services Availed</label>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" id="servicesDropdown" aria-expanded="false">
                                            Select Services
                                        </button>
                                        <ul class="dropdown-menu w-100 p-2" id="dropdownMenu">
                                            @php
                                                // Decode JSON array properly
                                                $selectedServices = json_decode($coop->services_availed, true) ?? [];
                                            @endphp

                                            @foreach(['CF', 'IT', 'MSU', 'ICS', 'MCU', 'ADMIN', 'GAD', 'YOUTH', 'SCOOPS', 'YAKAP', 'AGRIBEST'] as $service)
                                                <li>
                                                    <label class="dropdown-item">
                                                        <input type="checkbox" class="service-checkbox" name="services_availed[]" value="{{ $service }}"
                                                            {{ in_array($service, $selectedServices) ? 'checked' : '' }}>
                                                        {{ $service }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" name="services_availed_json" id="services_availed_json" value="{{ $coop->services_availed }}">
                                </div>
                            </div>

                            <!-- Total Assets -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="total_asset">Total Assets</label>
                                    <input type="number" class="form-control" name="total_asset" id="total_asset" value="{{ $coop->total_asset }}" placeholder="Enter Total Assets" />
                                </div>
                            </div>

                            <!-- Total Income -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="total_income">Total Income</label>
                                    <input type="number" class="form-control" name="total_income" id="total_income" value="{{ $coop->total_income }}" placeholder="Enter Total Income" />
                                </div>
                            </div>

                            <!-- CETF Remittance -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_remittance">CETF Remittance</label>
                                    <input type="number" class="form-control" name="cetf_remittance" id="cetf_remittance" value="{{ $coop->cetf_remittance }}" placeholder="Enter CETF Remittance" />
                                </div>
                            </div>



                            <!-- CETF Required -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_required">CETF Required</label>
                                    <input type="number" class="form-control" name="cetf_required" id="cetf_required" value="{{ $coop->cetf_required }}" placeholder="Enter CETF Required" />
                                </div>
                            </div>

                            <!-- CETF Balance -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_balance">CETF Balance</label>
                                    <input type="number" class="form-control" name="cetf_balance" id="cetf_balance" value="{{ $coop->cetf_balance }}" placeholder="Enter CETF Balance" />
                                </div>
                            </div>

                            <!-- Share Capital Balance -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="share_capital_balance">Share Capital Balance</label>
                                    <input type="number" class="form-control" name="share_capital_balance" id="share_capital_balance" value="{{ $coop->share_capital_balance }}" placeholder="Enter Share Capital Balance" />
                                </div>
                            </div>

                            <!-- Number of Entitled Votes -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="no_of_entitled_votes">No of Entitled Votes</label>
                                    <input type="number" class="form-control" name="no_of_entitled_votes" id="no_of_entitled_votes" value="{{ $coop->no_of_entitled_votes }}" placeholder="Enter No of Entitled Votes" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-action">
                        <button class="btn btn-label-info btn-round me-2" type="submit">Submit</button>
                        <button type="button" class="btn btn-primary btn-round" onclick="window.location.href='{{ route('adminview') }}'">Back</button>
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
        {{-- @include('layouts.adminfooter') --}}
      </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownButton = document.getElementById("servicesDropdown");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');
            const hiddenInput = document.getElementById("services_availed_json");

            // Prevent dropdown from closing when clicking inside
            dropdownMenu.addEventListener("click", function (event) {
                event.stopPropagation();
            });

            dropdownButton.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle("show");
            });

            document.addEventListener("click", function (event) {
                if (!dropdownMenu.contains(event.target) && event.target !== dropdownButton) {
                    dropdownMenu.classList.remove("show");
                }
            });

            function updateDropdownText() {
                let selected = Array.from(checkboxes)
                    .filter(i => i.checked)
                    .map(i => i.value)
                    .join(", ");

                dropdownButton.innerText = selected ? selected : "Select Services";
                hiddenInput.value = JSON.stringify(selected.split(", ").filter(Boolean)); // Store as JSON
            }

            // Update on checkbox change
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateDropdownText);
            });

            // Load preselected values
            updateDropdownText();
        });
        </script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Handle the form submission using AJAX
        document.getElementById('coopForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = new FormData(this);

            // Send AJAX request to submit the form
            fetch("{{ route('admin.storeCooperative') }}", {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                // Check if the response contains a success message
                if (data.success) {
                    // Display the success message using SweetAlert
                    Swal.fire({
                        title: 'Success!',
                        text: data.success,
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    });

                    // Optionally, you can reset the form here
                    document.getElementById('coopForm').reset();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while submitting the form.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            });
        });
    </script>
  @include('layouts.links')
  </body>
</html>
