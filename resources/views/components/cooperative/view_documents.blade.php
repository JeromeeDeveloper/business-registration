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
    <div class="collapse" id="participant">
        <ul class="nav nav-collapse">
            <li>
                <a href="{{ route('coop.index') }}"
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
                  <a href="#">Documents</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                  </li>
                  <li class="nav-item">
                    <a href="#">View</a>
                  </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Cooperative Uploaded Documents</div>

                        <a id="uploadBtn" href="{{ route('documents') }}"
                           class="btn btn-primary btn-lg rounded-pill shadow-sm hover-shadow d-flex align-items-center">
                            <i class="fas fa-upload me-2"></i> Upload Document
                        </a>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($documents->isEmpty())
                        <div class="alert alert-warning text-center">No documents uploaded yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Document Type</th>
                                        <th>File Name</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>View</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>
                                                {{ $document->document_type === 'Financial Statement' ? 'Audited ' : '' }}{{ $document->document_type }}
                                            </td>
                                            <td>{{ $document->file_name }}</td>
                                            <td>
                                                @if ($document->status == 'Pending')
                                                    Pending
                                                @elseif ($document->status == 'Approved')
                                                    Accepted
                                                @elseif ($document->status == 'Rejected')
                                                    Decline
                                                @else
                                                    {{ $document->status }}
                                                @endif
                                            </td>

                                            <td>{{ $document->remarks ?? 'No remarks yet' }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{ asset('storage/' . $document->file_path) }}" download class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif



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
  @include('layouts.links')
  </body>
</html>
