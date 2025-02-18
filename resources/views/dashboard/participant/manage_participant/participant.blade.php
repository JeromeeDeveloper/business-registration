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
            <a href="{{route('participantDashboard')}}" class="logo">
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
                      href="{{route('participantDashboard')}}"
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
                  <p>Resource Speakers</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="cooperative">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{route('speakerlist')}}">
                          <span class="sub-item">List of Resource Speakers</span>
                        </a>
                      </li>
                  </ul>
                </div>
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
                        <a href="{{route('coop.index')}}">
                          <span class="sub-item">Participants</span>
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
                        <a href="{{route('schedule')}}">
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
                  <a href="#">Participants</a>
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
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Participants</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Modal -->
                  <!-- Search Form -->
                  <div>

                  </div>
                  <form method="GET" class="mb-2">
                    <div class="d-flex justify-content-end">
                        <div class="input-group w-50 w-md-50 w-lg-25 ms-auto">
                            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                            <div class="input-group-append gap-2 d-flex">
                            <button type="submit" class="btn btn-primary">  <i class="fa fa-search"></i></button>
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="tooltip" title="Add Participant" onclick="location.href='{{ route('coopparticipantadd') }}'">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        </div>
                    </div>
                </form>
<!-- Table Display -->
<div class="table-responsive">
    <table id="add-row" class="display table table-striped table-hover">
        <thead>
            <tr>
                <th>Registration Status</th>
                <th>Cooperative Name</th>
                {{-- <th>User Account</th> --}}
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
                    <td>{{ $participant->registration->status ?? 'Pending' }}</td>
                    <td>{{ optional($participant->cooperative)->name ?? 'N/A' }}</td>
                    {{-- <td>{{ optional($participant->user)->name ?? 'N/A' }}</td> --}}
                    <td>{{ $participant->first_name }}</td>
                    <td>{{ $participant->last_name }}</td>
                    <td>{{ $participant->designation ?? 'N/A' }}</td>
                    <td>
                        @if ($participant->qr_code)
                            <img src="{{ asset('storage/' . $participant->qr_code) }}" alt="QR Code" style="width: 100px; height: 100px;">
                        @else
                            N/A
                        @endif
                    </td>



                    <td>
                        <div class="form-button-action">


                            {{-- <a href="{{ route('admin.documents.view', ['participant_id' => $participant->participant_id]) }}"
                                class="btn btn-link btn-info btn-lg"
                                data-bs-toggle="tooltip" title="View Uploaded Documents">
                                <i class="fa fa-file"></i>
                             </a> --}}

                            <a href="{{ route('coop.participants.show', $participant->participant_id) }}"
                              class="btn btn-link btn-info btn-lg"
                                data-bs-toggle="tooltip"
                                title="View Participant Details">
                                 <i class="fa fa-eye"></i>
                             </a>

                             <a href="{{ route('coop.participants.edit', $participant->participant_id) }}" class="btn btn-link btn-primary btn-lg"
                                data-bs-toggle="tooltip" title="Edit Participant">
                                 <i class="fa fa-edit"></i>
                             </a>

                            <form action="{{ route('coop.participants.destroy', $participant->participant_id) }}" method="POST" class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove Participant" aria-label="Remove Participant" onclick="confirmDelete(event, this)">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>

                        <td>

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


               <!-- Approval Modal -->
                <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="approveModalLabel">Update Participant Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to <strong id="statusActionText"></strong> participant <strong id="participantName"></strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn" id="confirmApproveBtn"></button>
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
    document.addEventListener("DOMContentLoaded", function () {
        let participantId = null;
        let newStatus = "";

        document.querySelectorAll(".approve-btn").forEach(button => {
            button.addEventListener("click", function () {
                participantId = this.getAttribute("data-participant-id");
                const participantName = this.getAttribute("data-name");
                newStatus = this.getAttribute("data-status");
                const action = this.getAttribute("data-action");

                if (this.disabled) {
                    Swal.fire("Info", `This participant is already ${newStatus.toLowerCase()}.`, "info");
                    return;
                }

                // Update modal content
                document.getElementById("participantName").textContent = participantName;
                document.getElementById("statusActionText").textContent = action === "approve" ? "approve" : "reject";
                const confirmBtn = document.getElementById("confirmApproveBtn");
                confirmBtn.textContent = action === "approve" ? "Approve" : "Reject";
                confirmBtn.className = action === "approve" ? "btn btn-success" : "btn btn-danger";

                // Disable button if participant lacks documents
                const hasDocuments = this.getAttribute("data-has-documents") === "true";
                confirmBtn.disabled = !hasDocuments;

                if (!hasDocuments) {
                    Swal.fire("Error", "This participant has no required documents.", "error");
                }
            });
        });

        document.getElementById("confirmApproveBtn").addEventListener("click", function () {
            if (!participantId) return;

            fetch(`/participants/${participantId}/approve`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Success", `Participant status updated to ${newStatus}!`, "success")
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
