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
              <h3 class="fw-bold mb-3">Import Data</h3>
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
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                  </li>
                  <li class="nav-item">
                    <a href="#">Import</a>
                  </li>
              </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Import Cooperatives</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose Excel File</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" required>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-label-info btn-round me-2">Upload</button>
                        </form>

                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif


                      <!-- Sample Excel Format -->
                      <div class="mt-5">
                        <h6 class="fw-bold mb-3">📄 Sample Excel Format</h6>
                        <p class="text-muted">⚠️ <strong>Note:</strong> Make sure your data starts on <strong>Row 1</strong>.</p>
                        <p class="text-muted">✅ <strong>Allowed Regions:</strong> Region I, Region II, Region III, Region IV-A, Region IV-B, Region V, Region VI, Region VII, Region VIII, Region IX, Region X, Region XI, Region XII, Region XIII, NCR, CAR, BARMM, LUZON, Visayas, Mindanao, ZBST</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Column A<br><small>(Email)</small></th>
                                        <th>Column B<br><small>(Coop ID No.)</small></th>
                                        <th>Column C</th>
                                        <th>Column D<br><small>(Name)</small></th>
                                        <th>Column E<br><small>(Region)</small></th>
                                        <th>Column F<br><small>(Share Capital)</small></th>
                                        <th>Column G<br><small>(Savings 1)</small></th>
                                        <th>Column H<br><small>(Savings 2)</small></th>
                                        <th>Column I<br><small>(Savings 3)</small></th>
                                        <th>Column J<br><small>(Time Deposit)</small></th>
                                        <th>Column K<br><small>(Loan Receivable)</small></th>
                                        <th>Column L<br><small>(Accounts Receivable)</small></th>
                                        <th>Column M</th>
                                        <th>Column N<br><small>(CETF Remittance)</small></th>
                                        <th>Column O<br><small>(Services Availed)</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>abc@example.com</td>
                                        <td>123456</td>
                                        <td></td>
                                        <td>ABC Cooperative</td>
                                        <td>Region IV-A</td>
                                        <td>500,000</td>
                                        <td>200,000</td>
                                        <td>150,000</td>
                                        <td>50,000</td>
                                        <td>300,000</td>
                                        <td>400,000</td>
                                        <td>100,000</td>
                                        <td></td>
                                        <td>20,000</td>
                                        <td>CF, IT, MSU</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                      <!-- Back Button -->
                      <button class="btn btn-primary btn-round mt-4" onclick="window.history.back();">Back</button>
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
