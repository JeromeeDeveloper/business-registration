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

                        @php
                            // Check if the current date is May 22
                            $isMay22 = now()->format('m-d') === '05-22';

                            // Check if the participant count exceeds 1000
                            $participantCount = \App\Models\Participant::whereNotNull('coop_id')->count();
                            $isMaxedParticipants = $participantCount >= 1000;
                        @endphp

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#participant"
                                class="{{ $isMay22 || $isMaxedParticipants ? 'disabled' : '' }}"
                                aria-disabled="{{ $isMay22 || $isMaxedParticipants ? 'true' : 'false' }}">
                                <i class="fas fa-users"></i>
                                <p>Participant</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse show" id="participant">
                                <ul class="nav nav-collapse">
                                    <li class="active">
                                        <a href="{{ $isMay22 || $isMaxedParticipants ? '#' : route('coop.index') }}"
                                            class="{{ $isMay22 || $isMaxedParticipants ? 'disabled' : '' }}">
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

                        <li class="nav-item">
                            <a href="https://mass-specc.coop/2025-coopvention-registration/" class="nav-link"
                                title="Register for Coopvention" target="_blank">
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

                                                @php
                                                    $eventNames = [
                                                        14 => 'Gender Congress',
                                                        15 => 'Youth Congress',
                                                        18 => 'Education Committee Forum',
                                                        13 => 'Managers Congress',
                                                    ];
                                                @endphp

                                                <div class="d-flex flex-wrap gap-3 mb-3">
                                                    @foreach ([14, 15, 18, 13] as $eventId)
                                                        @if (isset($eventStatus[$eventId]))
                                                            @php
                                                                $status = $eventStatus[$eventId];
                                                                $name = $eventNames[$eventId] ?? 'Unknown Event';
                                                                $alertClass = $status['full']
                                                                    ? 'alert-danger'
                                                                    : 'alert-info';
                                                                $message = $status['full']
                                                                    ? "<strong>{$name} is full.</strong> All {$status['total']} slots have been taken."
                                                                    : "<strong>{$status['remaining']} out of {$status['total']} slots remaining</strong> for the {$name}.";
                                                            @endphp

                                                            <div class="alert {{ $alertClass }} mb-0"
                                                                role="alert" style="min-width: 280px; flex: 1;">
                                                                {!! $message !!}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>




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
                                                        <label for="email">Participant Email</label>
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
                                                        <label for="phone_number">Participant Phone Number</label>
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
                                                            <!-- Dropdown Toggle Button -->
                                                            <button
                                                                class="btn btn-outline-secondary dropdown-toggle w-100 text-start"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false" id="selectedEventsBtn"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Selected Congresses">
                                                                Select Congresses
                                                            </button>

                                                            <!-- Dropdown Menu -->
                                                            <ul class="dropdown-menu p-3 shadow w-100"
                                                                style="max-height: 300px; overflow-y: auto;"
                                                                onclick="event.stopPropagation();">

                                                                <!-- Search Input -->
                                                                <li class="mb-3">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Search..."
                                                                        onkeyup="filterEvents(this)">
                                                                </li>

                                                                @foreach ($events as $event)
                                                                    @php
                                                                        $status =
                                                                            $eventStatus[$event->event_id] ?? null;
                                                                        $isFull = $status['full'] ?? false;
                                                                        $remaining = $status['remaining'] ?? null;
                                                                        $total = $status['total'] ?? null;
                                                                    @endphp

                                                                    <li class="mb-2 event-item">
                                                                        <label for="event_{{ $event->event_id }}"
                                                                            class="d-flex align-items-center gap-2 py-1 px-2 rounded hover-shadow-sm w-100 {{ $isFull ? 'bg-light text-muted' : '' }}"
                                                                            style="cursor: pointer;">
                                                                            <input
                                                                                class="form-check-input event-checkbox me-2"
                                                                                type="checkbox" name="event_ids[]"
                                                                                value="{{ $event->event_id }}"
                                                                                id="event_{{ $event->event_id }}"
                                                                                data-exclusive="{{ in_array($event->event_id, [14, 15]) ? 'gender-youth' : '' }}"
                                                                                @disabled($isFull)>

                                                                            <span>
                                                                                {{ $event->title }}
                                                                                @if ($status)
                                                                                    ({{ $remaining }} /
                                                                                    {{ $total }}
                                                                                    slots{{ $isFull ? ' - Full' : '' }})
                                                                                @endif
                                                                            </span>
                                                                        </label>
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
                                                    <button type="button" class="btn btn-label-info btn-round"
                                                        onclick="window.location.href='{{ url()->previous() }}'">Back</button>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-round">Submit</button>

                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const checkboxes = document.querySelectorAll('.event-checkbox');

                                            checkboxes.forEach(cb => {
                                                cb.addEventListener('change', function () {
                                                    // If current checkbox is marked as "gender-youth" and checked
                                                    if (this.dataset.exclusive === 'gender-youth' && this.checked) {
                                                        checkboxes.forEach(otherCb => {
                                                            // Uncheck other checkboxes with the same exclusive group
                                                            if (otherCb !== this && otherCb.dataset.exclusive === 'gender-youth') {
                                                                otherCb.checked = false;
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>

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
                                            event.preventDefault();

                                            // Clear old validation messages
                                            document.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
                                            document.querySelectorAll(".invalid-feedback").forEach(el => el.remove());

                                            Swal.fire({
                                                title: "Processing...",
                                                text: "Sending email, please wait...",
                                                allowOutsideClick: false,
                                                didOpen: () => {
                                                    Swal.showLoading();
                                                }
                                            });

                                            let formData = new FormData(this);

                                            fetch("{{ route('coopparticipantadd') }}", {
                                                    method: "POST",
                                                    body: formData,
                                                    headers: {
                                                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                                                    }
                                                })
                                                .then(async response => {
                                                    const contentType = response.headers.get("content-type");
                                                    const isJson = contentType && contentType.includes("application/json");
                                                    const data = isJson ? await response.json() : {};

                                                    if (!response.ok) {
                                                        // Laravel validation error (422)
                                                        if (response.status === 422 && data.errors) {
                                                            for (const field in data.errors) {
                                                                const input = document.querySelector(`[name="${field}"]`);
                                                                if (input) {
                                                                    input.classList.add("is-invalid");

                                                                    const errorDiv = document.createElement("div");
                                                                    errorDiv.classList.add("invalid-feedback");
                                                                    errorDiv.innerText = data.errors[field][0];

                                                                    input.parentNode.appendChild(errorDiv);
                                                                }
                                                            }

                                                            Swal.close(); // Close loading popup
                                                            return; // Skip the catch
                                                        }

                                                        // For non-validation errors, show general message
                                                        throw new Error(data.message || "An error occurred while submitting the form.");
                                                    }

                                                    return data;
                                                })
                                                .then(data => {
                                                    if (data?.success) {
                                                        Swal.fire({
                                                            title: "Success!",
                                                            text: "Participant registered and email sent successfully!",
                                                            icon: "success"
                                                        }).then(() => {
                                                            window.location.href = "{{ route('coop.index') }}";
                                                        });
                                                    } else if (data) {
                                                        Swal.fire({
                                                            title: "Error!",
                                                            text: "The email address is already in use. Please provide a different one.",
                                                            icon: "error"
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error("Error:", error);
                                                    Swal.fire({
                                                        title: "Error!",
                                                        text: error.message ||
                                                            "Failed to send email. Please check your internet connection and try again.",
                                                        icon: "error",
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Retry',
                                                        cancelButtonText: 'Cancel',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            window.location.reload();
                                                        }
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

                                    <!-- Scripts -->
                                    <script>
                                        const updateSelectedEvents = () => {
                                            const selectedCheckboxes = document.querySelectorAll('.event-checkbox:checked');
                                            const selected = Array.from(selectedCheckboxes).map(cb => cb.parentElement.textContent.trim());

                                            const button = document.getElementById('selectedEventsBtn');

                                            if (selected.length === 0) {
                                                button.textContent = 'Select Congresses';
                                                button.removeAttribute('title');
                                            } else {
                                                // Show first 2 selected, then "+X more"
                                                const visible = selected.slice(0, 2);
                                                const extra = selected.length - visible.length;
                                                button.textContent = extra > 0 ?
                                                    `${visible.join(', ')} +${extra} more` :
                                                    visible.join(', ');

                                                // Tooltip for full list (optional)
                                                button.title = selected.join(', ');
                                            }
                                        };

                                        document.querySelectorAll('.event-checkbox').forEach(cb => {
                                            cb.addEventListener('change', updateSelectedEvents);
                                        });

                                        function filterEvents(input) {
                                            const filter = input.value.toLowerCase();
                                            document.querySelectorAll('.event-item').forEach(item => {
                                                const text = item.textContent.toLowerCase();
                                                item.style.display = text.includes(filter) ? '' : 'none';
                                            });
                                        }

                                        // Optional: Enable Bootstrap tooltips
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                            tooltipTriggerList.map(t => new bootstrap.Tooltip(t));
                                        });
                                    </script>

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
