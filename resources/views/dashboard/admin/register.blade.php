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
                    <a href="{{ route('adminDashboard') }}" class="logo">
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
                            <a href="{{ route('adminDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('adminview') }}">
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
                                        <a href="{{ route('participants.index') }}">
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
                        <a href="{{ route('adminDashboard') }}" class="logo">
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
                        <h3 class="fw-bold mb-3">Cooperative Registration</h3>
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
                                <a href="#">Register</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Cooperative Registration Form</div>
                                </div>
                                <form id="coopForm" method="POST" action="{{ route('admin.storeCooperative') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Coop Name -->
                                            <!-- Cooperative Name -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name">Cooperative Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" placeholder="Enter Cooperative Name"
                                                        value="{{ old('name') }}" required />
                                                </div>
                                            </div>

                                            <!-- Contact Person -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person"
                                                        id="contact_person" placeholder="Enter Contact Person"
                                                        value="{{ old('contact_person') }}" required />
                                                </div>
                                            </div>

                                            <!-- Cooperative Type -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="type">Cooperative Type</label>
                                                    <input type="text" class="form-control" name="type"
                                                        id="type" placeholder="Enter Cooperative Type"
                                                        value="{{ old('type') }}" required />
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input class="form-control" id="address" name="address" rows="3" placeholder="Enter Address" required>{{ old('address') }}</input>
                                                </div>
                                            </div>

                                            <!-- Region -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="region">Region</label>
                                                    <select class="form-control" name="region" id="region"
                                                        required>
                                                        <option value="">Select Region</option>
                                                        @php $selectedRegion = old('region'); @endphp
                                                        <option value="Region I"
                                                            {{ $selectedRegion === 'Region I' ? 'selected' : '' }}>
                                                            Region I</option>
                                                        <option value="Region II"
                                                            {{ $selectedRegion === 'Region II' ? 'selected' : '' }}>
                                                            Region II</option>
                                                        <option value="Region III"
                                                            {{ $selectedRegion === 'Region III' ? 'selected' : '' }}>
                                                            Region III</option>
                                                        <option value="Region IV-A"
                                                            {{ $selectedRegion === 'Region IV-A' ? 'selected' : '' }}>
                                                            Region IV-A</option>
                                                        <option value="Region IV-B"
                                                            {{ $selectedRegion === 'Region IV-B' ? 'selected' : '' }}>
                                                            Region IV-B</option>
                                                        <option value="Region V"
                                                            {{ $selectedRegion === 'Region V' ? 'selected' : '' }}>
                                                            Region V</option>
                                                        <option value="Region VI"
                                                            {{ $selectedRegion === 'Region VI' ? 'selected' : '' }}>
                                                            Region VI</option>
                                                        <option value="Region VII"
                                                            {{ $selectedRegion === 'Region VII' ? 'selected' : '' }}>
                                                            Region VII</option>
                                                        <option value="Region VIII"
                                                            {{ $selectedRegion === 'Region VIII' ? 'selected' : '' }}>
                                                            Region VIII</option>
                                                        <option value="Region IX"
                                                            {{ $selectedRegion === 'Region IX' ? 'selected' : '' }}>
                                                            Region IX</option>
                                                        <option value="Region X"
                                                            {{ $selectedRegion === 'Region X' ? 'selected' : '' }}>
                                                            Region X</option>
                                                        <option value="Region XI"
                                                            {{ $selectedRegion === 'Region XI' ? 'selected' : '' }}>
                                                            Region XI</option>
                                                        <option value="Region XII"
                                                            {{ $selectedRegion === 'Region XII' ? 'selected' : '' }}>
                                                            Region XII</option>
                                                        <option value="Region XIII"
                                                            {{ $selectedRegion === 'Region XIII' ? 'selected' : '' }}>
                                                            Region XIII</option>
                                                        <option value="NCR"
                                                            {{ $selectedRegion === 'NCR' ? 'selected' : '' }}>National
                                                            Capital Region</option>
                                                        <option value="CAR"
                                                            {{ $selectedRegion === 'CAR' ? 'selected' : '' }}>
                                                            Cordillera Administrative Region</option>
                                                        <option value="BARMM"
                                                            {{ $selectedRegion === 'BARMM' ? 'selected' : '' }}>
                                                            Bangsamoro Autonomous Region</option>
                                                        <option value="ZBST"
                                                            {{ $selectedRegion === 'ZBST' ? 'selected' : '' }}>ZBST
                                                        </option>
                                                        <option value="LUZON"
                                                            {{ $selectedRegion === 'LUZON' ? 'selected' : '' }}>LUZON
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="number" class="form-control" name="phone_number"
                                                        id="phone_number" placeholder="Enter Phone Number"
                                                        value="{{ old('phone_number') }}" required />
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="email" placeholder="Enter Email"
                                                        value="{{ old('email') }}" required />
                                                </div>
                                            </div>
                                            <!-- TIN -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="tin">TIN</label>
                                                    <input type="text" class="form-control" name="tin"
                                                        id="tin" placeholder="Enter TIN"
                                                        value="{{ old('tin') }}" required />
                                                </div>
                                            </div>

                                            <!-- Coop Identification No -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="coop_identification_no">Cooperative ID</label>
                                                    <input type="text" class="form-control"
                                                        name="coop_identification_no" id="coop_identification_no"
                                                        placeholder="Enter Coop ID"
                                                        value="{{ old('coop_identification_no') }}" required />
                                                </div>
                                            </div>

                                            <!-- BOD Chairperson -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="bod_chairperson">BOD Chairperson</label>
                                                    <input type="text" class="form-control" name="bod_chairperson"
                                                        id="bod_chairperson" placeholder="Enter BOD Chairperson"
                                                        value="{{ old('bod_chairperson') }}" required />
                                                </div>
                                            </div>


                                            <!-- General Manager/CEO -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="general_manager_ceo">General Manager/CEO</label>
                                                    <input type="text" class="form-control"
                                                        name="general_manager_ceo" id="general_manager_ceo"
                                                        placeholder="Enter Manager/CEO"
                                                        value="{{ old('general_manager_ceo') }}" required />
                                                </div>
                                            </div>


                                            {{-- <div class="col-md-6 col-lg-4">

                                            </div> --}}

                                            <div class="col-12">
                                                <h4 class="mt-4">Verifier</h4>
                                                <hr>
                                            </div>

                                            <div class="container">
                                                <div class="row g-3">
                                                    <!-- Financial Information -->
                                                    <div class="col-md-4">
                                                        <fieldset class="border rounded p-3 shadow-sm h-100">
                                                            <legend class="h5 text-primary">MIGS / Voting Delegate
                                                                Requirements</legend>
                                                            <div class="form-group mb-3">
                                                                <label for="share_capital_balance"
                                                                    class="form-label fw-bold">Share Capital
                                                                    Balance</label>
                                                                <input type="number" class="form-control"
                                                                    name="share_capital_balance"
                                                                    id="share_capital_balance" step="0.01"
                                                                    placeholder="Enter Share Capital Balance" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_of_entitled_votes"
                                                                    class="form-label fw-bold">Number of Entitled
                                                                    Votes</label>
                                                                <input type="number" class="form-control"
                                                                    name="no_of_entitled_votes"
                                                                    id="no_of_entitled_votes"
                                                                    placeholder="Enter Number of Entitled Votes"
                                                                    disabled />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="loan_balance">Loan Balance</label>
                                                                <input type="number" class="form-control"
                                                                    name="loan_balance" id="loan_balance"
                                                                    step="0.01" placeholder="Enter Loan Overdue" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="total_overdue">Loan Overdue</label>
                                                                <input type="number" class="form-control"
                                                                    name="total_overdue" id="total_overdue"
                                                                    step="0.01" placeholder="Enter Loan Overdue" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="accounts_receivable">Accounts
                                                                    Receivable</label>
                                                                <input type="number" class="form-control"
                                                                    name="accounts_receivable"
                                                                    id="accounts_receivable" step="0.01"
                                                                    placeholder="Enter Accounts Receivable" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="savings">Savings</label>
                                                                <input type="number" class="form-control"
                                                                    name="savings" id="savings" step="0.01"
                                                                    placeholder="Enter Savings" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="time_deposit">Time Deposit</label>
                                                                <input type="number" class="form-control"
                                                                    name="time_deposit" id="time_deposit"
                                                                    step="0.01" placeholder="Enter Time Deposit" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="services_availed">Services Availed</label>
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-outline-secondary dropdown-toggle w-100 text-start"
                                                                        type="button" id="servicesDropdown"
                                                                        aria-expanded="false">
                                                                        Select Services
                                                                    </button>
                                                                    <ul class="dropdown-menu w-100" id="dropdownMenu">
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="CF">
                                                                                CF</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="IT">
                                                                                IT</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="MSU">
                                                                                MSU</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="ICS">
                                                                                ICS</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="MCU">
                                                                                MCU</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="ADMIN">
                                                                                ADMIN</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="GAD">
                                                                                GAD</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="YOUTH">
                                                                                YOUTH</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="SCOOPS">
                                                                                SCOOPS</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="YAKAP">
                                                                                YAKAP</label></li>
                                                                        <li><label class="dropdown-item"><input
                                                                                    type="checkbox"
                                                                                    name="services_availed[]"
                                                                                    value="AGRIBEST">
                                                                                AGRIBEST</label></li>
                                                                    </ul>
                                                                </div>
                                                                <input type="hidden" id="services_availed_json" name="services_availed_json">
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <!-- CETF Information -->
                                                    <div class="col-md-4">
                                                        <fieldset class="border rounded p-3 shadow-sm h-100">
                                                            <legend class="h5 text-success">CETF Requirement
                                                                Computation</legend>


                                                            <div class="form-group">
                                                                <label for="fs_status">FS(YES/NO)</label>
                                                                <select class="form-control" name="fs_status"
                                                                    id="fs_status">
                                                                    <option value="">Select Status</option>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no" selected>No</option>
                                                                    <!-- Set default value to "No" -->
                                                                </select>
                                                            </div>




                                                            <div class="form-group">
                                                                <label for="delinquent">Delinquent</label>
                                                                <select class="form-control" name="delinquent"
                                                                    id="delinquent">
                                                                    <option value="">Select Status</option>
                                                                    <option value="yes">Delinquent</option>
                                                                    <option value="no" selected>Non-Delinquent
                                                                    </option> <!-- Set default value to "No" -->
                                                                </select>
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="total_asset" class="form-label">Total
                                                                    Assets</label>
                                                                <input type="number" class="form-control"
                                                                    name="total_asset" id="total_asset"
                                                                    step="0.01" placeholder="Enter Total Assets" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="net_surplus">Net Surplus</label>
                                                                <input type="number" class="form-control"
                                                                    name="net_surplus" id="net_surplus"
                                                                    step="0.01" placeholder="Enter Net Surplus" />
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="cetf_due_to_apex"
                                                                    class="form-label fw-bold">CETF Due to Apex</label>
                                                                <input type="number" class="form-control"
                                                                    name="cetf_due_to_apex" id="cetf_due_to_apex"
                                                                    step="0.01"
                                                                    placeholder="Enter CETF Due to Apex" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cetf_required"
                                                                    class="form-label fw-bold">Required CETF</label>
                                                                <input type="number" class="form-control"
                                                                    name="cetf_required" id="cetf_required"
                                                                    placeholder="Auto-calculated CETF Required"
                                                                    readonly />
                                                                <input type="hidden" name="cetf_required_hidden"
                                                                    id="cetf_required_hidden" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="cetf_remittance">CETF Remittance</label>
                                                                <input type="number" class="form-control"
                                                                    name="cetf_remittance" id="cetf_remittance"
                                                                    step="0.01"
                                                                    placeholder="Enter CETF Remittance" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="additional_cetf"
                                                                    class="form-label fw-bold">Additional CETF</label>
                                                                <input type="number" class="form-control"
                                                                    name="additional_cetf" id="additional_cetf"
                                                                    step="0.01"
                                                                    placeholder="Enter Additional CETF" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cetf_undertaking"
                                                                    class="form-label fw-bold">CETF Undertaking</label>
                                                                <input type="number" class="form-control"
                                                                    name="cetf_undertaking" id="cetf_undertaking"
                                                                    step="0.01"
                                                                    placeholder="Enter CETF Undertaking" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="total_remittance"
                                                                    class="form-label fw-bold">Total Remittance</label>
                                                                <input type="number" class="form-control"
                                                                    name="total_remittance" id="total_remittance"
                                                                    placeholder="Auto-calculated Total Remittance"
                                                                    readonly />
                                                                <input step="0.01" type="hidden"
                                                                    name="total_remittance_hidden"
                                                                    id="total_remittance_hidden" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="full_cetf_remitted"
                                                                    class="form-label fw-bold">Full CETF
                                                                    Remitted</label>
                                                                <select class="form-control" name="full_cetf_remitted"
                                                                    id="full_cetf_remitted" readonly>
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                                <input type="hidden" name="full_cetf_remitted_hidden"
                                                                    id="full_cetf_remitted_hidden" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="cetf_balance"
                                                                    class="form-label fw-bold">CETF Balance</label>
                                                                <input type="number" class="form-control"
                                                                    name="cetf_balance" id="cetf_balance"
                                                                    step="0.01" placeholder="Enter CETF Balance" />
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <!-- Other Financial Details -->
                                                    <div class="col-md-4">
                                                        <fieldset class="border rounded p-3 shadow-sm h-100">
                                                            <legend class="h5 text-dark">Registration Fee</legend>

                                                            <div class="form-group">
                                                                <label for="registration_date_paid">Registration Date
                                                                    Paid</label>
                                                                <input type="date" class="form-control"
                                                                    name="registration_date_paid"
                                                                    id="registration_date_paid" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="registration_fee">Registration Fee</label>
                                                                <input type="number" class="form-control"
                                                                    name="registration_fee" id="registration_fee"
                                                                    placeholder="Enter Registration Fee"
                                                                    value="4500" readonly />
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="total_reg_fee">Total Registration
                                                                    Fee</label>
                                                                <input type="number" class="form-control"
                                                                    name="total_reg_fee" id="total_reg_fee"
                                                                    step="0.01"
                                                                    placeholder="Enter Total Registration Fee"
                                                                    readonly>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="net_required_reg_fee">Net Required Reg
                                                                    Fee</label>
                                                                <input type="number" class="form-control"
                                                                    name="net_required_reg_fee"
                                                                    id="net_required_reg_fee" step="0.01"
                                                                    placeholder="Enter Total Registration Fee">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="less_prereg_payment">Less: PreReg
                                                                    Payment</label>
                                                                <input type="number" class="form-control"
                                                                    name="less_prereg_payment"
                                                                    id="less_prereg_payment" step="0.01"
                                                                    placeholder="Enter PreReg Payment Deduction">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="less_cetf_balance">Less: CETF
                                                                    Utilization</label>
                                                                <input type="number" class="form-control"
                                                                    name="less_cetf_balance" id="less_cetf_balance"
                                                                    step="0.01"
                                                                    placeholder="Enter CETF Balance Deduction">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="reg_fee_payable">GA RegFee Payable</label>
                                                                <input type="number" class="form-control"
                                                                    name="reg_fee_payable" id="reg_fee_payable"
                                                                    step="0.01"
                                                                    placeholder="Enter GA RegFee Payable">
                                                            </div>




                                                            <div class="form-group">
                                                                <label for="ga_remark">Remark</label>
                                                                <input type="text" class="form-control"
                                                                    name="ga_remark" id="ga_remark"
                                                                    placeholder="Remark" />
                                                            </div>


                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="card-action">
                                            <button class="btn btn-label-info btn-round">Submit</button>
                                            <button type="button" class="btn btn-primary btn-round"
                                                onclick="window.location.href='{{ route('adminview') }}'">Back</button>
                                </form>
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
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownButton = document.getElementById("servicesDropdown");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');
            const hiddenInput = document.getElementById("services_availed_json");

            // Prevent dropdown from closing when clicking inside
            dropdownMenu.addEventListener("click", function (event) {
                event.stopPropagation();
            });

            // Toggle dropdown on button click
            dropdownButton.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle("show");
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function (event) {
                if (!dropdownMenu.contains(event.target) && event.target !== dropdownButton) {
                    dropdownMenu.classList.remove("show");
                }
            });

            // Update dropdown label and hidden input
            function updateDropdownText() {
                const selectedValues = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                dropdownButton.innerText = selectedValues.length
                    ? selectedValues.join(", ")
                    : "Select Services";

                hiddenInput.value = JSON.stringify(selectedValues); // JSON array
            }

            // Listen for checkbox changes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateDropdownText);
            });

            // Initialize on load
            updateDropdownText();
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton = document.getElementById("servicesDropdown");
        const dropdownMenu = document.getElementById("dropdownMenu");
        const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');
        const hiddenInput = document.getElementById("services_availed_json");


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


