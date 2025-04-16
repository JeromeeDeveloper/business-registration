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
                    <a href="{{ route('participantDashboard') }}" class="logo">
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
                            <a href="{{ route('participantDashboard') }}" class="collapsed">
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
                                        <a href="{{ route('speakerlist') }}">
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
                                        <a href="{{ route('schedule') }}">
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
                        <a href="{{ route('participantDashboard') }}" class="logo">
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
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Cooperative Profile</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header alignment">

                                    <!-- Edit Button to Trigger Modal -->
                                    <button type="button" class="btn btn-warning btn-round me-2" data-bs-toggle="modal"
                                        data-bs-target="#editCooperativeModal">
                                        Edit Cooperative Profile
                                    </button>

                                    <!-- Edit Cooperative Modal -->
                                    <div class="modal fade" id="editCooperativeModal" tabindex="-1"
                                        aria-labelledby="editCooperativeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCooperativeModalLabel">Edit
                                                        Cooperative Profile</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ route('cooperativeprofile.update', $cooperative->coop_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="name" class="form-label">Cooperative
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="name" name="name"
                                                                    value="{{ $cooperative->name }}" required readonly>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="contact_person" class="form-label">Contact
                                                                    Person</label>
                                                                <input type="text" class="form-control"
                                                                    id="contact_person" name="contact_person"
                                                                    value="{{ $cooperative->contact_person }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="type" class="form-label">Type</label>
                                                                <input type="text" class="form-control"
                                                                    id="type" name="type"
                                                                    value="{{ $cooperative->type }}" required
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="address"
                                                                    class="form-label">Address</label>
                                                                <input type="text" class="form-control"
                                                                    id="address" name="address"
                                                                    value="{{ $cooperative->address }}">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <div class="form-group">
                                                                    <label for="region">Region</label>
                                                                    <select class="form-control" id="region"
                                                                        disabled>
                                                                        <option disabled>Select Region</option>
                                                                        @foreach (['Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'] as $region)
                                                                            <option value="{{ $region }}"
                                                                                {{ $cooperative->region == $region ? 'selected' : '' }}>
                                                                                {{ $region }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <!-- Hidden input to retain the value -->
                                                                    <input type="hidden" name="region"
                                                                        value="{{ $cooperative->region }}">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="general_manager_ceo"
                                                                    class="form-label">General Manager CEO</label>
                                                                <input type="text" class="form-control"
                                                                    id="general_manager_ceo"
                                                                    name="general_manager_ceo"
                                                                    value="{{ $cooperative->general_manager_ceo }}"
                                                                    placeholder="Enter General Manager CEO">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    id="email" name="email"
                                                                    value="{{ $cooperative->email }}" readonly>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="phone_number" class="form-label">Phone
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="phone_number" name="phone_number"
                                                                    value="{{ $cooperative->phone_number }}"
                                                                    placeholder="Enter Phone Number">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="bod_chairperson" class="form-label">BOD
                                                                    Chairperson</label>
                                                                <input type="text" class="form-control"
                                                                    id="bod_chairperson" name="bod_chairperson"
                                                                    value="{{ $cooperative->bod_chairperson }}"
                                                                    placeholder="Enter BOD Chairperson">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="tin" class="form-label">TIN</label>
                                                                <input type="text" class="form-control"
                                                                    id="tin" name="tin"
                                                                    value="{{ $cooperative->tin }}"
                                                                    placeholder="Enter TIN">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="coop_identification_no"
                                                                    class="form-label">Coop Identification
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="coop_identification_no"
                                                                    name="coop_identification_no"
                                                                    value="{{ $cooperative->coop_identification_no }}"
                                                                    readonly>
                                                            </div>
                                                            {{-- <div class="col-md-4 mb-3">
                            <label for="total_asset" class="form-label">Total Asset</label>
                            <input type="text" class="form-control" id="total_asset" name="total_asset" value="{{ $cooperative->total_asset }}" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="cetf_remittance" class="form-label">CETF Remittance</label>
                            <input type="text" class="form-control" id="cetf_remittance" name="cetf_remittance" value="{{ $cooperative->cetf_remittance }}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cetf_required" class="form-label">CETF Required</label>
                            <input type="text" class="form-control" id="cetf_required" name="cetf_required" value="{{ $cooperative->cetf_required }}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cetf_balance" class="form-label">CETF Balance</label>
                            <input type="text" class="form-control" id="cetf_balance" name="cetf_balance" value="{{ $cooperative->cetf_balance }}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="share_capital_balance" class="form-label">Share Capital Balance</label>
                            <input type="text" class="form-control" id="share_capital_balance" name="share_capital_balance" value="{{ $cooperative->share_capital_balance }}" readonly>
                        </div> --}}
                                                            {{-- <div class="col-md-4 mb-3">
                                                                <label for="no_of_entitled_votes"
                                                                    class="form-label">No of Entitled Votes</label>
                                                                <input type="text" class="form-control"
                                                                    id="no_of_entitled_votes"
                                                                    name="no_of_entitled_votes"
                                                                    value="{{ $cooperative->no_of_entitled_votes }}"
                                                                    readonly>
                                                            </div> --}}
                                                            {{-- <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label for="services_availed">Services
                                                                        Availed</label>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-outline-secondary dropdown-toggle w-100 text-start"
                                                                            type="button" id="servicesDropdown"
                                                                            aria-expanded="false">
                                                                            Select Services
                                                                        </button>
                                                                        <ul class="dropdown-menu w-100 p-2"
                                                                            id="dropdownMenu">
                                                                            @php
                                                                                $selectedServices =
                                                                                    json_decode(
                                                                                        $cooperative->services_availed,
                                                                                        true,
                                                                                    ) ?? [];
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
                                                                        value="{{ $cooperative->services_availed }}">
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary btn-round"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn-label-info btn-round">Save Changes</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>


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
                                                            <td>{{ $cooperative->coop_identification_no ?? 'N/A' }}
                                                            </td>
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
                                                            <td>{{ $cooperative->phone_number === '0' ? 'N/A' : $cooperative->phone_number ?? 'N/A' }}
                                                            </td>

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
                                                            <td class="fw-bold">Audtied Financial Statement Status:
                                                            </td>
                                                            <td>{{ $cooperative->fs_status ?? 'N/A' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Delinquent:</td>
                                                            <td>{{ $cooperative->delinquent ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Number of Participants:</td>
                                                            <td id="num_participants">
                                                                {{ $cooperative->participants()->count() }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Membership Status:</td>
                                                            <td>{{ strtoupper(optional($cooperative->gaRegistration)->membership_status ?? 'N/A') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">GA Registration Status:</td>
                                                            <td>{{ optional($cooperative->gaRegistration)->registration_status == 'Rejected' ? 'Not Available' : optional($cooperative->gaRegistration)->registration_status ?? 'N/A' }}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Services Availed:</td>
                                                            <td>
                                                                {{ is_array($services = json_decode($cooperative->services_availed, true)) ? implode(', ', $services) : 'N/A' }}
                                                            </td>

                                                            {{-- <p>{{ implode(', ', json_decode($cooperative->services_availed, true)) }}</p> --}}
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Total Asset:</td>
                                                            <td>{{ number_format($cooperative->total_asset, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Loan Balance:</td>
                                                            <td>{{ number_format($cooperative->loan_balance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Total Overdue:</td>
                                                            <td>{{ number_format($cooperative->total_overdue, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Time Deposit:</td>
                                                            <td>{{ number_format($cooperative->time_deposit, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Accounts Receivable:</td>
                                                            <td>{{ number_format($cooperative->accounts_receivable, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Savings:</td>
                                                            <td>{{ number_format($cooperative->savings, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Registration Fee:</td>
                                                            <td id="registration_fee">
                                                                {{ number_format($cooperative->registration_fee, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Net Surplus:</td>
                                                            <td>{{ number_format($cooperative->net_surplus, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Due to Apex:</td>
                                                            <td>{{ number_format($cooperative->cetf_due_to_apex, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Additional CETF:</td>
                                                            <td>{{ number_format($cooperative->additional_cetf, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Undertaking:</td>
                                                            <td>{{ number_format($cooperative->cetf_undertaking, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>


                                                        =
                                                        <tr>
                                                            <td class="fw-bold">CETF Remittance:</td>
                                                            <td>{{ number_format($cooperative->cetf_remittance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Required:</td>
                                                            <td id="cetf_required"
                                                                data-value="{{ $cooperative->cetf_required }}">
                                                                {{ number_format($cooperative->cetf_required, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Balance:</td>
                                                            <td>{{ number_format($cooperative->cetf_balance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Share Capital Balance:</td>
                                                            <td id="share_capital_balance">
                                                                {{ number_format($cooperative->share_capital_balance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Total Remittance:</td>
                                                            <td id="total_remittance"
                                                                data-value="{{ $cooperative->total_remittance }}">
                                                                {{ number_format($cooperative->total_remittance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Net Required Registration Fee:</td>
                                                            <td id="net_required_reg_fee">
                                                                {{ number_format($cooperative->net_required_reg_fee, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td class="fw-bold">Less Pre-Registration Fee:</td>
                                                            <td id="less_prereg_payment">
                                                                <span
                                                                    data-value="{{ $cooperative->less_prereg_payment ?? 0 }}">
                                                                    {{ number_format($cooperative->less_prereg_payment, 2) ?? 'N/A' }}
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Less CETF Balance:</td>
                                                            <td id="less_cetf_balance">
                                                                <span
                                                                    data-value="{{ $cooperative->less_cetf_balance ?? 0 }}">
                                                                    {{ number_format($cooperative->less_cetf_balance, 2) ?? 'N/A' }}
                                                                </span>
                                                            </td>
                                                        </tr>



                                                        <tr>
                                                            <td class="fw-bold">Number of Entitled Votes:</td>
                                                            <td id="no_of_entitled_votes">
                                                                {{ $cooperative->no_of_entitled_votes ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Registration Date Paid:</td>
                                                            <td>{{ $cooperative->registration_date_paid ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Total Registration Fee:</td>
                                                            <td id="total_reg_fee">
                                                                {{ number_format($cooperative->registration_fee * $cooperative->participants->count(), 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Registration Fee Payable:</td>
                                                            <td id="reg_fee_payable">
                                                                {{ number_format($cooperative->reg_fee_payable, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Full CETF Remitted:</td>
                                                            <td id="full_cetf_remitted"
                                                                data-value="{{ $cooperative->full_cetf_remitted }}">
                                                                {{ $cooperative->full_cetf_remitted ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Remark:</td>
                                                            <td>{{ $cooperative->ga_remark ?? 'N/A' }}</td>
                                                        </tr>

                                                        {{-- <tr>
                                                            <td class="fw-bold">2 Pax free for MIGS Membership Status
                                                            </td>
                                                            <td>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="free_2pax_migs" id="free_2pax_migs"
                                                                    value="1"
                                                                    {{ $hasMigsRegistration ? 'checked' : '' }}
                                                                    disabled />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">1 Pax Free for MASS-SPECC Officer</td>
                                                            <td>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="free_migs_pax" id="free_migs_pax"
                                                                    value="1"
                                                                    {{ $cooperative->free_migs_pax == 4500 ? 'checked' : '' }}
                                                                    {{ $cooperative->free_migs_pax == 4500 ? 'disabled' : '' }}
                                                                    disabled />
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td class="fw-bold">1 Pax free Based on CETF(100k)</td>
                                                            <td>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="free_100k_cetf" id="free_100k_cetf"
                                                                    value="1"
                                                                    {{ $free100kCETF ? 'checked' : '' }} disabled />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">1/2 free Based on CETF(50k)</td>
                                                            <td>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="half_based_cetf" id="half_based_cetf"
                                                                    value="1"
                                                                    {{ $halfBasedCETF ? 'checked' : '' }} disabled />
                                                            </td>
                                                        </tr> --}}

                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-muted text-center">No cooperative profile available.</p>
                                            @endif
                                        </div>

                                        <div class="card-footer text-end">
                                            <button class="btn btn-label-info btn-round" type="button"
                                                onclick="window.location.href='{{ route('participantDashboard') }}'">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateFullCetfRemitted() {
                let cetfRequired = parseFloat(document.getElementById('cetf_required').dataset.value) || 0;
                let totalRemittance = parseFloat(document.getElementById('total_remittance').dataset.value) || 0;
                let fullCetfRemitted = document.getElementById('full_cetf_remitted');

                if (cetfRequired <= 0) {
                    fullCetfRemitted.innerText = "No";
                } else {
                    fullCetfRemitted.innerText = totalRemittance >= cetfRequired ? "Yes" : "No";
                }
            }

            updateFullCetfRemitted(); // Run the function on page load

            // Example: If you have AJAX or live updates, call updateFullCetfRemitted() after fetching new data
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function calculateFees() {
            // Fetch numeric values
            let regFee = parseFloat(document.getElementById('registration_fee').textContent.replace(/,/g, '')) || 0;
            let numParticipants = parseInt(document.getElementById('num_participants').textContent) || 0;
            let preregPayment = parseFloat(document.getElementById('less_prereg_payment').textContent.replace(/,/g, '')) || 0;
            let cetfBalance = parseFloat(document.getElementById('less_cetf_balance').textContent.replace(/,/g, '')) || 0;
            let cetfRemittance = parseFloat(document.getElementById('cetf_remittance').textContent.replace(/,/g, '')) || 0;

            // Checkbox references
            let halfBasedCetf = document.getElementById('half_based_cetf');
            let free100kCetf = document.getElementById('free_100k_cetf');

            // Determine which checkbox should be checked based on CETF Remittance
            if (cetfRemittance >= 100000) {
                free100kCetf.checked = true;
                halfBasedCetf.checked = false;
            } else if (cetfRemittance >= 50000) {
                free100kCetf.checked = false;
                halfBasedCetf.checked = true;
            } else {
                free100kCetf.checked = false;
                halfBasedCetf.checked = false;
            }

            // Calculate registration fee
            let totalRegFee = numParticipants * regFee;

            // Calculate free amounts
            let freeAmount = 0;

            if (document.getElementById('free_2pax_migs')?.checked) {
                freeAmount += 9000;
            }
            if (document.getElementById('free_migs_pax')?.checked) {
                freeAmount += 4500;
            }

            if (free100kCetf.checked) {
                freeAmount += 4500;
            } else if (halfBasedCetf.checked) {
                freeAmount += 2250;
            }

            // Net required reg fee
            let netRequiredRegFee = totalRegFee - freeAmount;

            // Final payable amount
            let regFeePayable = netRequiredRegFee - (preregPayment + cetfBalance);

            // Update output
            document.getElementById('total_reg_fee').textContent = totalRegFee.toFixed(2);
            document.getElementById('net_required_reg_fee').textContent = netRequiredRegFee.toFixed(2);
            document.getElementById('reg_fee_payable').textContent = regFeePayable.toFixed(2);
        }

        // Watch for changes (if fields are editable; otherwise this is just for initial load)
        let fields = [
            'registration_fee', 'num_participants', 'less_prereg_payment',
            'less_cetf_balance', 'cetf_remittance'
        ];

        fields.forEach(id => {
            let el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', calculateFees);
                el.addEventListener('change', calculateFees);
            }
        });

        calculateFees();
    });
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButton = document.getElementById("servicesDropdown");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const checkboxes = dropdownMenu.querySelectorAll('input[type="checkbox"]');
            const hiddenInput = document.getElementById("services_availed_json");

            // Disable dropdown button (prevents clicking)
            dropdownButton.disabled = true;

            // Make checkboxes readonly (prevent selection change)
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("click", function(event) {
                    event.preventDefault(); // Stops selection change
                });
            });

            function updateDropdownText() {
                let selected = Array.from(checkboxes)
                    .filter(i => i.checked)
                    .map(i => i.value)
                    .join(", ");

                dropdownButton.innerText = selected ? selected : "Select Services";
                hiddenInput.value = JSON.stringify(selected.split(", ").filter(Boolean)); // Store as JSON
            }

            // Load preselected values
            updateDropdownText();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareCapitalElem = document.getElementById('share_capital_balance'); // <td> element
            const entitledVotesElem = document.getElementById('no_of_entitled_votes'); // <td> element

                function calculateEntitledVotes(shareCapital) {
    let votes = 0;

    if (shareCapital >= 25000) {
        if (shareCapital >= 100000) {
            votes = Math.floor(shareCapital / 100000); // 1 vote per 100k
            let remaining = shareCapital % 100000;

            if (remaining >= 25000) {
                votes += 1; // Add 1 more if remaining is at least 25k
            }
        } else {
            votes = 1; // If at least 25k but below 100k, give 1 vote
        }
    }

    return Math.min(votes, 5); // Max of 5 votes
}


            function updateEntitledVotes() {
                const shareCapital = parseFloat(shareCapitalElem.textContent.replace(/,/g, '')) || 0;
                const entitledVotes = calculateEntitledVotes(shareCapital);
                entitledVotesElem.textContent = entitledVotes; // Update the <td> element
            }

            updateEntitledVotes(); // Run on page load

            // If these values change dynamically via AJAX, use MutationObserver
            const observer = new MutationObserver(updateEntitledVotes);
            observer.observe(shareCapitalElem, {
                childList: true,
                subtree: true
            });
        });
    </script>

    <!-- SweetAlert CDN -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>

    @include('layouts.links')
</body>

</html>
