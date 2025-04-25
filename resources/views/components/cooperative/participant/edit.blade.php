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
                        <a href="{{ route('adminDashboard') }}" class="logo">
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
                                <a href="#">Edit</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Edit</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <form id="participantForm"
                                        action="{{ route('coop.participants.update', $participant->participant_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Coop Selection -->
                                                @php
                                                    $user = Auth::user();
                                                    $userCoopId = $user->coop_id ?? null; // Get the logged-in user's cooperative ID
                                                @endphp

                                                @if (!$canAddVoting && $participant->delegate_type !== 'Voting')
                                                    <div class="alert alert-warning mt-2">
                                                        The maximum number of Voting delegates ({{ $votes }})
                                                        has
                                                        been reached.
                                                        You cannot change this participant to Voting status.
                                                    </div>
                                                @elseif($participant->delegate_type === 'Voting')
                                                    <div class="alert alert-info mt-2">
                                                        This participant is currently a Voting delegate. Total votes
                                                        allowed: {{ $votes }}.
                                                        You may change their delegate type if necessary.
                                                    </div>
                                                @endif

                                                @php
                                                    $eventNames = [
                                                        14 => 'Gender Congress',
                                                        15 => 'Youth Congress',
                                                        18 => 'Education Committee Forum',
                                                        13 => 'Manager Congress',
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
                                                        <select class="form-control" name="coop_id" id="coop_id"
                                                            {{ $userCoopId ? 'disabled' : '' }}>
                                                            <option value="" disabled>Select Cooperative</option>
                                                            @foreach ($cooperatives as $cooperative)
                                                                <option value="{{ $cooperative->coop_id }}"
                                                                    {{ old('coop_id', $participant->coop_id) == $cooperative->coop_id ? 'selected' : '' }}>
                                                                    {{ $cooperative->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <!-- Hidden input to ensure coop_id is submitted when select is disabled -->
                                                        @if ($userCoopId)
                                                            <input type="hidden" name="coop_id"
                                                                value="{{ $userCoopId }}">
                                                        @endif
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
                                                        <input type="text" class="form-control" name="first_name"
                                                            value="{{ old('first_name', $participant->first_name) }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <!-- Middle Name -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="middle_name">Middle Name</label>
                                                        <input type="text" class="form-control" name="middle_name"
                                                            value="{{ old('middle_name', $participant->middle_name) }}">
                                                    </div>
                                                </div>

                                                <!-- Last Name -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            value="{{ old('last_name', $participant->last_name) }}"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="reference_number">Access Key</label>
                                                        <input type="text" class="form-control"
                                                            name="reference_number"
                                                            value="{{ old('reference_number', $participant->reference_number) }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <!-- Nickname -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="nickname">Nickname</label>
                                                        <input type="text" class="form-control" name="nickname"
                                                            value="{{ old('nickname', $participant->nickname) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="email">Participant Email</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" id="email" placeholder="Enter Email"
                                                            value="{{ old('email', $participant->email) }}" />

                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="phone_number">Participant Phone Number</label>
                                                        <input type="text" class="form-control"
                                                            name="phone_number"
                                                            value="{{ old('phone_number', $participant->phone_number) }}">
                                                    </div>
                                                </div>
                                                
                                                <!-- Gender -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="gender">Sex</label>
                                                        <select class="form-control" name="gender">
                                                            <option value="Male"
                                                                {{ old('gender', $participant->gender) == 'Male' ? 'selected' : '' }}>
                                                                Male</option>
                                                            <option value="Female"
                                                                {{ old('gender', $participant->gender) == 'Female' ? 'selected' : '' }}>
                                                                Female</option>
                                                            {{-- <option value="Other" {{ old('gender', $participant->gender) == 'Other' ? 'selected' : '' }}>Other</option> --}}
                                                        </select>
                                                    </div>
                                                </div>




                                                <!-- Designation -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="designation">Designation</label>
                                                        <input type="text" class="form-control" name="designation"
                                                            value="{{ old('designation', $participant->designation) }}">
                                                    </div>
                                                </div>



                                                @php
                                                    $participantEventIds = $participant->events
                                                        ->pluck('event_id')
                                                        ->toArray();
                                                @endphp

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="event_ids">Congress</label>

                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-outline-secondary dropdown-toggle w-100 text-start"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false" id="selectedEventsBtn"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Selected Congresses">
                                                                Select Congresses
                                                            </button>

                                                            <ul class="dropdown-menu p-3 shadow w-100"
                                                                style="max-height: 300px; overflow-y: auto;"
                                                                onclick="event.stopPropagation();">

                                                                <!-- Optional Search -->
                                                                <li class="mb-3">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Search..."
                                                                        onkeyup="filterEvents(this)">
                                                                </li>

                                                                @foreach ($events as $event)
                                                                    @php
                                                                        $isEventFull =
                                                                            isset($eventStatus[$event->event_id]) &&
                                                                            $eventStatus[$event->event_id]['full'];
                                                                        $isChecked = in_array(
                                                                            $event->event_id,
                                                                            $participantEventIds,
                                                                        );
                                                                        $eventTotal =
                                                                            $eventStatus[$event->event_id]['total'] ??
                                                                            0;
                                                                        $eventRemaining =
                                                                            $eventStatus[$event->event_id][
                                                                                'remaining'
                                                                            ] ?? 0;
                                                                    @endphp

                                                                    <li class="mb-2 event-item">
                                                                        <label for="event_{{ $event->event_id }}"
                                                                            class="d-flex align-items-center gap-2 py-1 px-2 rounded hover-shadow-sm w-100 {{ $isEventFull ? 'bg-light text-muted' : '' }}"
                                                                            style="cursor: pointer;">
                                                                            <input
                                                                                class="form-check-input event-checkbox me-2"
                                                                                type="checkbox" name="event_ids[]"
                                                                                value="{{ $event->event_id }}"
                                                                                id="event_{{ $event->event_id }}"
                                                                                {{ $isChecked ? 'checked' : '' }}
                                                                                {{ $isEventFull ? 'disabled' : '' }}>
                                                                            <span>
                                                                                {{ $event->title }}
                                                                                @if (in_array($event->event_id, [14, 15, 18, 13]))
                                                                                    @if ($isEventFull)
                                                                                        (Full)
                                                                                    @else
                                                                                        ({{ $eventRemaining }} out of
                                                                                        {{ $eventTotal }} remaining)
                                                                                    @endif
                                                                                @endif
                                                                            </span>
                                                                        </label>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>




                                                <script>
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
                                                            button.textContent = extra > 0 ?
                                                                `${visible.join(', ')} +${extra} more` :
                                                                visible.join(', ');

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

                                                    // Bootstrap tooltip (if you're using Bootstrap 5+)
                                                    document.addEventListener('DOMContentLoaded', () => {
                                                        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                                        tooltipTriggerList.map(t => new bootstrap.Tooltip(t));
                                                        updateSelectedEvents(); // initial load
                                                    });
                                                </script>


                                                <!-- Is MSP Officer -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="is_msp_officer">Is MASS-SPECC Officer</label>
                                                        <select class="form-control" name="is_msp_officer"
                                                            id="is_msp_officer">
                                                            <option value="Yes"
                                                                {{ old('is_msp_officer', $participant->is_msp_officer) == 'Yes' ? 'selected' : '' }}>
                                                                Yes</option>
                                                            <option value="No"
                                                                {{ old('is_msp_officer', $participant->is_msp_officer) == 'No' ? 'selected' : '' }}>
                                                                No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- MSP Officer Position -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="msp_officer_position">MASS-SPECC Officer
                                                            Position</label>
                                                        <input type="text" class="form-control"
                                                            name="msp_officer_position" id="msp_officer_position"
                                                            value="{{ old('msp_officer_position', $participant->msp_officer_position) }}"
                                                            {{ old('is_msp_officer', $participant->is_msp_officer) == 'Yes' ? '' : 'disabled' }}>
                                                    </div>
                                                </div>

                                                <!-- Religious Affiliation -->
                                                {{-- <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="religious_affiliation">Religious Affiliation</label>
                                        <input type="text" class="form-control" name="religious_affiliation" value="{{ old('religious_affiliation', $participant->religious_affiliation) }}">
                                    </div>
                                </div> --}}

                                                <!-- T-Shirt Size -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="tshirt_size">T-Shirt Size</label>
                                                        <select class="form-control" name="tshirt_size"
                                                            id="tshirt_size">
                                                            <option value="XS"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'XS' ? 'selected' : '' }}>
                                                                XS</option>
                                                            <option value="S"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'S' ? 'selected' : '' }}>
                                                                S</option>
                                                            <option value="M"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'M' ? 'selected' : '' }}>
                                                                M</option>
                                                            <option value="L"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'L' ? 'selected' : '' }}>
                                                                L</option>
                                                            <option value="XL"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'XL' ? 'selected' : '' }}>
                                                                XL</option>
                                                            <option value="XXL"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'XXL' ? 'selected' : '' }}>
                                                                XXL</option>
                                                            <option value="XXXL"
                                                                {{ old('tshirt_size', $participant->tshirt_size) == 'XXXL' ? 'selected' : '' }}>
                                                                XXXL</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <script>
                                                    // Set the cutoff date (update as needed)
                                                    const cutoffDate = '2025-05-10'; // Example cutoff date (YYYY-MM-DD)

                                                    // Get current date in YYYY-MM-DD format
                                                    const currentDate = new Date().toISOString().split('T')[0];

                                                    // Check if the current date is past the cutoff date
                                                    if (currentDate > cutoffDate) {
                                                        // Disable the dropdown if the cutoff date has passed
                                                        document.getElementById('tshirt_size').disabled = true;
                                                    }
                                                </script>


                                                <!-- Delegate Type -->
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="delegate_type">Delegate Type</label>
                                                        <select class="form-control" name="delegate_type"
                                                            id="delegate_type">
                                                            <option value="Voting"
                                                                {{ old('delegate_type', $participant->delegate_type) == 'Voting' ? 'selected' : '' }}
                                                                {{ !$canAddVoting && $participant->delegate_type !== 'Voting' ? 'disabled' : '' }}>
                                                                Voting
                                                            </option>
                                                            <option value="Non-Voting"
                                                                {{ old('delegate_type', $participant->delegate_type) == 'Non-Voting' ? 'selected' : '' }}>
                                                                Non-Voting
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>





                                            </div>
                                        </div>

                                        <div class="card-action g-2">
                                            <button type="button" class="btn btn-label-info btn-round"
                                                onclick="window.location.href='{{ route('coop.index') }}'">Back</button>
                                                <button type="submit"
                                                class="btn btn-primary btn-round">Update</button>
                                        </div>
                                    </form>

                                    <!-- Floating Notice with Close Button -->
                                    <div class="floating-notice">
                                        <button class="close-btn" onclick="closeNotice()">×</button>
                                        <div class="notice-content">
                                            <p><strong>Notice:</strong> To ensure you get your preferred t-shirt size,
                                                please <strong>register early!</strong> Sizes will be available on a
                                                first-come, first-served basis.</p>
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
        // Function to close the floating notice
        function closeNotice() {
            document.querySelector('.floating-notice').style.display = 'none';
        }
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
