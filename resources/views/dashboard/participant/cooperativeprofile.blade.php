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
                <a data-bs-toggle="collapse" href="#participant">
                  <i class="fas fa-users"></i>
                  <p>Participant</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="participant">
                  <ul class="nav nav-collapse">
                    <li>
                        <a href="{{route('coop.index')}}">
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
              <h3 class="fw-bold mb-3">Cooperative Information</h3>
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
                  <a href="#">Cooperative</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Information</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header alignment">

                    {{-- <a href="{{ route('cooperativeprofile.edit')}}" class="btn btn-warning btn-round me-2">
                        Edit Cooperative Profile
                    </a> --}}

                  </div>
                  <form id="participantForm">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Cooperative Profile Information</h4>
                        </div>
                        <div class="card-body">
                            @if ($cooperative)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Cooperative Name:</td>
                                            <td>{{ $cooperative->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Cooperative ID:</td>
                                            <td>{{ $cooperative->coop_identification_no ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Type:</td>
                                            <td>{{ $cooperative->type ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Region:</td>
                                            <td>{{ $cooperative->region ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Address:</td>
                                            <td>{{ $cooperative->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Contact Person:</td>
                                            <td>{{ $cooperative->contact_person ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Phone Number:</td>
                                            <td>{{ $cooperative->phone_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Email:</td>
                                            <td>{{ $cooperative->email ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">TIN:</td>
                                            <td>{{ $cooperative->tin ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Chairperson of the Board:</td>
                                            <td>{{ $cooperative->bod_chairperson ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">General Manager/CEO:</td>
                                            <td>{{ $cooperative->general_manager_ceo ?? 'N/A' }}</td>
                                        </tr>

                                        <tr>
                                            <td class="fw-bold">Total Asset:</td>
                                            <td>{{ number_format($cooperative->total_asset, 2) ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total Income:</td>
                                            <td>{{ number_format($cooperative->total_income, 2) ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">CETF Remittance:</td>
                                            <td>{{ number_format($cooperative->cetf_remittance, 2) ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">CETF Required:</td>
                                            <td>{{ number_format($cooperative->cetf_required, 2) ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">CETF Balance:</td>
                                            <td>{{ number_format($cooperative->cetf_balance, 2) ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Share Capital Balance:</td>
                                            <td>{{ number_format($cooperative->share_capital_balance, 2) ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Number of Entitled Votes:</td>
                                            <td>{{ $cooperative->no_of_entitled_votes ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Membership Status:</td>
                                            <td>{{ optional($cooperative->gaRegistration)->membership_status ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Services Availed:</td>
                                            <td>{{ implode(', ', json_decode($cooperative->services_availed, true ?? 'N/A')) }}</td>
                                            {{-- <p>{{ implode(', ', json_decode($cooperative->services_availed, true)) }}</p> --}}
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">GA Registration Status:</td>
                                            <td>{{ optional($cooperative->gaRegistration)->registration_status ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted text-center">No cooperative profile available.</p>
                            @endif
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-label-info btn-round" type="button" onclick="window.location.href='{{ route('participantDashboard') }}'">
                                Back to Dashboard
                            </button>
                        </div>
                    </div>
                </form>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>

    </div>
  @include('layouts.links')
  </body>
</html>
