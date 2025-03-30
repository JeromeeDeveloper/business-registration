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
                        <li class="active">
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
                            <a href="{{'events.index'}}">
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
                  <a href="#">Cooperative</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                  </li>
                  <li class="nav-item">
                    <a href="#">Documents</a>
                  </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="cooperative_doc_titles">
                    <div class="card-title">Uploaded Documents</div>
                    <button type="button" class="btn btn-label-info btn-round me-2" onclick="window.location.href='{{ route('adminview') }}'">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                @if($documents->isEmpty())
                    <div class="text-center py-5">No documents uploaded yet.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Document Type</th>
                                    <th>File Name</th>
                                    <th>View</th>
                                    <th>Download</th>
                                    <th>Status</th> <!-- Add this -->
                                    <th>Remarks</th>
                                    <th>Action</th> <!-- Add this -->
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
                                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $document->file_path) }}" download class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                        <!-- Status Dropdown -->
                                        <td>
                                            <form action="{{ route('admin.documents.updateStatus', $document->document_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm">
                                                    <option value="Pending" {{ $document->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Approved" {{ $document->status == 'Approved' ? 'selected' : '' }}>Accepted</option>
                                                    <option value="Rejected" {{ $document->status == 'Rejected' ? 'selected' : '' }}>Decline</option>
                                                </select>
                                        </td>
                                        <td>
                                            <input type="text" name="remarks" class="form-control form-control-sm"
                                                   placeholder="Enter remarks (optional)" value="{{ $document->remarks ?? '' }}">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                                            </form>
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
       
          

        @include('layouts.adminfooter')
      </div>

    </div>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

  @include('layouts.links')
  </body>
</html>
