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
                    <div class="collapse show" id="events">
                      <ul class="nav nav-collapse">
                        <li class="active">
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
              <h3 class="fw-bold mb-3">Events</h3>
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
                  <a href="#">Event</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header coop">
                    <div class="d-flex align-items-center">
                      <h4>Events</h4>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addEventModal">
                            Add Event
                        </button>
                    </div>
                  </div>
                  <div class="card-body">

                    <!-- Modal -->
                    <form method="GET" action="{{ route('events.index') }}" class="mb-3">
                        <div class="d-flex justify-content-end">
                            {{-- <div class="input-group flex-nowrap w-50 w-md-50 w-lg-25 ms-auto">
                                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div> --}}
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>

                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                        <tr>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</td>

                                            {{-- <td>{{ $event->location }}</td> --}}
                                            <td>
                                                <div class="form-button-action">
                                                    <!-- Edit Speaker -->
                                                    <button type="button" class="btn btn-link btn-primary btn-lg edit-event-btn"
                                                        data-id="{{ $event->event_id }}" data-bs-toggle="modal" data-bs-target="#editEventModal"
                                                        title="Edit Event">
                                                        <i class="fa fa-edit"></i>
                                                    </button>


                                                    <!-- Delete Event -->
                                                    <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link btn-danger" onclick="confirmDelete(event, this)"
                                                            title="Remove Event">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Events found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK'
                        });
                    </script>
                    @endif

                    <!-- Add Speaker Button -->


                    <!-- Add Speaker Modal -->
                    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Events</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('events.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Event Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Event Description</label>
                                        <input type="text" name="description" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Event Location</label>
                                        <input type="text" name="location" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Event</button>
                                </form>
                            </div>
                        </div>
                     </div>
                    </div>

                    <!-- Edit Event Modal -->
                    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Events</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                                    <div class="modal-body">
                                        <form id="editEventForm" method="POST" action="{{ isset($event) ? route('events.update', ['event_id' => $event->event_id]) : '#' }}">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="event_id" id="editEventId" value="{{ $event->event_id ?? '' }}">

                                            <div class="mb-3">
                                                <label class="form-label">Event Title</label>
                                                <input type="text" name="title" id="editEventTitle" class="form-control" value="{{ $event->title ?? '' }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Event Description</label>
                                                <input type="text" name="description" id="editEventDescription" class="form-control" value="{{ $event->description ?? '' }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" name="start_date" id="editEventStartDate" class="form-control" value="{{ $event->start_date ?? '' }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">End Date</label>
                                                <input type="date" name="end_date" id="editEventEndDate" class="form-control" value="{{ $event->end_date ?? '' }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Event Location</label>
                                                <input type="text" name="location" id="editEventLocation" class="form-control" value="{{ $event->location ?? '' }}" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Event</button>
                                        </form>

                                    </div>
                        </div>
                    </div>
                    </div>
                  </div>
                  {{-- <div class="d-flex justify-content-center mt-3">
                    {{ $cooperatives->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                </div> --}}

                </div>

              </div>


            </div>

          </div>

        </div>

            @include('layouts.adminfooter')

      </div>

    </div>

    <script>

        function confirmDelete(event, button) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest("form").submit();
                }
            });
        }

        // Load event data into edit modal
        document.querySelectorAll('.edit-event-btn').forEach(button => {
            button.addEventListener('click', function() {
                let eventId = this.getAttribute('data-id');
                let url = `{{ url('/events') }}/${eventId}/edit`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editEventId').value = data.event_id;
                        document.getElementById('editEventTitle').value = data.title;
                        document.getElementById('editEventDescription').value = data.title;
                        document.getElementById('editEventStartDate').value = data.start_date;
                        document.getElementById('editEventEndDate').value = data.end_date;
                        document.getElementById('editEventLocation').value = data.location;
                        document.getElementById('editEventForm').action = `{{ url('/events') }}/${data.event_id}`;
                    })
                    .catch(error => console.error("Error fetching event data:", error));
            });
        });
    </script>

    @include('layouts.links')
  </body>
</html>
