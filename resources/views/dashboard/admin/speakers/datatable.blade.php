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
                    <div class="collapse show" id="speaker">
                      <ul class="nav nav-collapse">
                        <li class="active">
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
              <h3 class="fw-bold mb-3">Speaker</h3>
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
                  <a href="#">Speaker</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Datatable</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header coop">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Speaker</h4>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addSpeakerModal">
                            Add Speaker
                        </button>
                    </div>
                  </div>
                  <div class="card-body">

                    <!-- Modal -->
                    <form method="GET" action="{{ route('speakers.index') }}" class="mb-3">
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
                                        <th>Name</th>
                                        <th>Topic</th>
                                        <th>Assigned Event</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($speakers as $speaker)
                                        <tr>
                                            <td>{{ $speaker->name }}</td>
                                            <td>{{ $speaker->topic }}</td>
                                            <td>{{ $speaker->event->title ?? 'N/A' }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <!-- Edit Speaker -->
                                                    <button type="button" class="btn btn-link btn-primary btn-lg edit-speaker-btn"
                                                        data-id="{{ $speaker->speaker_id }}" data-bs-toggle="modal" data-bs-target="#editSpeakerModal"
                                                        title="Edit Speaker">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Speaker -->
                                                    <form action="{{ route('speakers.destroy', $speaker->speaker_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link btn-danger" onclick="confirmDelete(event, this)"
                                                            title="Remove Speaker">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No speakers found</td>
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
                    <div class="modal fade" id="addSpeakerModal" tabindex="-1" aria-labelledby="addSpeakerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Speaker</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('speakers.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name..." required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Topic</label>
                                        <input type="text" name="topic" class="form-control" placeholder="Enter Topic..." required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Assign Event</label>
                                        <select name="event_id" class="form-control" required>
                                            <option value="">List of Events</option>
                                            @foreach($events as $event)
                                                <option value="{{ $event->event_id }}">{{ $event->title }}</option> <!-- Display the event title -->
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Speaker</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- Edit Speaker Modal -->
                    <div class="modal fade" id="editSpeakerModal" tabindex="-1" aria-labelledby="editSpeakerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Speaker</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editSpeakerForm" method="POST" action="{{ isset($speaker) ? route('speakers.update', ['speaker_id' => $speaker->speaker_id]) : '#' }}">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="speaker_id" id="editSpeakerId" value="{{ $speaker->speaker_id ?? '' }}">

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" id="editSpeakerName" class="form-control" value="{{ $speaker->name ?? '' }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Topic</label>
                                        <input type="text" name="topic" id="editSpeakerTopic" class="form-control" value="{{ $speaker->topic ?? '' }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Event</label>
                                        <select name="event_id" class="form-control" required>
                                            <option value="">Select Event</option>
                                            @foreach($events as $event)
                                                <option value="{{ $event->event_id }}" {{ isset($speaker) && $event->event_id == $speaker->event_id ? 'selected' : '' }}>
                                                    {{ $event->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Speaker</button>
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

        // Load speaker data into edit modal
        document.querySelectorAll('.edit-speaker-btn').forEach(button => {
            button.addEventListener('click', function() {
                let speakerId = this.getAttribute('data-id');
                fetch(`{{ url('/speakers') }}/${speakerId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('editSpeakerId').value = data.id;
                        document.getElementById('editSpeakerName').value = data.name;
                        document.getElementById('editSpeakerTopic').value = data.topic;
                        document.getElementById('editSpeakerEvent').value = data.event_id;
                        document.getElementById('editSpeakerForm').action = `{{ url('/speakers') }}/${data.id}`;
                    });
            });
        });
    </script>
    @include('layouts.links')
  </body>
</html>
