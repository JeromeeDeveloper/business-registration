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

              @php
              // Check if the current date is May 22
              $isMay22 = now()->format('m-d') === '05-22';

              // Check if the participant count exceeds 1000
              $participantCount = \App\Models\EventParticipant::count();
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
              <div class="collapse" id="participant">
                  <ul class="nav nav-collapse">
                      <li>
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
                        <a href="{{route('speakerlist')}}">
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
          <!-- Navbar Header -->
          @include('layouts.adminnav2')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Documents</h3>
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
                  <a href="#">Documents</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Upload</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Upload Documents</div>
                  </div>
                  <form id="documentUploadForm" method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Financial Statement -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="financial_statement">Audited Financial Statement</label>
                                    <input type="file" class="form-control" name="documents[Financial Statement]" id="financial_statement" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>

                            <!-- Resolution for Voting Delegates -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="resolution_voting">Resolution for Voting Delegates</label>
                                    <input type="file" class="form-control" name="documents[Resolution for Voting Delegates]" id="resolution_voting" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>

                            <!-- Deposit Slip for Registration Fee -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="registration_fee">Deposit Slip for Registration Fee</label>
                                    <input type="file" class="form-control" name="documents[Deposit Slip for Registration Fee]" id="registration_fee" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>

                            <!-- Deposit Slip for CETF Remittance -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_remittance">Deposit Slip for CETF Remittance</label>
                                    <input type="file" class="form-control" name="documents[Deposit Slip for CETF Remittance]" id="cetf_remittance" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_undertaking">CETF Undertaking</label>
                                    <input type="file" class="form-control" name="documents[CETF Undertaking]" id="cetf_undertaking" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>

                            <!-- CETF Candidacy -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_candidacy">Certificate of Candidacy</label>
                                    <input type="file" class="form-control" name="documents[Certificate of Candidacy]" id="cetf_candidacy" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>

                            <!-- CETF Utilization Invoice -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="cetf_utilization_invoice">CETF Utilization Invoice</label>
                                    <input type="file" class="form-control" name="documents[CETF Utilization Invoice]" id="cetf_utilization_invoice" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.zip"
 />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-action">
                        <button class="btn btn-success">Upload Documents</button>
                    </div>
                </form>

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
    <!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("documentUploadForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: "success",
                title: "Success",
                html: data.message, // Displaying multiple messages properly
            }).then(() => {
                location.reload(); // Reload page after successful upload
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Upload Failed",
                text: data.message || "Something went wrong!",
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "An error occurred while uploading. Please try again.",
        });
    });
});
</script>

  @include('layouts.links')
  </body>
</html>
