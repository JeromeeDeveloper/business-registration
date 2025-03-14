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
                                <form action="{{ route('cooperatives.update', $coop->coop_id) }}" method="POST">
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
                                                        @foreach (['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'] as $region)
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


                                            <!-- Number of Entitled Votes -->
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="no_of_entitled_votes">No of Entitled Votes</label>
                                                    <input type="number" class="form-control"
                                                        name="no_of_entitled_votes" id="no_of_entitled_votes"
                                                        value="{{ $coop->no_of_entitled_votes }}"
                                                        placeholder="Enter No of Entitled Votes" />
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="total_income">Total Income</label>
                                                    <input type="number" class="form-control"
                                                        name="total_income" id="total_income"
                                                        value="{{ $coop->total_income }}"
                                                        placeholder="Enter Total Income">
                                                </div>
                                            </div> --}}



                                            <div class="col-12">
                                                <h4 class="mt-4">Verifier</h4>
                                                <hr>
                                            </div>



                                            <!-- First Column: MIGS/ Voting Delegate Requirements -->
                                            <div class="col-lg-4">
                                                <div class="card shadow-sm p-3">
                                                    <h5 class="text-primary">MIGS / Voting Delegate Requirements</h5>
                                                    <hr>

                                                    <div class="form-group">
                                                        <label for="share_capital_balance">Share Capital</label>
                                                        <input type="number" class="form-control"
                                                            name="share_capital_balance" id="share_capital_balance"
                                                            value="{{ $coop->share_capital_balance }}"
                                                            placeholder="Enter Share Capital">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_of_entitled_votes">Complied SC Req. / # Voting
                                                            Delegate</label>
                                                        <input type="text" class="form-control"
                                                            name="no_of_entitled_votes" id="no_of_entitled_votes"
                                                            value="{{ $coop->no_of_entitled_votes ?? '' }}"
                                                            placeholder="Enter Complied SC Req." disabled>
                                                    </div>



                                                    <div class="form-group">
                                                        <label for="loan_balance">Loan Balance</label>
                                                        <input type="number" class="form-control"
                                                            name="loan_balance" id="loan_balance"
                                                            value="{{ $coop->loan_balance }}"
                                                            placeholder="Enter Loan Balance">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="total_overdue">Loan Overdue</label>
                                                        <input type="number" class="form-control"
                                                            name="total_overdue" id="total_overdue"
                                                            value="{{ $coop->total_overdue }}"
                                                            placeholder="Enter Loan Overdue">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="time_deposit">Time Deposit</label>
                                                        <input type="number" class="form-control"
                                                            name="time_deposit" id="time_deposit"
                                                            value="{{ $coop->time_deposit }}"
                                                            placeholder="Enter Time Deposit">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="accounts_receivable">Accounts Receivable</label>
                                                        <input type="number" class="form-control"
                                                            name="accounts_receivable" id="accounts_receivable"
                                                            value="{{ $coop->accounts_receivable }}"
                                                            placeholder="Enter Accounts Receivable">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="savings">Savings</label>
                                                        <input type="number" class="form-control" name="savings"
                                                            id="savings" value="{{ $coop->savings }}"
                                                            placeholder="Enter Savings">
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
                                                            <ul class="dropdown-menu w-100 p-2" id="dropdownMenu">
                                                                @php
                                                                    // Decode JSON array properly
                                                                    $selectedServices =
                                                                        json_decode($coop->services_availed, true) ??
                                                                        [];
                                                                @endphp

                                                                @foreach (['CF', 'IT', 'MSU', 'ICS', 'MCU', 'ADMIN', 'GAD', 'YOUTH', 'SCOOPS', 'YAKAP', 'AGRIBEST'] as $service)
                                                                    <li>
                                                                        <label class="dropdown-item">
                                                                            <input type="checkbox"
                                                                                class="service-checkbox"
                                                                                name="services_availed[]"
                                                                                value="{{ $service }}"
                                                                                {{ in_array($service, $selectedServices) ? 'checked' : '' }}>
                                                                            {{ $service }}
                                                                        </label>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <input type="hidden" name="services_availed_json"
                                                            id="services_availed_json"
                                                            value="{{ json_encode($selectedServices) }}">
                                                    </div>


                                                    <!-- Other Requirement Checklist -->
                                                    {{-- <h6 class="mt-3 text-secondary">Other Requirement Checklist:</h6>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="board_resolution" id="board_resolution">
                                                        <label class="form-check-label" for="board_resolution">Board Resolution Voting Delegate</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="list_officers" id="list_officers">
                                                        <label class="form-check-label" for="list_officers">List of Officers</label>
                                                    </div> --}}
                                                </div>
                                            </div>


                                            <!-- Second Column: CETF Requirement Computation -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card shadow-sm p-3">
                                                    <h5 class="text-primary">CETF Requirement Computation</h5>
                                                    <hr>

                                                    <div class="form-group">
                                                        <label for="fs_status">FS (Yes/No)</label>
                                                        <select class="form-control" name="fs_status" id="fs_status">
                                                            <option value="yes" {{ $hasFinancialStatement ? 'selected' : '' }}>Yes</option>
                                                            <option value="no" {{ !$hasFinancialStatement ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="total_asset">Total Assets</label>
                                                        <input type="number" class="form-control" name="total_asset"
                                                            id="total_asset" value="{{ $coop->total_asset }}"
                                                            placeholder="Enter Total Asset">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="net_surplus">Net Surplus</label>
                                                        <input type="number" class="form-control" name="net_surplus"
                                                            id="net_surplus" value="{{ $coop->net_surplus }}"
                                                            placeholder="Enter Net Surplus">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cetf_due_to_apex">CETF Due to Apex</label>
                                                        <input type="number" class="form-control"
                                                            name="cetf_due_to_apex" id="cetf_due_to_apex"
                                                            value="{{ $coop->cetf_due_to_apex }}"
                                                            placeholder="Enter CETF Due to Apex">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cetf_required">Required CETF</label>
                                                        <input type="number" class="form-control"
                                                            name="cetf_required" id="cetf_required"
                                                            id="cetf_required" value="{{ $coop->cetf_required }}"
                                                            placeholder="Enter Required CETF" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cetf_remittance">CETF Remittance</label>
                                                        <input type="number" class="form-control"
                                                            name="cetf_remittance" id="cetf_remittance"
                                                            id="cetf_remittance" value="{{ $coop->cetf_remittance }}"
                                                            placeholder="Enter CETF Remittance">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="additional_cetf">Additional CETF</label>
                                                        <input type="number" class="form-control"
                                                            name="additional_cetf" id="additional_cetf"
                                                            id="cetf_remittance" value="{{ $coop->additional_cetf }}"
                                                            placeholder="Enter Additional CETF">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cetf_undertaking">CETF Undertaking</label>
                                                        <input type="text" class="form-control"
                                                            name="cetf_undertaking" id="cetf_undertaking"
                                                            id="cetf_undertaking"
                                                            value="{{ $coop->cetf_undertaking }}"
                                                            placeholder="Enter CETF Undertaking">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="total_remittance">Total Remittance</label>
                                                        <input type="number" class="form-control"
                                                            name="total_remittance" id="total_remittance"
                                                            id="total_remittance"
                                                            value="{{ $coop->total_remittance }}"
                                                            placeholder="Enter Total Remittance" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="full_cetf_remitted">Full CETF Remitted</label>
                                                        <select class="form-control" name="full_cetf_remitted"
                                                            id="full_cetf_remitted" readonly>
                                                            <option value="yes"
                                                                {{ $coop->full_cetf_remitted == 'yes' ? 'selected' : '' }}>
                                                                Yes</option>
                                                            <option value="no"
                                                                {{ $coop->full_cetf_remitted == 'no' ? 'selected' : '' }}>
                                                                No</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cetf_balance">CETF Balance</label>
                                                        <input type="number" class="form-control"
                                                            name="cetf_balance" id="cetf_balance"
                                                            value="{{ $coop->cetf_balance }}"
                                                            placeholder="CETF Balance" readonly>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="card shadow-sm p-3">
                                                    <h5 class="text-primary">Registration Fee
                                                    </h5>
                                                    <hr>

                                                    <div class="form-group">
                                                        <label for="registration_date_paid">Registration Date
                                                            [Paid]</label>
                                                        <input type="date" class="form-control"
                                                            name="registration_date_paid" id="registration_date_paid"
                                                            value="{{ $coop->registration_date_paid }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="registration_fee">Registration Fee</label>
                                                        <input type="number" class="form-control"
                                                            name="registration_fee" id="registration_fee"
                                                            value="{{ $coop->registration_fee }}"
                                                            placeholder="Enter Registration Fee" readonly>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="num_participants"># of Participants</label>
                                                        <input type="number" class="form-control"
                                                            name="num_participants" id="num_participants"
                                                            value="{{ $coop->participants()->count() }}"
                                                            placeholder="Enter # of Participants" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="total_reg_fee">Total Registration Fee</label>
                                                        <input type="number" class="form-control"
                                                            name="total_reg_fee" id="total_reg_fee"
                                                            value="{{ $coop->total_reg_fee }}"
                                                            placeholder="Enter Total Registration Fee" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Checklist:</label>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="free_2pax_migs" id="free_2pax_migs"
                                                                value="1"
                                                                {{ $hasMigsRegistration ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="free_2pax_migs">Free
                                                                2 Pax for MIGS</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="free_migs_pax" id="free_migs_pax"
                                                                value="1" {{ $hasMspOfficer ? 'checked' : '' }}
                                                                readonly>
                                                            <label class="form-check-label" for="free_migs_pax">1 Pax
                                                                Free Officer</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="free_100k_cetf" id="free_100k_cetf"
                                                                value="1" {{ $free100kCETF ? 'checked' : '' }}
                                                                readonly>
                                                            <label class="form-check-label" for="free_100k_cetf">1 Pax
                                                                Free 100K CETF</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="half_based_cetf" id="half_based_cetf"
                                                                value="1" {{ $halfBasedCETF ? 'checked' : '' }}
                                                                readonly>
                                                            <label class="form-check-label" for="half_based_cetf">1/2
                                                                Based on CETF</label>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="net_required_regfee">Net Required RegFee</label>
                                                        <input type="number" class="form-control"
                                                            name="net_required_reg_fee" id="net_required_reg_fee"
                                                            value="{{ $coop->net_required_reg_fee }}"
                                                            placeholder="Enter Net Required RegFee" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="less_prereg_payment">Less: PreReg Payment</label>
                                                        <input type="number" class="form-control"
                                                            name="less_prereg_payment" id="less_prereg_payment"
                                                            value="{{ $coop->less_prereg_payment }}"
                                                            placeholder="Enter PreReg Payment Deduction">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="less_cetf_balance">Less: CETF Utilization</label>
                                                        <input type="number" class="form-control"
                                                            name="less_cetf_balance" id="less_cetf_balance"
                                                            value="{{ $coop->less_cetf_balance }}"
                                                            placeholder="Enter CETF Balance Deduction">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="reg_fee_payable">GA RegFee Payable</label>
                                                        <input type="number" class="form-control"
                                                            name="reg_fee_payable" id="reg_fee_payable"
                                                            value="{{ $coop->reg_fee_payable }}"
                                                            placeholder="Enter GA RegFee Payable" readonly>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="ga_remark">GA Remark</label>
                                                        <input type="text" class="form-control" name="ga_remark"
                                                            id="ga_remark" value="{{ $coop->ga_remark }}"
                                                            placeholder="GA Remark" />
                                                    </div>
                                                </div>
                                            </div>





                                        </div>
                                    </div>

                                    <div class="card-action">
                                        <button class="btn btn-label-info btn-round me-2"
                                            type="submit">Submit</button>
                                        <button type="button" class="btn btn-primary btn-round"
                                            onclick="window.location.href='{{ route('adminview') }}'">Back</button>
                                    </div>
                                </form>

                            </div>




                        </div>


                    </div>

                    <form action="{{ route('cooperatives.storeDocuments2', $coop->coop_id) }}" method="POST"
                        enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-light">
                        @csrf
                        <input type="hidden" name="form_key" value="form1">
                        <h3 class="mb-4 text-center text-primary">Upload & Edit Documents for {{ $coop->name }}</h3>

                        <div class="row">
                            <!-- Financial Statement (Left Column) -->
                            <div class="col-md-6 mb-4">
                                <label for="documents[Financial Statement]" class="form-label">Audited Financial
                                    Statement</label>
                                <input type="file" name="documents[Financial Statement]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'Financial Statement')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'Financial Statement')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>

                            <!-- Resolution for Voting Delegates (Right Column) -->
                            <div class="col-md-6 mb-4">
                                <label for="documents[Resolution for Voting Delegates]" class="form-label">Resolution
                                    for Voting Delegates</label>
                                <input type="file" name="documents[Resolution for Voting Delegates]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'Resolution for Voting Delegates')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'Resolution for Voting Delegates')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Deposit Slip for Registration Fee (Left Column) -->
                            <div class="col-md-6 mb-4">
                                <label for="documents[Deposit Slip for Registration Fee]" class="form-label">Deposit
                                    Slip for Registration Fee</label>
                                <input type="file" name="documents[Deposit Slip for Registration Fee]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'Deposit Slip for Registration Fee')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'Deposit Slip for Registration Fee')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>

                            <!-- Deposit Slip for CETF Remittance (Right Column) -->
                            <div class="col-md-6 mb-4">
                                <label for="documents[Deposit Slip for CETF Remittance]" class="form-label">Deposit
                                    Slip for CETF Remittance</label>
                                <input type="file" name="documents[Deposit Slip for CETF Remittance]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'Deposit Slip for CETF Remittance')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'Deposit Slip for CETF Remittance')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>
                        </div>

                        <div class="row">
                            <!-- CETF Undertaking (Left Column) -->
                            <div class="col-md-6 mb-4">
                                <label for="documents[CETF Undertaking]" class="form-label">CETF Undertaking</label>
                                <input type="file" name="documents[CETF Undertaking]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'CETF Undertaking')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'CETF Undertaking')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>


                            <div class="col-md-6 mb-4">
                                <label for="documents[Certificate of Candidacy]" class="form-label">Certificate of
                                    Candidacy</label>
                                <input type="file" name="documents[Certificate of Candidacy]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'Certificate of Candidacy')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'Certificate of Candidacy')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>
                        </div>

                        <div class="row">
                            <!-- CETF Utilization Invoice (Left Column) -->
                            <div class="col-md-6 mb-4">
                                <label for="documents[CETF Utilization Invoice]" class="form-label">CETF Utilization
                                    Invoice</label>
                                <input type="file" name="documents[CETF Utilization Invoice]"
                                    accept=".jpg,.jpeg,.png,.pdf" class="form-control mb-2">
                                @if ($coop->uploadedDocuments()->where('document_type', 'CETF Utilization Invoice')->exists())
                                    <p class="text-info">Current File:
                                        {{ $coop->uploadedDocuments()->where('document_type', 'CETF Utilization Invoice')->first()->file_name }}
                                    </p>
                                    <small class="form-text text-muted">You can upload a new file or keep the existing
                                        one.</small>
                                @endif
                                <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, pdf (max
                                    5MB).</small>
                            </div>
                        </div>

                        <!-- Submit Button -->

                        <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn btn-label-info btn-round me-2">Upload Documents</button>
                        </div>
                    </form>


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
