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
    $isMay22 = now()->format('m-d') === '05-19';

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
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Participant</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div
                                        class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                                        <!-- Left: Participants Count -->
                                        <div class="d-flex align-items-center">
                                            <h4
                                                class="fw-bold d-flex gap-2 align-items-center mb-2 mb-md-0 text-nowrap">
                                                Cooperative's Participants:
                                                <span class="badge bg-primary text-white px-3 py-2 fs-5">
                                                    {{ $totalParticipants }}
                                                </span>
                                            </h4>
                                        </div>

                                        @php
                                        use App\Models\Participant;
                                        use App\Models\Cooperative;

                                        $isMay16 = now()->format('m-d') === '05-22';
                                        $participantCount = Participant::whereNotNull('coop_id')->count();
                                        $isMaxedParticipants = $participantCount >= 1000;

                                        $isAddDisabled = false;
                                        $tooltipMessage = 'Add Participant';

                                        if (auth()->check() && auth()->user()->role === 'cooperative') {
                                            $userEmail = auth()->user()->email;

                                            // Find cooperative with GA registration
                                            $cooperative = Cooperative::where('email', $userEmail)
                                                ->whereHas('gaRegistration', function ($query) {
                                                    $query->whereIn('registration_status', ['Partial Registered', 'Fully Registered']);
                                                })
                                                ->first();

                                            $isAddDisabled = $isMay16 || $isMaxedParticipants || !is_null($cooperative);

                                            // Set reason for disabling
                                            if ($isMay16) {
                                                $tooltipMessage = 'Disabled: Registration is closed (May 22)';
                                            } elseif ($isMaxedParticipants) {
                                                $tooltipMessage = 'Disabled: Max 1000 participants reached';
                                            } elseif (!is_null($cooperative)) {
                                                $tooltipMessage = 'Disabled: Your cooperative is already registered';
                                            }

                                        } else {
                                            $isAddDisabled = $isMay16 || $isMaxedParticipants;

                                            if ($isMay16) {
                                                $tooltipMessage = 'Disabled: Registration is closed (May 22)';
                                            } elseif ($isMaxedParticipants) {
                                                $tooltipMessage = 'Disabled: Max 1000 participants reached';
                                            }
                                        }
                                    @endphp

                                    @if ($isMay16)
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <i class="fa fa-exclamation-triangle me-2"></i>
                                            <div>Registration is closed.</div>
                                        </div>
                                    @elseif ($isMaxedParticipants)
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class="fa fa-times-circle me-2"></i>
                                            <div>Maximum number of participants has been reached and Registration is closed.</div>
                                        </div>
                                    @endif


                                        <!-- Right: Search Form + Add Button -->
                                        <form method="GET" class="w-80 w-md-auto">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search..." value="{{ request('search') }}">

                                                <!-- Buttons with gap -->
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-search"></i>
                                                    </button>


                                                    <button type="button"
                                                    class="btn btn-primary text-white {{ $isAddDisabled ? 'disabled' : '' }}"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ $tooltipMessage }}"
                                                    {{ $isAddDisabled ? 'aria-disabled=true' : '' }}
                                                    onclick="{{ $isAddDisabled ? 'return false;' : "location.href='" . route('coopparticipantadd') . "'" }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>


                                                    <button type="button" onclick="printAttendance()"
                                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center shadow-sm gap-2">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <!-- Search Form -->
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <label>Show
                                                <select id="showEntries" class="form-select form-select-sm"
                                                    style="width: auto; display: inline;">
                                                    <option value="5"
                                                        {{ request('limit') == 5 ? 'selected' : '' }}>5</option>
                                                    <option value="10"
                                                        {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                </select> entries
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Table Display -->
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>

                                                    <th>Cooperative Name</th>

                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Designation</th>
                                                    <th>QR</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($participants as $participant)
                                                    <tr>

                                                        <td>{{ optional($participant->cooperative)->name ?? 'N/A' }}
                                                        </td>

                                                        <td>{{ $participant->first_name }}</td>
                                                        <td>{{ $participant->last_name }}</td>
                                                        <td>{{ $participant->designation ?? 'N/A' }}</td>
                                                        <td>
                                                            @if ($participant->participant_id)
                                                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(route('adminDashboard', ['participant_id' => $participant->participant_id])) }}&size=100x100"
                                                                    alt="QR Code"
                                                                    style="width: 100px; height: 100px;">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>

                                                        <td class="no-print">
                                                            <div class="form-button-action">


                                                                {{-- <a href="{{ route('admin.documents.view', ['participant_id' => $participant->participant_id]) }}"
                                class="btn btn-link btn-info btn-lg"
                                data-bs-toggle="tooltip" title="View Uploaded Documents">
                                <i class="fa fa-file"></i>
                             </a> --}}

                                                                @if ($participant->user && $participant->user->user_id)
                                                                    <a href="javascript:void(0);"
                                                                        onclick="resendEmail({{ $participant->user->user_id }})"
                                                                        class="btn btn-link btn-warning btn-lg"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Resend Credentials">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </a>
                                                                @else
                                                                    <span class="text-danger">No user assigned</span>
                                                                @endif

                                                                <a href="{{ route('coop.participants.show', $participant->participant_id) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Participant Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                @php
                                                                    $isMay13 = now()->format('m-d') === '05-13';
                                                                @endphp

                                                                @if ($isMay13)
                                                                    <div class="alert alert-warning d-flex align-items-center mb-2"
                                                                        role="alert">
                                                                        <i class="fa fa-exclamation-triangle me-2"></i>
                                                                        <div>
                                                                            Editing participants is disabled. The edit
                                                                            period has ended (May 13).
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                <a href="{{ $isMay13 ? '#' : route('coop.participants.edit', $participant->participant_id) }}"
                                                                    class="btn btn-link btn-primary btn-lg {{ $isMay13 ? 'disabled' : '' }}"
                                                                    {{ $isMay13 ? 'aria-disabled=true' : '' }}
                                                                    onclick="{{ $isMay13 ? 'return false;' : '' }}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ $isMay13 ? 'Edit disabled on May 13' : 'Edit Participant' }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>


                                                                <form
                                                                    action="{{ route('coop.participants.destroy', $participant->participant_id) }}"
                                                                    method="POST" class="delete-form"
                                                                    style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-link btn-danger"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Remove Participant"
                                                                        aria-label="Remove Participant"
                                                                        onclick="confirmDelete(event, this)">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>
                                                        </td>






                                    </div>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No participants found</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                    </table>
                                </div>

                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: '{{ session('success') == 'Deleted!' ? 'Deleted!' : 'Success!' }}',
                                            text: '{{ session('success') }}',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>
                                @endif


                                <!-- Approval Modal -->
                                <div class="modal fade" id="approveModal" tabindex="-1"
                                    aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">Update Participant
                                                    Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to <strong id="statusActionText"></strong>
                                                    participant <strong id="participantName"></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn"
                                                    id="confirmApproveBtn"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination info -->
                                @if ($participants->count())
                                    <div class="text-center mt-2">
                                        <small>
                                            Showing {{ $participants->firstItem() }} to
                                            {{ $participants->lastItem() }} of
                                            {{ $participants->total() }} entries
                                        </small>
                                    </div>
                                @endif

                                <!-- Mobile-friendly, centered pagination -->
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="w-100" style="overflow-x: auto;">
                                        <div class="d-flex justify-content-center" style="min-width: max-content;">
                                            {{ $participants->appends([
                                                    'search' => request('search'),
                                                    'limit' => request('limit'),
                                                ])->links('pagination::bootstrap-4') }}
                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function resendEmail(userId) {
            Swal.fire({
                title: 'Sending Email...',
                text: 'Please wait while we resend the email.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch("{{ url('/participants') }}/" + userId + "/resend-email")
                .then(response => response.json()) // Expecting JSON response from Laravel
                .then(data => {
                    Swal.close(); // Close the loading Swal
                    if (data.success) {
                        Swal.fire('Success!', data.message, 'success');
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.close();
                    Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
                });
        }
    </script>
    <script>
        document.getElementById('showEntries').addEventListener('change', function() {
            let url = new URL(window.location.href);
            url.searchParams.set('limit', this.value);
            window.location.href = url.href;
        });
    </script>

    <script>
        function printAttendance() {
            var tableClone = document.querySelector("table tbody").cloneNode(true);

            // Remove action buttons before printing
            tableClone.querySelectorAll(".no-print").forEach(el => el.remove());

            var printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write(`
        <html>
        <head>
            <title>Participant List</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f4f4f4; }
                .no-print { display: none; } /* Hide actions column when printing */
            </style>
        </head>
        <body>
            <h2>Participants List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cooperative</th>

                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Designation</th>
                        <th>QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableClone.innerHTML}
                </tbody>
            </table>
            <script>
                window.onload = function() {
                    window.print();
                    setTimeout(() => window.close(), 1000);
                };
            <\/script>
        </body>
        </html>
    `);
            printWindow.document.close();
        }
    </script>
    <script>
        function confirmDelete(event, button) {
            event.preventDefault(); // Prevent form from submitting

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    button.closest('form').submit();
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let participantId = null;
            let newStatus = "";

            document.querySelectorAll(".approve-btn").forEach(button => {
                button.addEventListener("click", function() {
                    participantId = this.getAttribute("data-participant-id");
                    const participantName = this.getAttribute("data-name");
                    newStatus = this.getAttribute("data-status");
                    const action = this.getAttribute("data-action");

                    if (this.disabled) {
                        Swal.fire("Info", `This participant is already ${newStatus.toLowerCase()}.`,
                            "info");
                        return;
                    }

                    // Update modal content
                    document.getElementById("participantName").textContent = participantName;
                    document.getElementById("statusActionText").textContent = action === "approve" ?
                        "approve" : "reject";
                    const confirmBtn = document.getElementById("confirmApproveBtn");
                    confirmBtn.textContent = action === "approve" ? "Approve" : "Reject";
                    confirmBtn.className = action === "approve" ? "btn btn-success" :
                        "btn btn-danger";

                    // Disable button if participant lacks documents
                    const hasDocuments = this.getAttribute("data-has-documents") === "true";
                    confirmBtn.disabled = !hasDocuments;

                    if (!hasDocuments) {
                        Swal.fire("Error", "This participant has no required documents.", "error");
                    }
                });
            });

            document.getElementById("confirmApproveBtn").addEventListener("click", function() {
                if (!participantId) return;

                fetch(`/participants/${participantId}/approve`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Success", `Participant status updated to ${newStatus}!`,
                                    "success")
                                .then(() => location.reload());
                        } else {
                            Swal.fire("Error", data.message || "Something went wrong!", "error");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>

    @include('layouts.links')
</body>

</html>
