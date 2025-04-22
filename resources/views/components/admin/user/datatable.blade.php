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
                            <div class="collapse" id="cooperative">
                                <ul class="nav nav-collapse">
                                    <li>
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
                            <div class="collapse show" id="user">
                                <ul class="nav nav-collapse">
                                    <li class="active">
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
                @include('layouts.adminnav')
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">User</h3>
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
                                <a href="#">User</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-2 mb-md-0">Users</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">


                                            <div class="input-group w-100 w-md-50 w-lg-25">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search..." value="{{ request('search') }}">
                                                <div class="input-group-append gap-2 d-flex">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <a href="{{ route('registerform') }}" class="btn btn-primary"
                                                        data-bs-toggle="tooltip" title="Add User">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
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
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Assigned Cooperative</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Date Created</th>
                                                        <th style="width: 10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->cooperative ? $user->cooperative->name : 'Mass Specc Cooperative' }}
                                                            </td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ ucfirst($user->role) }}</td>
                                                            <td>{{ $user->created_at->format('F d, Y') }}</td>
                                                            <td>
                                                                <div class="form-button-action">

                                                                    <button type="button"
                                                                        class="btn btn-link btn-primary btn-lg"
                                                                        data-bs-toggle="tooltip" title="Edit User">
                                                                        <a href="{{ route('user.edit', $user->user_id) }}"
                                                                            class="text-decoration-none text-primary">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                    </button>

                                                                    <form
                                                                        action="{{ route('users.destroy', $user->user_id) }}"
                                                                        method="POST" class="delete-form"
                                                                        style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-link btn-danger"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Remove User"
                                                                            aria-label="Remove User"
                                                                            onclick="confirmDelete(event, this)">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">No users found</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>

                                </div>

                                <!-- Pagination info -->
                                <div class="text-center mt-2">
                                    <small>
                                        @if ($users->total() > 0)
                                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of
                                            {{ $users->total() }} entries
                                        @else
                                            No entries found.
                                        @endif
                                    </small>
                                </div>

                                <!-- Mobile-friendly, centered pagination -->
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="w-100" style="overflow-x: auto;">
                                        <div class="d-flex justify-content-center" style="min-width: max-content;">
                                            {{ $users->appends([
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

            @include('layouts.adminfooter')

        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let showEntries = document.getElementById("showEntries");
            if (showEntries) {
                showEntries.addEventListener("change", function() {
                    let url = new URL(window.location.href);
                    url.searchParams.set("limit", this.value); // Set 'limit' parameter
                    window.location.href = url.toString(); // Update the URL and reload the page
                });
            }
        });
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
                    button.closest('form').submit(); // Trigger form submission
                }
            });
        }
    </script>

    @include('layouts.links')
</body>

</html>