@if ($errors->any())
<script>
    console.error('Validation Errors:', @json($errors->all()));
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '@foreach ($errors->all() as $error){{ $error }}@endforeach',
    });
</script>
@endif
    @if ($errors->any())
        <script>
            console.error('Validation Errors:', @json($errors->all()));
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '@foreach ($errors->all() as $error){{ $error }}@endforeach',
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const shareCapitalInput = document.getElementById('share_capital_balance');
            const entitledVotesInput = document.getElementById('no_of_entitled_votes');

            // Function to calculate the number of entitled votes
            function calculateEntitledVotes(shareCapital) {
    let votes = 0;

    if (shareCapital >= 25000) {
        if (shareCapital >= 100000) {
            votes = Math.floor(shareCapital / 100000); // Each ₱100,000 = 1 vote
            const remaining = shareCapital % 100000;

            if (remaining >= 25000) {
                votes += 1; // Additional vote for ₱25k+ remainder
            }
        } else {
            votes = 1; // ₱25,000 to ₱99,999 = 1 vote
        }
    }

    return Math.min(votes, 5); // Cap votes at 5
}


            // Update entitled votes
            function updateEntitledVotes() {
                const shareCapital = parseFloat(shareCapitalInput.value) || 0;
                const entitledVotes = calculateEntitledVotes(shareCapital);
                entitledVotesInput.value = entitledVotes;
            }

            // Initial calculation
            updateEntitledVotes();

            // Listen for input changes
            shareCapitalInput.addEventListener('input', updateEntitledVotes);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {


            let cetfRequired = document.getElementById('cetf_required');
            let totalRemittance = document.getElementById('total_remittance');
            let cetfBalance = document.getElementById('cetf_balance');

            function updateCetfBalance() {
                let required = parseFloat(cetfRequired?.value) || 0;
                let remitted = parseFloat(totalRemittance?.value) || 0;
                let balance = (required - remitted).toFixed(2);
                cetfBalance.value = balance;


            }

            cetfRequired?.addEventListener('input', updateCetfBalance);
            totalRemittance?.addEventListener('input', updateCetfBalance);
            updateCetfBalance();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateRegFeePayable() {
                let netRequired = parseFloat(document.getElementById('net_required_reg_fee')?.value) || 0;
                let lessPreReg = parseFloat(document.getElementById('less_prereg_payment')?.value) || 0;
                let lessCetf = parseFloat(document.getElementById('less_cetf_balance')?.value) || 0;

                let regFeePayable = netRequired - (lessPreReg + lessCetf);
                document.getElementById('reg_fee_payable').value = regFeePayable.toFixed(2);


            }

            ['net_required_reg_fee', 'less_prereg_payment', 'less_cetf_balance'].forEach(id => {
                document.getElementById(id)?.addEventListener('input', updateRegFeePayable);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButton = document.getElementById("servicesDropdown");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');
            const hiddenInput = document.getElementById("services_availed_json");


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

    <script>
        document.addEventListener("DOMContentLoaded", function() {


            let cetfRemittance = document.getElementById('cetf_remittance');
            let additionalCetf = document.getElementById('additional_cetf');
            let cetfUndertaking = document.getElementById('cetf_undertaking');
            let totalRemittance = document.getElementById('total_remittance');
            let totalRemittanceHidden = document.getElementById('total_remittance_hidden');
            let fullCetfRemitted = document.getElementById('full_cetf_remitted');

            let cetfDueToApexInput = document.getElementById('cetf_due_to_apex');
            let cetfRequiredInput = document.getElementById('cetf_required');
            let cetfRequiredHidden = document.getElementById('cetf_required_hidden');

            function updateCetfRequired() {
                let dueToApex = parseFloat(cetfDueToApexInput?.value) || 0;
                let cetfRequired = (dueToApex * 0.30).toFixed(2);

                if (cetfRequiredInput) cetfRequiredInput.value = cetfRequired;
                if (cetfRequiredHidden) cetfRequiredHidden.value = cetfRequired;


            }

            function updateTotalRemittance() {
                let cetf = parseFloat(cetfRemittance?.value) || 0;
                let additional = parseFloat(additionalCetf?.value) || 0;
                let undertaking = parseFloat(cetfUndertaking?.value) || 0;
                let total = (cetf + additional + undertaking).toFixed(2);

                if (totalRemittance) totalRemittance.value = total;
                if (totalRemittanceHidden) totalRemittanceHidden.value = total;


                updateFullCetfRemitted();
            }

            function updateFullCetfRemitted() {
                let total = parseFloat(totalRemittance?.value) || 0;
                let required = parseFloat(cetfRequiredHidden?.value) || 0;

                fullCetfRemitted.value = total === required ? "yes" : "no";

            }

            [cetfRemittance, additionalCetf, cetfUndertaking].forEach(input => input?.addEventListener('input',
                updateTotalRemittance));
            cetfDueToApexInput?.addEventListener('input', updateCetfRequired);

            updateCetfRequired();
            updateTotalRemittance();
        });
    </script>

    <script>
  document.getElementById('coopForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch("{{ route('admin.storeCooperative') }}", {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.text().then(text => {
        console.log("🔍 Full Server Response:", text); // ✅ Log full response
        try {
            return { json: JSON.parse(text), response }; // ✅ Parse JSON safely
        } catch (error) {
            throw new Error(`Invalid JSON Response: ${text}`); // ✅ Handle invalid JSON errors
        }
    }))
    .then(({ json, response }) => {
        if (!response.ok) {
            if (response.status === 422 && json.errors) {
                let errorMessages = Object.entries(json.errors)
                    .map(([field, messages]) => `${field}: ${messages.join(', ')}`)
                    .join('\n');

                Swal.fire({
                    title: 'Validation Error!',
                    html: `<pre>${errorMessages}</pre>`, // ✅ Displays errors in a readable format
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
                return;
            }

            throw new Error(json.message || `Error ${response.status}: ${response.statusText}`);
        }

        Swal.fire({
            title: 'Success!',
            text: json.success || "Cooperative registered successfully.",
            icon: 'success',
            confirmButtonText: 'Okay'
        });
        document.getElementById('coopForm').reset();
    })
    .catch(error => {
        console.error("❌ Error:", error);

        Swal.fire({
            title: 'Error!',
            html: `
                <strong>Message:</strong> ${error.message} <br>
                <strong>Possible Cause:</strong> ${error.message.includes('<!DOCTYPE') ? "Server returned an HTML page instead of JSON. Check Laravel logs." : "Unknown issue"}
            `,
            icon: 'error',
            confirmButtonText: 'Debug'
        });
    });
});

    </script>

    @include('layouts.links')
</body>

</html>
