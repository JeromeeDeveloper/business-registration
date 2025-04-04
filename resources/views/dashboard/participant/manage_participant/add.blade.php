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
                            <div class="collapse show" id="participant">
                                <ul class="nav nav-collapse">
                                    <li class="active">
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
                <!-- Navbar Header -->
                @include('layouts.adminnav2')
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Participant</h3>
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
                                        <h4 class="card-title">Add</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <form id="participantForm" method="POST"
                                        action="{{ route('coopparticipantadd') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Coop Selection -->
                                                @php
                                                    $user = Auth::user();
                                                    $userCoopId = $user->coop_id ?? null; // Get the logged-in user's cooperative ID
                                                @endphp

                                                @if (!$canAddVoting)
                                                    <div class="alert alert-warning mt-2">
                                                        You have reached the maximum allowed voting participants
                                                        ({{ $votes }}). You cannot add more voting participants.
                                                    </div>
                                                @endif

                                                @if ($youthCongressFull)
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>The Youth Congress is full.</strong> Please select a
                                                        different congress.
                                                    </div>
                                                @else
                                                    <div class="alert alert-info" role="alert">
                                                        <strong>{{ $remainingSlots }} slots remaining</strong> for the
                                                        Youth Congress. Hurry up and secure your spot!
                                                    </div>
                                                @endif

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="coop_id">Cooperative</label>
                                                        <select
                                                            class="form-control @error('coop_id') is-invalid @enderror"
                                                            name="coop_id" id="coop_id"
                                                            {{ $userCoopId ? 'disabled' : '' }}>
                                                            <option value="">Select Cooperative</option>
                                                            @foreach ($cooperatives as $coop)
                                                                <option value="{{ $coop->coop_id }}"
                                                                    {{ old('coop_id', $userCoopId) == $coop->coop_id ? 'selected' : '' }}>
                                                                    {{ $coop->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <!-- Hidden field to submit coop_id when select is disabled -->
                                                        @if ($userCoopId)
                                                            <input type="hidden" name="coop_id"
                                                                value="{{ $userCoopId }}">
                                                        @endif

                                                        @error('coop_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" id="email" placeholder="Enter Email"
                                                            value="{{ old('email') }}" required />
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="phone_number">Phone Number</label>
                                                        <input type="text"
                                                            class="form-control @error('phone_number') is-invalid @enderror"
                                                            name="phone_number" id="phone_number"
                                                            placeholder="Enter Phone Number"
                                                            value="{{ old('phone_number') }}" required />
                                                        @error('phone_number')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- First Name -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text"
                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                            name="first_name" id="first_name"
                                                            placeholder="Enter First Name"
                                                            value="{{ old('first_name') }}" required />
                                                        @error('first_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Middle Name -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="middle_name">Middle Name</label>
                                                        <input type="text"
                                                            class="form-control @error('middle_name') is-invalid @enderror"
                                                            name="middle_name" id="middle_name"
                                                            placeholder="Enter Middle Name"
                                                            value="{{ old('middle_name') }}" required />
                                                        @error('middle_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Last Name -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text"
                                                            class="form-control @error('last_name') is-invalid @enderror"
                                                            name="last_name" id="last_name"
                                                            placeholder="Enter Last Name"
                                                            value="{{ old('last_name') }}" required />
                                                        @error('last_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <!-- Nickname -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="nickname">Nickname</label>
                                                        <input type="text"
                                                            class="form-control @error('nickname') is-invalid @enderror"
                                                            name="nickname" id="nickname"
                                                            placeholder="Enter Nickname"
                                                            value="{{ old('nickname') }}" />
                                                        @error('nickname')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Gender -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="gender">Sex</label>
                                                        <select
                                                            class="form-control @error('gender') is-invalid @enderror"
                                                            name="gender" id="gender" required>
                                                            <option value="" disabled selected>Select Sex
                                                            </option>
                                                            <option value="Male"
                                                                {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="Female"
                                                                {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                                Female</option>
                                                            {{-- <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option> --}}
                                                        </select>
                                                        @error('gender')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <!-- Designation -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="designation">Designation</label>
                                                        <input type="text"
                                                            class="form-control @error('designation') is-invalid @enderror"
                                                            name="designation" id="designation"
                                                            placeholder="Enter Designation"
                                                            value="{{ old('designation') }}" required />
                                                        @error('designation')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="event_ids">Congress</label>




                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-outline-secondary dropdown-toggle w-100 text-start"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Select Congresses
                                                            </button>
                                                            <ul class="dropdown-menu p-3"
                                                                style="width: 100%; max-height: 300px; overflow-y: auto;">
                                                                @foreach ($events as $event)
                                                                    <li>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="event_ids[]"
                                                                                value="{{ $event->event_id }}"
                                                                                id="event_{{ $event->event_id }}">
                                                                            <label class="form-check-label"
                                                                                for="event_{{ $event->event_id }}">
                                                                                {{ $event->title }}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>




                                                <!-- T-shirt Size -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="tshirt_size">T-shirt Size</label>
                                                        <select
                                                            class="form-control @error('tshirt_size') is-invalid @enderror"
                                                            name="tshirt_size" id="tshirt_size" required>
                                                            <option value="" disabled selected>Select T-shirt
                                                                Size</option>
                                                            <option value="XS"
                                                                {{ old('tshirt_size') == 'XS' ? 'selected' : '' }}>XS
                                                            </option>
                                                            <option value="S"
                                                                {{ old('tshirt_size') == 'S' ? 'selected' : '' }}>S
                                                            </option>
                                                            <option value="M"
                                                                {{ old('tshirt_size') == 'M' ? 'selected' : '' }}>M
                                                            </option>
                                                            <option value="L"
                                                                {{ old('tshirt_size') == 'L' ? 'selected' : '' }}>L
                                                            </option>
                                                            <option value="XL"
                                                                {{ old('tshirt_size') == 'XL' ? 'selected' : '' }}>XL
                                                            </option>
                                                            <option value="XXL"
                                                                {{ old('tshirt_size') == 'XXL' ? 'selected' : '' }}>XXL
                                                            </option>
                                                            <option value="XXXL"
                                                                {{ old('tshirt_size') == 'XXXL' ? 'selected' : '' }}>
                                                                XXXL</option>
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
                                                        <select
                                                            class="form-control @error('is_msp_officer') is-invalid @enderror"
                                                            name="is_msp_officer" id="is_msp_officer" required>
                                                            <option value="" disabled selected>Select Status
                                                            </option>
                                                            <option value="No"
                                                                {{ old('is_msp_officer') == 'No' ? 'selected' : '' }}>
                                                                No</option>
                                                            <option value="Yes"
                                                                {{ old('is_msp_officer') == 'Yes' ? 'selected' : '' }}>
                                                                Yes</option>
                                                        </select>
                                                        @error('is_msp_officer')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- MSP Officer Position -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="msp_officer_position">MASS-SPECC Officer
                                                            Position</label>
                                                        <input type="text"
                                                            class="form-control @error('msp_officer_position') is-invalid @enderror"
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
                                                        <select
                                                            class="form-control @error('delegate_type') is-invalid @enderror"
                                                            name="delegate_type" id="delegate_type" required>
                                                            <option value="" disabled selected>Select Delegate
                                                                Type</option>
                                                            <option value="Voting"
                                                                {{ !$canAddVoting ? 'disabled' : '' }}
                                                                {{ old('delegate_type') == 'Voting' ? 'selected' : '' }}>
                                                                Voting</option>
                                                            <option value="Non-Voting"
                                                                {{ old('delegate_type') == 'Non-Voting' ? 'selected' : '' }}>
                                                                Non-Voting</option>
                                                        </select>
                                                        @error('delegate_type')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <!-- Modal for Limit Reached -->
                                                <div class="modal fade" id="limitReachedModal" tabindex="-1"
                                                    aria-labelledby="limitReachedModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="limitReachedModalLabel">
                                                                    Voting Eligibility</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" id="modalMessage">
                                                                <!-- Message updates dynamically -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Understood</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <input type="hidden" id="share_capital"
                                                    value="{{ $shareCapital ?? 0 }}">

                                                <div class="card-action">
                                                    <button type="submit"
                                                        class="btn btn-label-info btn-round">Submit</button>
                                                    <button type="button" class="btn btn-primary btn-round"
                                                        onclick="window.location.href='{{ route('coop.index') }}'">Back</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <link
                                        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
                                        rel="stylesheet" />
                                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                                    {{-- <script>
                        document.getElementById('delegate_type').addEventListener('change', function () {
                            const selectedValue = this.value;
                            const canAddVoting = {{ $canAddVoting ? 'true' : 'false' }};
                            const votes = {{ $votes }};
                            const remainingVotes = Math.max(5 - votes, 0);

                            if (selectedValue === 'Voting' && !canAddVoting) {
                                document.getElementById('modalMessage').innerHTML = `
                                    You have reached the maximum limit of voting participants (<strong>${votes}</strong>).
                                    No additional voting delegates can be added. Please select 'Non-Voting' or contact support if needed.
                                `;
                                const modal = new bootstrap.Modal(document.getElementById('limitReachedModal'));
                                modal.show();
                                this.value = ''; // Reset selection
                            } else if (selectedValue === 'Voting') {
                                const message = votes === 5
                                    ? `You have reached the maximum of <strong>5 voting privileges</strong>. No additional votes can be added.`
                                    : `You currently have <strong>${votes} voting privilege${votes > 1 ? 's' : ''}</strong>.
                                       You can add up to <strong>${remainingVotes} more vote${remainingVotes > 1 ? 's' : ''}</strong> if eligible.`;

                                document.getElementById('modalMessage').innerHTML = message;
                                const modal = new bootstrap.Modal(document.getElementById('limitReachedModal'));
                                modal.show();
                            }
                        });
                        </script> --}}
                                    <script>
                                        $(document).ready(function() {
                                            $('#event_ids').select2({
                                                placeholder: 'Select Congress Types'
                                            });
                                        });
                                    </script>

                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
                                        document.getElementById("participantForm").addEventListener("submit", function(event) {
                                            event.preventDefault(); // Prevent normal form submission

                                            Swal.fire({
                                                title: "Processing...",
                                                text: "Sending email, please wait...",
                                                allowOutsideClick: false,
                                                didOpen: () => {
                                                    Swal.showLoading(); // Show Swal loading indicator
                                                }
                                            });

                                            // Submit the form via AJAX
                                            let formData = new FormData(this);
                                            fetch("{{ route('coopparticipantadd') }}", {
                                                    method: "POST",
                                                    body: formData,
                                                    headers: {
                                                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                                                    }
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        Swal.fire({
                                                            title: "Success!",
                                                            text: "Participant registered and email sent successfully!",
                                                            icon: "success"
                                                        }).then(() => {
                                                            window.location.href = "{{ route('coop.index') }}"; // Redirect if needed
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            title: "Error!",
                                                            text: data.message || "Something went wrong!",
                                                            icon: "error"
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    Swal.fire({
                                                        title: "Error!",
                                                        text: "Failed to send email. Please try again.",
                                                        icon: "error"
                                                    });
                                                });
                                        });
                                    </script>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
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

                                    {{-- <div class="d-flex justify-content-center mt-3">
                        {{ $participants->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                    </div> --}}
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
