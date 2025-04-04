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
                    <a href="{{ route('supportDashboard') }}" class="logo">
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
                            <a href="{{ route('supportDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('supportview') }}">
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
                                        <a href="{{ route('support.participants.index') }}">
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
                                        <a href="{{ route('support.attendance.index') }}">
                                            <span class="sub-item">Manage attendance</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#user">
                                <i class="fas fa-user"></i>
                                <p>User</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="user">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('users.index') }}">
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
                                        <a href="{{ route('events.index') }}">
                                            <span class="sub-item">Manage Events</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
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
                        <a href="{{ route('supportDashboard') }}" class="logo">
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
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">

                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">

                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold" style="text-transform: capitalize;">
                                            {{ Auth::user()->name }}
                                        </span>

                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="u-text">
                                                    <h4> {{ Auth::user()->name }}</h4>
                                                    <p class="text-muted"> {{ Auth::user()->email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('profile.edit3') }}">My
                                                Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="#"
                                                onclick="document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
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
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap w-100 gap-2">
                                        <!-- Title -->
                                        <h4 class="card-title m-0">Participants</h4>

                                        <!-- Search Form & Buttons -->
                                        <form method="GET" class="d-flex align-items-center ms-auto">
                                            <div class="input-group w-auto w-sm-50 w-md-25">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search..." value="{{ request('search') }}">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                            <div class="d-flex gap-2 ms-2">
                                                <button type="button" onclick="printAttendance()"
                                                    class="btn btn-primary text-white"
                                                    data-bs-toggle="tooltip" title="Print Participant List">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="card-body">
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
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Assigned Cooperative
                                                    </th>
                                                    <th>
                                                        Delegate Status
                                                    </th>
                                                    <th>
                                                        First Name
                                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_name', 'sort_order' => 'asc']) }}"
                                                            class="btn btn-sm btn-light p-0 mx-1">↑</a>
                                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_name', 'sort_order' => 'desc']) }}"
                                                            class="btn btn-sm btn-light p-0">↓</a>
                                                    </th>
                                                    <th>
                                                        Last Name
                                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'last_name', 'sort_order' => 'asc']) }}"
                                                            class="btn btn-sm btn-light p-0 mx-1">↑</a>
                                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'last_name', 'sort_order' => 'desc']) }}"
                                                            class="btn btn-sm btn-light p-0">↓</a>
                                                    </th>
                                                    <th>
                                                        Designation
                                                    </th>
                                                    <th>QR Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @forelse ($participants as $participant)
                                                    <tr>
                                                        {{-- <td>{{ $participant->registration->status ?? 'Pending' }}</td> --}}
                                                        <td>{{ optional($participant->cooperative)->name ?? 'N/A' }}
                                                        </td>
                                                        <td>{{ $participant->delegate_type ?? 'N/A' }}</td>
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
                                                            <div class="form-button-action no-print">

                                                                {{-- <button
                                                                    class="btn btn-link btn-success btn-lg no-print"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Generate & Print ID"
                                                                    onclick="printParticipantID(
                                                                    {{ $participant->participant_id }},
                                                                    '{{ $participant->first_name }}',
                                                                    '{{ $participant->last_name }}',
                                                                    '{{ $participant->designation ?? 'N/A' }}',
                                                                    '{{ $participant->reference_number ?? 'N/A' }}',
                                                                    '{{ optional($participant->cooperative)->name ?? 'N/A' }}',
                                                                    'https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(route('adminDashboard', ['participant_id' => $participant->participant_id])) }}&size=200x200'
                                                                )">
                                                                    <i class="fa fa-id-card"></i>
                                                                </button> --}}

                                                                @if ($participant->user && $participant->user->user_id)
                                                                    <a href="javascript:void(0);"
                                                                        onclick="resendEmail3({{ $participant->user->user_id }})"
                                                                        class="btn btn-link btn-warning btn-lg"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Resend Credentials">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </a>
                                                                @else
                                                                    <span class="text-danger">No user assigned</span>
                                                                @endif

                                                                <a href="{{ route('support.participants.show', $participant->participant_id) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Participant Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                {{-- <a href="{{ route('participants.edit', $participant->participant_id) }}"
                                                                    class="btn btn-link btn-primary btn-lg no-print"
                                                                    data-bs-toggle="tooltip" title="Edit Participant">
                                                                    <i class="fa fa-edit"></i>
                                                                </a> --}}

                                                                {{-- <form
                                                                    action="{{ route('participants.destroy', $participant->participant_id) }}"
                                                                    method="POST" class="delete-form"
                                                                    style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-link btn-danger no-print"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Remove Participant"
                                                                        aria-label="Remove Participant"
                                                                        onclick="confirmDelete(event, this)">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form> --}}
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

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $participants->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
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
    {{-- Include SweetAlert2 if not already included --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function resendEmail3(userId) {
            Swal.fire({
                title: 'Sending Email...',
                text: 'Please wait while we resend the email.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch("{{ url('/participants') }}/" + userId + "/resend-email-support")
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
        function printParticipantID(id, firstName, lastName, designation, reference_number, cooperative, qrCode) {
            let printWindow = window.open('', '_blank', 'width=400,height=600');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Participant ID</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            text-align: center;
                            margin: 20px;
                        }
                        .id-card {
                            width: 300px;
                            height: 450px;
                            border: 2px solid black;
                            padding: 20px;
                            border-radius: 10px;
                            display: inline-block;
                            text-align: center;
                        }
                        .id-card img {
                            width: 100px;
                            height: 100px;
                        }
                    </style>
                </head>
                <body>
                    <div class="id-card">
                        <h2>Participant ID</h2>
                        <p><strong>Name:</strong> ${firstName} ${lastName}</p>
                        <p><strong>Designation:</strong> ${designation}</p>
                        <p><strong>Cooperative:</strong> ${cooperative}</p>
                          <p><strong>Access Key:</strong> ${reference_number}</p>
                        ${qrCode ? `<img src="${qrCode}" alt="QR Code">` : `<p>No QR Code</p>`}
                    </div>
                    <script>
                        setTimeout(() => {
                            window.print();
                            setTimeout(() => { window.close(); }, 500);
                        }, 500);
                    <\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
        }
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
                        <th>User Account</th>
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
