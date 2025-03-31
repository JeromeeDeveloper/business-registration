<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.adminheader')
</head>
<style>
    .doc {
        padding: 10px 25px;
    }
</style>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('supportDashboard') }}" class="logo">
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
                            <a href="{{ route('supportDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('supportview') }}">
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
                                        <a href="{{ route('support.participants.index') }}">
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
                                        <a href="{{ route('support.attendance.index') }}">
                                            <span class="sub-item">Manage attendance</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#user">
                                <i class="fas fa-user"></i>
                                <p>User</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="user">
                                <ul class="nav nav-collapse">
                                    <li>
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
                        </li> --}}

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
                        <a href="{{ route('supportDashboard') }}" class="logo">
                            <img class="logo-mass-specc" src="{{ asset('images/logo.png') }}" alt="">
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
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">

                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">

                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold" style="text-transform: capitalize;">
                                            {{ Auth::user()->name }}
                                        </span>

                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="u-text">
                                                    <h4> {{ Auth::user()->name }}</h4>
                                                    <p class="text-muted"> {{ Auth::user()->email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('profile.edit3') }}">My
                                                Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="#"
                                                onclick="document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Edit Cooperative</h3>
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
                                <a href="#">Edit</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Cooperative Edit Form</div>
                                </div>
                                <form action="{{ route('support.cooperatives.update', $coop->coop_id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Coop Name -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name">Cooperative Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" value="{{ $coop->name }}"
                                                        placeholder="Enter Cooperative Name" />
                                                </div>
                                            </div>

                                            <!-- Contact Person -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person"
                                                        id="contact_person" value="{{ $coop->contact_person }}"
                                                        placeholder="Enter Contact Person" />
                                                </div>
                                            </div>

                                            <!-- Cooperative Type -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="type">Cooperative Type</label>
                                                    <input type="text" class="form-control" name="type"
                                                        id="type" value="{{ $coop->type }}"
                                                        placeholder="Enter Cooperative Type" />
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input class="form-control" id="address" name="address"
                                                        value="{{ $coop->address }}" placeholder="Enter Address" />
                                                </div>
                                            </div>

                                            <!-- Region -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="region">Region</label>
                                                    <select class="form-control" name="region" id="region">
                                                        <option disabled>Select Region</option>
                                                        @foreach (['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST', 'LUZON'] as $region)
                                                            <option value="{{ $region }}"
                                                                {{ $coop->region == $region ? 'selected' : '' }}>
                                                                {{ $region }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <!-- Phone Number -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="number" class="form-control" name="phone_number"
                                                        id="phone_number" value="{{ $coop->phone_number }}"
                                                        placeholder="Enter Phone Number" />
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" id="email"
                                                        value="{{ old('email', $coop->email) }}"
                                                        placeholder="Enter Email" />

                                                    {{-- Show error only if the email is different from the cooperative's current email --}}
                                                    @if ($errors->has('email') && old('email') !== $coop->email)
                                                        <div class="alert alert-danger">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>



                                            <!-- TIN -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="tin">TIN</label>
                                                    <input type="text" class="form-control" name="tin"
                                                        id="tin" value="{{ $coop->tin }}"
                                                        placeholder="Enter TIN" />
                                                </div>
                                            </div>

                                            <!-- Coop Identification No -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="coop_identification_no">Cooperative ID</label>
                                                    <input type="text" class="form-control"
                                                        name="coop_identification_no" id="coop_identification_no"
                                                        value="{{ $coop->coop_identification_no }}"
                                                        placeholder="Enter Coop ID" />
                                                </div>
                                            </div>

                                            <!-- BOD Chairperson -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="bod_chairperson">BOD Chairperson</label>
                                                    <input type="text" class="form-control" name="bod_chairperson"
                                                        id="bod_chairperson" value="{{ $coop->bod_chairperson }}"
                                                        placeholder="Enter BOD Chairperson" />
                                                </div>
                                            </div>

                                            <!-- General Manager/CEO -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="general_manager_ceo">General Manager/CEO</label>
                                                    <input type="text" class="form-control"
                                                        name="general_manager_ceo" id="general_manager_ceo"
                                                        value="{{ $coop->general_manager_ceo }}"
                                                        placeholder="Enter Manager/CEO" />
                                                </div>
                                            </div>


                                        </div>

                                        <button class="btn btn-primary btn-round me-2" type="submit">Submit</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-12">
                                <div class="card doc">
                                    <form action="{{ route('cooperatives.storeDocuments3', $coop->coop_id) }}"
                                        method="POST" enctype="multipart/form-data" class=" p-1">
                                        @csrf
                                        <input type="hidden" name="form_key" value="form1">
                                        <h3 class="mb-4 text-center text-primary">Upload Documents for
                                            {{ $coop->name }}</h3>
                                        <div class="row">
                                            <!-- Financial Statement (Left Column) -->
                                            <div class="col-md-6 mb-4">
                                                <label for="documents[Financial Statement]" class="form-label">Audited
                                                    Financial
                                                    Statement</label>
                                                <input type="file" name="documents[Financial Statement]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'Financial Statement')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'Financial Statement')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>

                                            <!-- Resolution for Voting Delegates (Right Column) -->
                                            <div class="col-md-6 mb-4">
                                                <label for="documents[Resolution for Voting Delegates]"
                                                    class="form-label">Resolution
                                                    for Voting Delegates</label>
                                                <input type="file"
                                                    name="documents[Resolution for Voting Delegates]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'Resolution for Voting Delegates')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'Resolution for Voting Delegates')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Deposit Slip for Registration Fee (Left Column) -->
                                            <div class="col-md-6 mb-4">
                                                <label for="documents[Deposit Slip for Registration Fee]"
                                                    class="form-label">Deposit
                                                    Slip for Registration Fee</label>
                                                <input type="file"
                                                    name="documents[Deposit Slip for Registration Fee]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'Deposit Slip for Registration Fee')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'Deposit Slip for Registration Fee')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>

                                            <!-- Deposit Slip for CETF Remittance (Right Column) -->
                                            <div class="col-md-6 mb-4">
                                                <label for="documents[Deposit Slip for CETF Remittance]"
                                                    class="form-label">Deposit
                                                    Slip for CETF Remittance</label>
                                                <input type="file"
                                                    name="documents[Deposit Slip for CETF Remittance]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'Deposit Slip for CETF Remittance')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'Deposit Slip for CETF Remittance')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- CETF Undertaking (Left Column) -->
                                            <div class="col-md-6 mb-4">
                                                <label for="documents[CETF Undertaking]" class="form-label">CETF
                                                    Undertaking</label>
                                                <input type="file" name="documents[CETF Undertaking]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'CETF Undertaking')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'CETF Undertaking')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>


                                            <div class="col-md-6 mb-4">
                                                <label for="documents[Certificate of Candidacy]"
                                                    class="form-label">Certificate of
                                                    Candidacy</label>
                                                <input type="file" name="documents[Certificate of Candidacy]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'Certificate of Candidacy')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'Certificate of Candidacy')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- CETF Utilization Invoice (Left Column) -->
                                            <div class="col-md-6 mb-4">
                                                <label for="documents[CETF Utilization Invoice]"
                                                    class="form-label">CETF Utilization
                                                    Invoice</label>
                                                <input type="file" name="documents[CETF Utilization Invoice]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv"
                                                    class="form-control mb-2">
                                                @if ($coop->uploadedDocuments()->where('document_type', 'CETF Utilization Invoice')->exists())
                                                    <p class="text-info">Current File:
                                                        {{ $coop->uploadedDocuments()->where('document_type', 'CETF Utilization Invoice')->first()->file_name }}
                                                    </p>
                                                    <small class="form-text text-muted">You can upload a new file or
                                                        keep the existing
                                                        one.</small>
                                                @endif
                                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png,
                                                    pdf, xls, xlsx, csv (no file size limit).</small>


                                            </div>
                                        </div>

                                        <!-- Submit Button -->

                                        <div class="d-flex justify-content-start mt-4">
                                            <button type="submit" class="btn btn-primary btn-round me-2">Upload
                                                Documents</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- @include('layouts.adminfooter') --}}
    </div>

    </div>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '@foreach ($errors->all() as $error){{ $error }}@endforeach',
            });
        </script>
    @endif
    @if (session('form1_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: '{!! session('form1_success') !!}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cetfRequired = document.getElementById('cetf_required');
            let totalRemittance = document.getElementById('total_remittance');
            let cetfBalance = document.getElementById('cetf_balance');

            function updateCetfBalance() {
                let required = parseFloat(cetfRequired.value) || 0;
                let remitted = parseFloat(totalRemittance.value) || 0;
                let balance = (required - remitted).toFixed(2);

                cetfBalance.value = balance;
            }

            cetfRequired.addEventListener('input', updateCetfBalance);
            totalRemittance.addEventListener('input', updateCetfBalance);
            updateCetfBalance(); // Initialize on page load
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function calculateFees() {
                let regFee = parseFloat(document.getElementById('registration_fee').value) || 0;
                let numParticipants = parseInt(document.getElementById('num_participants').value) || 0;
                let preregPayment = parseFloat(document.getElementById('less_prereg_payment').value) || 0;
                let cetfBalance = parseFloat(document.getElementById('less_cetf_balance').value) || 0;

                // Total Registration Fee: (ALL participants counted, NO DEDUCTIONS)
                let totalRegFee = numParticipants * regFee;

                // Free participants logic (affects only Net Required Fee)
                let freeParticipants = 0;
                if (document.getElementById('free_2pax_migs').checked) {
                    freeParticipants += 2;
                }
                if (document.getElementById('free_migs_pax').checked) {
                    freeParticipants += 1;
                }
                if (document.getElementById('free_100k_cetf').checked) {
                    freeParticipants += 1;
                }

                // Paid participants (only for Net Required Fee)
                let paidParticipants = Math.max(numParticipants - freeParticipants, 0);

                // Net Required Registration Fee: Only Free Pax deduction applied
                let netRequiredRegFee = Math.max(0, paidParticipants * regFee);

                // Apply 50% discount on ONE participant if half_based_cetf is checked
                if (document.getElementById('half_based_cetf').checked && paidParticipants > 0) {
                    netRequiredRegFee -= regFee * 0.5;
                }

                // Ensure Net Required Fee doesn't go negative
                netRequiredRegFee = Math.max(0, netRequiredRegFee);

                // GA RegFee Payable: Apply Prereg Payment & CETF Utilization here
                let regFeePayable = Math.max(0, netRequiredRegFee - (preregPayment + cetfBalance));

                // Update Fields
                document.getElementById('total_reg_fee').value = totalRegFee.toFixed(2);
                document.getElementById('net_required_reg_fee').value = netRequiredRegFee.toFixed(2);
                document.getElementById('reg_fee_payable').value = regFeePayable.toFixed(2);
            }

            // Attach event listeners
            let fields = ['registration_fee', 'num_participants', 'less_prereg_payment', 'less_cetf_balance',
                'free_2pax_migs', 'free_migs_pax', 'free_100k_cetf', 'half_based_cetf'
            ];

            fields.forEach(id => {
                document.getElementById(id).addEventListener('input', calculateFees);
                document.getElementById(id).addEventListener('change', calculateFees);
            });

            // Run on page load
            calculateFees();
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cetfRemittance = document.getElementById('cetf_remittance');
            let additionalCetf = document.getElementById('additional_cetf');
            let cetfUndertaking = document.getElementById('cetf_undertaking');
            let totalRemittance = document.getElementById('total_remittance');
            let fullCetfRemitted = document.getElementById('full_cetf_remitted'); // Added
            let cetfRequired = document.getElementById('cetf_required'); // Added

            function calculateTotalRemittance() {
                let remittance = parseFloat(cetfRemittance.value) || 0;
                let additional = parseFloat(additionalCetf.value) || 0;
                let undertaking = parseFloat(cetfUndertaking.value) || 0;
                let total = (remittance + additional + undertaking).toFixed(2);

                totalRemittance.value = total;
                updateFullCetfRemitted(total); // Call function to update Full CETF Remitted
            }

            function updateFullCetfRemitted(total) {
                let required = parseFloat(cetfRequired.value) || 0;

                if (total == required) {
                    fullCetfRemitted.value = "yes";
                } else {
                    fullCetfRemitted.value = "no";
                }
            }

            cetfRemittance.addEventListener('input', calculateTotalRemittance);
            additionalCetf.addEventListener('input', calculateTotalRemittance);
            cetfUndertaking.addEventListener('input', calculateTotalRemittance);
            calculateTotalRemittance(); // Initialize on page load
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cetfDueToApexInput = document.getElementById('cetf_due_to_apex');
            let cetfRequiredInput = document.getElementById('cetf_required');

            function updateCetfRequired() {
                let dueToApex = parseFloat(cetfDueToApexInput.value) || 0;
                let cetfRequired = (dueToApex * 0.30).toFixed(2);

                cetfRequiredInput.value = cetfRequired;
            }

            cetfDueToApexInput.addEventListener('input', updateCetfRequired);
            updateCetfRequired(); // Initialize on page load
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButton = document.getElementById("servicesDropdown");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');
            const hiddenInput = document.getElementById("services_availed_json");

            // Prevent dropdown from closing when clicking inside
            dropdownMenu.addEventListener("click", function(event) {
                event.stopPropagation();
            });

            dropdownButton.addEventListener("click", function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle("show");
            });

            document.addEventListener("click", function(event) {
                if (!dropdownMenu.contains(event.target) && event.target !== dropdownButton) {
                    dropdownMenu.classList.remove("show");
                }
            });

            function updateDropdownText() {
                let selected = Array.from(checkboxes)
                    .filter(i => i.checked)
                    .map(i => i.value)
                    .join(", ");

                dropdownButton.innerText = selected ? selected : "Select Services";
                hiddenInput.value = JSON.stringify(selected.split(", ").filter(Boolean)); // Store as JSON
            }

            // Update on checkbox change
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateDropdownText);
            });

            // Load preselected values
            updateDropdownText();
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Handle the form submission using AJAX
        document.getElementById('coopForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = new FormData(this);

            // Send AJAX request to submit the form
            fetch("{{ route('admin.storeCooperative') }}", {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    // Check if the response contains a success message
                    if (data.success) {
                        // Display the success message using SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: data.success,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        });

                        // Optionally, you can reset the form here
                        document.getElementById('coopForm').reset();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while submitting the form.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                });
        });
    </script>
    @include('layouts.links')
</body>

</html>
