<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
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
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">

                        <li class="nav-item">
                            <a href="{{ route('adminDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('adminview') }}">
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
                                        <a href="{{ route('participants.index') }}">
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

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">

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

                </div>

                @include('layouts.adminnav')

            </div>
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Cooperative</h3>
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
                                <a href="{{ route('adminDashboard') }}">Dashboard</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('adminview') }}">Cooperative</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div
                                        class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2">

                                        <h4 class="card-title mb-0 flex-shrink-0">Cooperative</h4>

                                        <form method="GET" action="{{ route('adminview') }}"
                                            class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 flex-grow-1"
                                            id="searchForm">

                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search..." value="{{ request('search') }}">

                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-search"></i></button>
                                            </div>

                                            <div class="d-flex flex-row gap-2">
                                                <a href="{{ route('adminregister') }}" class="btn btn-primary"
                                                    data-bs-toggle="tooltip" title="Add Cooperative">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <a href="{{ route('import.form') }}" class="btn btn-primary"
                                                    data-bs-toggle="tooltip" title="Import Cooperative">
                                                    <i class="fa fa-upload"></i>
                                                </a>

                                                <button type="button" onclick="printAttendance()"
                                                    class="btn btn-primary" data-bs-toggle="tooltip"
                                                    title="Print Cooperative List">
                                                    <i class="fa fa-print"></i>
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div
                                        class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                                        <div>
                                            <label class="mb-0">Show
                                                <select id="showEntries"
                                                    class="form-select form-select-sm d-inline-block w-auto ms-1">
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

                                        <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center">
                                            <button
                                                class="btn btn-label-info btn-round fw-bold d-flex align-items-center px-4 py-2"
                                                data-bs-toggle="modal" data-bs-target="#notifyModal">
                                                <i class="fa fa-bell me-2"></i> Open Notifications
                                            </button>
                                            <button
                                                class="btn btn-label-info btn-round fw-bold d-flex align-items-center px-4 py-2"
                                                data-bs-toggle="modal" data-bs-target="#cooperativeModal">
                                                <i class="fa fa-building me-2"></i> Cooperative Summary Report
                                            </button>
                                            <button
                                                class="btn btn-label-info btn-round fw-bold d-flex align-items-center px-4 py-2"
                                                onclick="window.location.href='{{ route('download.all.documents') }}'">
                                                <i class="fa fa-download me-2"></i> Download All Documents
                                            </button>
                                        </div>

                                        <div class="modal fade" id="cooperativeModal" tabindex="-1"
                                            aria-labelledby="cooperativeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cooperativeModalLabel">Cooperative
                                                            Summary Report</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('generate.pdf') }}" method="POST"
                                                            target="_blank">
                                                            @csrf
                                                            <label for="filter" class="form-label">Select
                                                                Filter</label>
                                                            <select id="filter" name="filter"
                                                                class="form-select">
                                                                <option value="all">All Cooperative</option>
                                                                <option value="fully_registered_migs">Fully Registered
                                                                    MIGS Cooperatives</option>
                                                                <option value="fully_registered_non_migs">Fully
                                                                    Registered NON-MIGS Cooperatives</option>
                                                                <option value="partial_registered_migs">Partial
                                                                    Registered MIGS Cooperatives</option>
                                                                <option value="partial_registered_non_migs">Partial
                                                                    Registered NON MIGS Cooperatives</option>
                                                            </select>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-success"
                                                                    onclick="printReport()">Print or Export as
                                                                    PDF</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible fade show"
                                                role="alert">
                                                <strong>Success!</strong> {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="modal fade" id="notifyModal" tabindex="-1"
                                        aria-labelledby="notifyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content shadow-lg">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="notifyModalLabel">
                                                        <i class="fa fa-bell me-2"></i> Notifications Center
                                                    </h5>
                                                </div>
                                                <div class="modal-body d-flex flex-column gap-3 text-center">

                                                    <form action="{{ route('cooperatives.canvas') }}" method="POST"
                                                        onsubmit="showSwalLoader(event, this, 'Sending Canvas Credentials...')">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center px-4 py-2 fw-semibold"
                                                            data-bs-toggle="tooltip" title="Send Canvas Credentials">
                                                            <i class="fa fa-bell me-2"></i>Cooperative Canvas
                                                            Credentials Notification
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('cooperatives.notifyAll') }}"
                                                        method="POST"
                                                        onsubmit="showSwalLoader(event, this, 'Sending Status & Invitation...')">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center px-4 py-2 fw-semibold"
                                                            data-bs-toggle="tooltip"
                                                            title="Send Credentials & Invitation">
                                                            <i class="fa fa-bell me-2"></i> Reminder for Coop
                                                            Registration Statuses
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('cooperatives.notifyAll.unregistered') }}"
                                                        method="POST"
                                                        onsubmit="showSwalLoader(event, this, 'Sending Status & Invitation...')">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center px-4 py-2 fw-semibold"
                                                            data-bs-toggle="tooltip"
                                                            title="Send Credentials & Invitation">
                                                            <i class="fa fa-bell me-2"></i> Send Credentials to
                                                            Unregistered Coops
                                                        </button>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-label-info btn-round w-25 h-100"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Cooperative Name</th>
                                                    <th>Registered Participant</th>
                                                    <th>Registered Voting Particpants</th>
                                                    <th>Total Allowable Votes</th>
                                                    <th>Registration Status</th>
                                                    <th>Membership Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($cooperatives as $coop)
                                                    <tr>
                                                        <td>{{ $coop->name }}</td>
                                                        <td>{{ $coop->participants_count }}</td>
                                                        <td>{{ $coop->registered_voting_participants }}</td>
                                                        <td>{{ $coop->votes ?? 0 }}</td>

                                                        <td class="p-2 align-middle text-center">
                                                            @php
                                                                $status = optional($coop->gaRegistration)
                                                                    ->registration_status;
                                                                $statusLabel = strtoupper(
                                                                    $status === 'Rejected'
                                                                        ? 'NO REGISTRATION'
                                                                        : $status ?? 'NO REGISTRATION',
                                                                );

                                                                $statusTextClass = match ($statusLabel) {
                                                                    default => 'text-primary',
                                                                };

                                                                $commonStyle =
                                                                    'bg-white border border-gray-600 border-2';
                                                            @endphp
                                                            <span
                                                                class="badge {{ $commonStyle }} {{ $statusTextClass }} fs-6 px-3 py-2 rounded-pill d-inline-block text-wrap w-100 fw-bold"
                                                                style="min-width: 200px;">
                                                                {{ $statusLabel }}
                                                            </span>
                                                        </td>

                                                        <td class="p-2 align-middle text-center">
                                                            @php
                                                                $membershipStatus = strtoupper(
                                                                    optional($coop->gaRegistration)
                                                                        ->membership_status ?? 'NO REGISTRATION',
                                                                );

                                                                $membershipTextClass = match ($membershipStatus) {
                                                                    default => 'text-success',
                                                                };

                                                                $commonStyle =
                                                                    'bg-white border border-gray-600 border-2';
                                                            @endphp
                                                            <span
                                                                class="badge {{ $commonStyle }} {{ $membershipTextClass }} fs-6 px-3 py-2 rounded-pill d-inline-block text-wrap w-100 fw-bold"
                                                                style="min-width: 200px;">
                                                                {{ $membershipStatus }}
                                                            </span>
                                                        </td>

                                                        <td class="no-print">
                                                            <div class="form-button-action">

                                                                @if (session('error'))
                                                                    <div class="alert alert-danger">
                                                                        {{ session('error') }}
                                                                    </div>
                                                                @endif

                                                                <a href="#"
                                                                    class="btn btn-link btn-primary btn-lg"
                                                                    title="Print Coop Summary"
                                                                    onclick="openPrintWindow({{ $coop->coop_id }}); return false;">
                                                                    <i class="fa fa-print"></i>
                                                                </a>

                                                                <form
                                                                    action="{{ route('cooperatives.notify', $coop->coop_id) }}"
                                                                    method="POST" style="display:inline;"
                                                                    onsubmit="showSwalLoader(event, this, 'Sending Status & Invitation...')">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-link btn-info btn-lg"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Send Credentials">
                                                                        <i class="fa fa-bell"></i>
                                                                    </button>
                                                                </form>

                                                                <a href="{{ route('admin.documents.view', ['coop_id' => $coop->coop_id]) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Uploaded Documents">
                                                                    <i class="fa fa-file"></i>
                                                                </a>

                                                                <a href="{{ route('cooperatives.show', $coop->coop_id) }}"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip"
                                                                    title="View Coop Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                <button type="button"
                                                                    class="btn btn-link btn-info btn-lg"
                                                                    data-bs-toggle="tooltip" title="Edit Coop">
                                                                    <a href="{{ route('cooperatives.edit', $coop->coop_id) }}"
                                                                        class="text-decoration-none text-primary">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </button>

                                                                <form
                                                                    action="{{ route('cooperatives.destroy', $coop->coop_id) }}"
                                                                    method="POST" class="delete-form"
                                                                    style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-link btn-danger"
                                                                        data-bs-toggle="tooltip" title="Remove Coop"
                                                                        aria-label="Remove Coop"
                                                                        onclick="confirmDelete(event, this)">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>


                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">No search results found
                                                        </td>
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

                                </div>

                                <div class="text-center mt-2">
                                    <small>
                                        Showing {{ $cooperatives->firstItem() }} to {{ $cooperatives->lastItem() }} of
                                        {{ $cooperatives->total() }} entries
                                    </small>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <div class="w-100" style="overflow-x: auto;">
                                        <div class="d-flex justify-content-center" style="min-width: max-content;">
                                            {{ $cooperatives->appends(request()->query())->links('pagination::bootstrap-4') }}
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
        document.addEventListener("DOMContentLoaded", function() {
            let showEntries = document.getElementById("showEntries");
            if (showEntries) {
                showEntries.addEventListener("change", function() {
                    let url = new URL(window.location.href);
                    url.searchParams.set("limit", this.value);
                    window.location.href = url.toString();
                });
            }
        });
    </script>
    <script>
        function printAttendance() {
            var tableClone = document.querySelector("table tbody").cloneNode(true);
            tableClone.querySelectorAll("select").forEach(select => {
                var selectedText = select.options[select.selectedIndex].text;
                var textNode = document.createTextNode(selectedText);
                select.parentNode.replaceChild(textNode, select);
            });
            tableClone.querySelectorAll(".no-print").forEach(el => el.remove());
            var printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write(`
        <html>
        <head>
            <title>Cooperative List</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f4f4f4; }
                .no-print { display: none; }
            </style>
        </head>
        <body>
            <h2>Cooperative List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cooperative</th>
                        <th>Cooperative Address</th>
                        <th>Cooperative Region</th>
                        <th>Cooperative Email</th>
                        <th>Registration Status</th>
                        <th>Membership Status</th>
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
        function showSwalLoader(event, form, message) {
            event.preventDefault();
            Swal.fire({
                title: 'Processing...',
                text: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(() => {
                        form.submit();
                    }, 2000);
                }
            });
        }
    </script>
    <script>
        function showSwalLoader(event, form, message) {
            event.preventDefault();
            Swal.fire({
                title: 'Processing...',
                text: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(() => {
                        form.submit();
                    }, 2000);
                }
            });
        }
    </script>
    <script>
        function openGmail() {
            let recipients = @json($emailsall).join(',');
            let subject = encodeURIComponent("52nd CO-OP LEADERS CONGRESS & 48th GENERAL ASSEMBLY");
            let body = encodeURIComponent(`Dear Cooperative Members,
            We are pleased to invite you to our upcoming event:
            Event Name:
            Date:
            Location:
            Best Regards,
            MASS-SPECC Cooperative Development Center`);
            window.open(`https://mail.google.com/mail/?view=cm&fs=1&to=${recipients}&su=${subject}&body=${body}`, '_blank');
        }
    </script>
    <script>
        function confirmDelete(event, button) {
            event.preventDefault();
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
                    button.closest('form').submit();
                }
            });
        }
    </script>
    <script>
        function printReport() {
            const selectedFilter = document.getElementById('filter').value;
            const printUrl = `{{ route('cooperative.print') }}?filter=${selectedFilter}`;
            const printWindow = window.open(printUrl, '_blank');
            printWindow.onload = function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>


   <script>
    function openPrintWindow(coopId) {
        const url = `/generate-pdf-single/${coopId}`;
        const printWindow = window.open(url, '_blank');

        printWindow.onload = function() {
            printWindow.focus(); // Focus the window

            printWindow.print();

            // Close the print window shortly after the print dialog closes
            setTimeout(() => {
                printWindow.close();
            }, 500); // Adjust delay if needed
        };
    }
</script>


    @include('layouts.links')



</body>

</html>
