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

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#participant">
                                <i class="fas fa-users"></i>
                                <p>Participant</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="participant">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('coop.index') }}">
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
                                                                    value="{{ $cooperative->address }}" required
                                                                    readonly>
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
                                                                    value="{{ $cooperative->general_manager_ceo }}">
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
                                                                    value="{{ $cooperative->phone_number }}">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="bod_chairperson" class="form-label">BOD
                                                                    Chairperson</label>
                                                                <input type="text" class="form-control"
                                                                    id="bod_chairperson" name="bod_chairperson"
                                                                    value="{{ $cooperative->bod_chairperson }}">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="tin" class="form-label">TIN</label>
                                                                <input type="text" class="form-control"
                                                                    id="tin" name="tin"
                                                                    value="{{ $cooperative->tin }}">
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
                                                            <div class="col-md-4 mb-3">
                                                                <label for="no_of_entitled_votes"
                                                                    class="form-label">No of Entitled Votes</label>
                                                                <input type="text" class="form-control"
                                                                    id="no_of_entitled_votes"
                                                                    name="no_of_entitled_votes"
                                                                    value="{{ $cooperative->no_of_entitled_votes }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
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
                                                            </div>
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
                                                        <tr>
                                                            <td class="fw-bold">Full CETF Remitted:</td>
                                                            <td>{{ $cooperative->full_cetf_remitted ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Registration Date Paid:</td>
                                                            <td>{{ $cooperative->registration_date_paid ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Registration Fee:</td>
                                                            <td>{{ number_format($cooperative->registration_fee, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Remittance:</td>
                                                            <td>{{ number_format($cooperative->cetf_remittance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Required:</td>
                                                            <td>{{ number_format($cooperative->cetf_required, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">CETF Balance:</td>
                                                            <td>{{ number_format($cooperative->cetf_balance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Share Capital Balance:</td>
                                                            <td>{{ number_format($cooperative->share_capital_balance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Total Remittance:</td>
                                                            <td>{{ number_format($cooperative->total_remittance, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td class="fw-bold">Net Required Registration Fee:</td>
                                                            <td>{{ number_format($cooperative->net_required_reg_fee, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Total Registration Fee:</td>
                                                            <td id="total_reg_fee">
                                                                {{ number_format($cooperative->registration_fee * $cooperative->participants->count(), 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="fw-bold">Less Pre-Registration Fee:</td>
                                                            <td id="less_prereg_payment">
                                                                <span data-value="{{ $cooperative->less_prereg_payment ?? 0 }}">
                                                                    {{ number_format($cooperative->less_prereg_payment, 2) ?? 'N/A' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="fw-bold">Less CETF Balance:</td>
                                                            <td id="less_cetf_balance">
                                                                <span data-value="{{ $cooperative->less_cetf_balance ?? 0 }}">
                                                                    {{ number_format($cooperative->less_cetf_balance, 2) ?? 'N/A' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="fw-bold">Registration Fee Payable:</td>
                                                            <td id="reg_fee_payable" class="fw-bold text-primary">
                                                                {{ number_format($cooperative->reg_fee_payable, 2) ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td class="fw-bold">Number of Entitled Votes:</td>
                                                            <td>{{ $cooperative->no_of_entitled_votes ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Membership Status:</td>
                                                            <td>{{ strtoupper(optional($cooperative->gaRegistration)->membership_status ?? 'N/A') }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Services Availed:</td>
                                                            <td>{{ implode(', ', json_decode($cooperative->services_availed, true ?? 'N/A')) }}
                                                            </td>
                                                            {{-- <p>{{ implode(', ', json_decode($cooperative->services_availed, true)) }}</p> --}}
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">GA Registration Status:</td>
                                                            <td>{{ optional($cooperative->gaRegistration)->registration_status ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Audtied Financial Statement Status:
                                                            </td>
                                                            <td>{{ $cooperative->fs_status ?? 'N/A' }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="fw-bold">Delinquent Status:</td>
                                                            <td>{{ $cooperative->delinquent ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">Number of Participants:</td>
                                                            <td>{{ $cooperative->participants()->count() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold">GA Remark:</td>
                                                            <td>{{ $cooperative->ga_remark ?? 'N/A' }}</td>
                                                        </tr>
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
            function calculateRegFeePayable() {
                let regFee = parseFloat({{ $cooperative->registration_fee ?? 0 }});
                let numParticipants = parseInt({{ $cooperative->participants->count() ?? 0 }});
                let preregPayment = parseFloat(document.getElementById('less_prereg_payment').querySelector('span').getAttribute('data-value')) || 0;
                let cetfBalance = parseFloat(document.getElementById('less_cetf_balance').querySelector('span').getAttribute('data-value')) || 0;
        
                // Calculate Total Registration Fee
                let totalRegFee = numParticipants * regFee;
                document.getElementById('total_reg_fee').textContent = totalRegFee.toFixed(2);
        
                // Calculate Registration Fee Payable
                let regFeePayable = Math.max(0, totalRegFee - (preregPayment + cetfBalance));
                document.getElementById('reg_fee_payable').textContent = regFeePayable.toFixed(2);
            }
        
            // Run calculation on page load
            calculateRegFeePayable();
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
