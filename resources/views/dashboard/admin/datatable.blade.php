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
                  <a href="#">Dashboard</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Cooperative</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap w-100">
                            <!-- Title -->
                            <h4 class="card-title mb-0 flex-shrink-0">Cooperative</h4>

                            <!-- Search Form & Buttons (All in One Row) -->
                            <form method="GET" action="{{ route('adminview') }}" class="d-flex align-items-center gap-2 flex-grow-1">
                                <div class="input-group flex-nowrap">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('adminregister') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Add Cooperative">
                                        <i class="fa fa-plus me-1"></i>
                                    </a>
                                    <a href="{{ route('import.form') }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Import Cooperative">
                                        <i class="fa fa-upload me-1"></i>
                                    </a>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" onclick="printAttendance()"
                                        class="btn btn-primary" data-bs-toggle="tooltip" title="Print Cooperative List">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                  <div class="card-body">
                    <!-- Search Form -->
                    <div class="notify_btn d-flex flex-wrap align-items-center justify-content-center gap-3 text-center">

                        <!-- Section Label -->
                        <span class="text-uppercase text-primary fw-bold d-flex align-items-center">
                            <i class="fa fa-bell text-warning me-2"></i> Notifications:
                        </span>

                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <!-- Notify via Email -->
                            <form>
                                <button class="btn btn-outline-info d-flex align-items-center px-3 py-2 fw-semibold notify-btn"
                                        onclick="openGmail()"
                                        data-bs-toggle="tooltip"
                                        title="Notify via Email">
                                    <i class="fa fa-envelope me-2"></i> Email
                                </button>
                            </form>
                            <!-- Status & Invitation Form -->
                            <form action="{{ route('cooperatives.notifyAll') }}" method="POST" onsubmit="showSwalLoader(event, this, 'Sending Status & Invitation...')">
                                @csrf
                                <button type="submit" class="btn btn-outline-success d-flex align-items-center px-3 py-2 fw-semibold notify-btn"
                                        data-bs-toggle="tooltip"
                                        title="Send Status & Invitation">
                                    <i class="fa fa-bell me-2"></i> Status & Invite
                                </button>
                            </form>

                            <!-- Credentials Form -->
                            <form action="{{ route('cooperatives.notifyCredentialsAll') }}" method="POST" onsubmit="showSwalLoader(event, this, 'Sending Login Credentials...')">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger d-flex align-items-center px-3 py-2 fw-semibold notify-btn"
                                        data-bs-toggle="tooltip"
                                        title="Send Login Credentials">
                                    <i class="fa fa-lock me-2"></i> Credentials
                                </button>
                            </form>

                        </div>

                    </div>

                    <style>
                        .notify_btn {
                            display: flex;
                            flex-wrap: wrap;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                            text-align: center;
                        }
                        .notify-btn {
                            transition: all 0.3s ease-in-out;
                            border-radius: 8px;
                            white-space: nowrap;
                        }
                        .notify-btn:hover {
                            transform: translateY(-2px);
                        }

                        /* Mobile responsiveness */
                        @media (max-width: 576px) {
                            .notify_btn {
                                flex-direction: column;
                                align-items: center;
                            }
                            .notify-btn {
                                width: 100%;
                                text-align: center;
                            }
                        }
                    </style>

                        <!-- Table with Cooperatives -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Cooperative Name</th>
                                        <th>Cooperative Address</th>
                                        <th>Cooperative Region</th>
                                        <th>Cooperative Email</th>
                                        <th>Registration Status</th>
                                        <th>Membership Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cooperatives as $coop)
                                        <tr>
                                            <td>{{ $coop->name }}</td>
                                            <td>{{ $coop->address }}</td>
                                            <td>{{ $coop->region }}</td>
                                            <td>{{ $coop->email }}</td>


                                  <!-- Registration Status Dropdown -->
                                            <td>
                                                <form action="{{ route('cooperatives.updateStatus', $coop->coop_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="registration_status" class="form-select" onchange="this.form.submit()">
                                                        <option value="" disabled selected>-- Select Status --</option>
                                                        {{-- <option value="Rejected"
                                                            {{ optional($coop->gaRegistration)->registration_status == 'Rejected' ? 'selected' : '' }}>
                                                            Rejected
                                                        </option> --}}
                                                        <option value="Partial Registered"
                                                            {{ optional($coop->gaRegistration)->registration_status == 'Partial Registered' ? 'selected' : '' }}>
                                                            Partial Registered
                                                        </option>
                                                        <option value="Fully Registered"
                                                            {{ optional($coop->gaRegistration)->registration_status == 'Fully Registered' ? 'selected' : '' }}>
                                                            Fully Registered
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>

                                            <!-- Membership Status Dropdown -->
                                            <td>
                                                <form action="{{ route('cooperatives.updateStatus', $coop->coop_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="membership_status" class="form-select" onchange="this.form.submit()">
                                                        <option value="" disabled selected>-- Select Status --</option>
                                                        <option value="Non-migs"
                                                            {{ optional($coop->gaRegistration)->membership_status == 'Non-migs' ? 'selected' : '' }}>
                                                            Non-migs
                                                        </option>
                                                        <option value="Migs"
                                                            {{ optional($coop->gaRegistration)->membership_status == 'Migs' ? 'selected' : '' }}>
                                                            Migs
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>


                                            <td class="no-print">
                                                <div class="form-button-action">

                                                    <!-- Notify Form -->
                                                    @if(session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif

                                                <form action="{{ route('cooperatives.notify', $coop->coop_id) }}" method="POST" style="display:inline;"
                                                    onsubmit="showSwalLoader(event, this, 'Sending Status & Invitation...')">
                                                  @csrf
                                                  <button type="submit" class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip" title="Send Status & Invite">
                                                      <i class="fa fa-bell"></i>
                                                  </button>
                                              </form>

                                                    <a href="{{ route('admin.documents.view', ['coop_id' => $coop->coop_id]) }}"
                                                        class="btn btn-link btn-info btn-lg"
                                                        data-bs-toggle="tooltip" title="View Uploaded Documents">
                                                        <i class="fa fa-file"></i>
                                                    </a>

                                                    <!-- View Coop Details -->
                                                    <a href="{{ route('cooperatives.show', $coop->coop_id) }}" class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip" title="View Coop Details">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <!-- Edit Coop -->
                                                    <button type="button" class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip" title="Edit Coop">
                                                        <a href="{{ route('cooperatives.edit', $coop->coop_id) }}" class="text-decoration-none text-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </button>

                                                    <!-- Delete Coop -->
                                                    <form action="{{ route('cooperatives.destroy', $coop->coop_id) }}" method="POST" class="delete-form" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove Coop" aria-label="Remove Coop" onclick="confirmDelete(event, this)">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No search results found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                            @if(session('success'))
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
                  <div class="d-flex justify-content-center mt-3">
                    {{ $cooperatives->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
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
   function printAttendance() {
    var tableClone = document.querySelector("table tbody").cloneNode(true);

    // Convert dropdowns to text before printing
    tableClone.querySelectorAll("select").forEach(select => {
        var selectedText = select.options[select.selectedIndex].text;
        var textNode = document.createTextNode(selectedText);
        select.parentNode.replaceChild(textNode, select);
    });

    // Remove action buttons before printing
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
            event.preventDefault(); // Stop normal form submission

            Swal.fire({
                title: 'Processing...',
                text: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();

                    // Submit the form after showing the loader
                    setTimeout(() => {
                        form.submit();
                    }, 2000); // Adjust the delay as needed
                }
            });
        }
    </script>
    <script>
        function showSwalLoader(event, form, message) {
            event.preventDefault(); // Stop normal form submission

            Swal.fire({
                title: 'Processing...',
                text: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();

                    // Submit the form after showing the loader
                    setTimeout(() => {
                        form.submit();
                    }, 2000); // Adjust the delay as needed
                }
            });
        }
    </script>

    <script>
        function openGmail() {
            let recipient = @json($emails);
            let subject = encodeURIComponent("52nd CO-OP LEADERS CONGRESS & 48th GENERAL ASSEMBLY");
            let body = encodeURIComponent(`Dear Cooperative Members,

            We are pleased to invite you to our upcoming event:

            Event Name:
            Date:
            Location:

            Best Regards,
            MASS-SPECC Cooperative Development Center`);

                    window.open(`https://mail.google.com/mail/?view=cm&fs=1&to=${recipient}&su=${subject}&body=${body}`, '_blank');
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

    @include('layouts.links')
  </body>
</html>
