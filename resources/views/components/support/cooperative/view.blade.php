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
                                <a href="{{ route('supportDashboard') }}">Dashboard</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supportview') }}">Cooperative</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>

                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Cooperative Information</div>
                                </div>
                                <form>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Coop Name -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name">Cooperative Name</label>
                                                    <p>{{ $coop->name }}</p>
                                                </div>
                                            </div>

                                            <!-- Contact Person -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="contact_person">Contact Person</label>
                                                    <p>{{ $coop->contact_person }}</p>
                                                </div>
                                            </div>

                                            <!-- Cooperative Type -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="type">Cooperative Type</label>
                                                    <p>{{ $coop->type }}</p>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <p>{{ $coop->address }}</p>
                                                </div>
                                            </div>

                                            <!-- Region -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="region">Region</label>
                                                    <p>{{ $coop->region }}</p>
                                                </div>
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <p>{{ $coop->phone_number }}</p>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <p>{{ $coop->email }}</p>
                                                </div>
                                            </div>

                                            <!-- TIN -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="tin">TIN</label>
                                                    <p>{{ $coop->tin }}</p>
                                                </div>
                                            </div>

                                            <!-- Coop Identification No -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="coop_identification_no">Cooperative ID</label>
                                                    <p>{{ $coop->coop_identification_no }}</p>
                                                </div>
                                            </div>

                                            <!-- BOD Chairperson -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="bod_chairperson">BOD Chairperson</label>
                                                    <p>{{ $coop->bod_chairperson }}</p>
                                                </div>
                                            </div>

                                            <!-- General Manager/CEO -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="general_manager_ceo">General Manager/CEO</label>
                                                    <p>{{ $coop->general_manager_ceo }}</p>
                                                </div>
                                            </div>

                                            <!-- Services Availed -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="services_availed">Services Availed</label>
                                                    <p>
                                                        @if (!empty($coop->services_availed) && is_array(json_decode($coop->services_availed, true)))
                                                            {{ implode(', ', json_decode($coop->services_availed, true)) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="ga_registration_status">Registration Status</label>
                                                    <p>
                                                        {{ optional($coop->gaRegistration)->registration_status === 'Rejected' ? 'Unregistered' : optional($coop->gaRegistration)->registration_status ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>


                                            <!-- Membership Status -->
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="membership_status">Membership Status</label>
                                                    <p>{{ strtoupper(optional($coop->gaRegistration)->membership_status ?? 'N/A') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="ga_remark">Remark</label>
                                                    <textarea class="form-control" name="ga_remark" id="ga_remark" rows="4" readonly>{{ $coop->ga_remark ?? 'N/A' }}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <h4 class="mt-4">Verifier</h4>
                                                <hr>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="share_capital_balance">Share Capital Balance</label>
                                                    <p id="share_capital_balance">
                                                        {{ number_format($coop->share_capital_balance, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="fs_status">Audited Financial Statement Status</label>
                                                    <p>{{ $hasFinancialStatement ? 'Yes' : 'No' }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="registration_date_paid">Registration Date Paid</label>
                                                    <p>{{ \Carbon\Carbon::parse($coop->registration_date_paid)->translatedFormat('F j, Y') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="no_of_entitled_votes">No of Entitled Votes</label>
                                                    <p id="no_of_entitled_votes">{{ $coop->no_of_entitled_votes }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="delinquent">Delinquent</label>
                                                    <p>{{ $coop->delinquent }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="total_reg_fee">Registration Fee</label>
                                                    <p>4,500.00</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="loan_balance">Loan Balance</label>
                                                    <p>{{ number_format($coop->loan_balance, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="total_asset">Total Assets</label>
                                                    <p>{{ number_format($coop->total_asset, 2) }}</p>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="num_participants"># of Participants</label>
                                                    <p> {{ $coop->participants()->count() }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="total_overdue">Loan Overdue</label>
                                                    <p>{{ number_format($coop->total_overdue, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="net_surplus">Net Surplus</label>
                                                    <p>{{ number_format($coop->net_surplus, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="registration_fee">Total Registration Fee</label>
                                                    <p>{{ number_format($coop->registration_fee * $coop->participants->count(), 2) ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="total_overdue">Loan Overdue</label>
                                                    <p>{{ number_format($coop->total_overdue, 2) }}</p>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="time_deposit">Time Deposit</label>
                                                    <p>{{ number_format($coop->time_deposit, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="cetf_due_to_apex">CETF Due to Apex</label>
                                                    <p>{{ number_format($coop->cetf_due_to_apex, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="accounts_receivable">Accounts Receivable</label>
                                                    <p>{{ number_format($coop->accounts_receivable, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="cetf_required">CETF Required</label>
                                                    <p id="cetf_required" data-value="{{ $coop->cetf_required }}">
                                                        {{ number_format($coop->cetf_required, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="additional_cetf">Additional CETF</label>
                                                    <p>{{ number_format($coop->additional_cetf, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="savings">Savings</label>
                                                    <p>{{ number_format($coop->savings, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="cetf_remittance">CETF Remittance</label>
                                                    <p>{{ number_format($coop->cetf_remittance, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="net_required_reg_fee">Net Required Registration
                                                        Fee</label>
                                                    <p>{{ number_format($coop->net_required_reg_fee, 2) }}</p>
                                                </div>
                                            </div>





                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="less_prereg_payment">Less: PreReg Payment</label>
                                                    <p>{{ number_format($coop->less_prereg_payment, 2) }}</p>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="cetf_undertaking">CETF Undertaking</label>
                                                    <p>{{ number_format($coop->cetf_undertaking, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="total_remittance">Total Remittance</label>
                                                    <p id="total_remittance"
                                                        data-value="{{ $coop->total_remittance }}">
                                                        {{ number_format($coop->total_remittance, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="less_cetf_balance">Less: CETF Utilization</label>
                                                    <p>{{ number_format($coop->less_cetf_balance, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="cetf_balance">CETF Balance</label>
                                                    <p>{{ number_format($coop->cetf_balance, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="full_cetf_remitted">Full CETF Remitted</label>
                                                    <p id="full_cetf_remitted"
                                                        data-value="{{ $coop->full_cetf_remitted }}">
                                                        {{ $coop->full_cetf_remitted }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="reg_fee_payable">Registration Fee Payable</label>
                                                    <p>{{ number_format($coop->reg_fee_payable, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-4">
                                                <h4>Documents</h4>
                                                <hr>
                                            </div>

                                            @if($documents->isEmpty())
                                                <div class="col-12">
                                                    <p class="text-muted">No documents uploaded for this cooperative.</p>
                                                </div>
                                            @else
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered align-middle">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Document Type</th>
                                                                    <th>File Name</th>
                                                                    <th class="text-center">View</th>
                                                                    <th class="text-center">Download</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($documents as $document)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $document->document_type === 'Financial Statement' ? 'Audited ' : '' }}{{ $document->document_type }}
                                                                        </td>
                                                                        <td>{{ $document->file_name }}</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                                <i class="fas fa-eye"></i> View
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="{{ asset('storage/' . $document->file_path) }}" download class="btn btn-sm btn-outline-success">
                                                                                <i class="fas fa-download"></i> Download
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="card-action">
                                        <button class="btn btn-label-info btn-round me-2" type="button"
                                            onclick="window.location.href='{{ route('supportview') }}'">Back</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareCapitalElem = document.getElementById('share_capital_balance');
            const entitledVotesElem = document.getElementById('no_of_entitled_votes');

            function calculateEntitledVotes(shareCapital) {
                let votes = 0;

                if (shareCapital >= 25000) {
                    if (shareCapital >= 100000) {
                        votes = Math.floor(shareCapital / 100000);
                        const remaining = shareCapital % 100000;

                        if (remaining >= 25000) {
                            votes += 1;
                        }
                    } else {
                        votes = 1; // If between 25k and 99,999
                    }
                }

                return Math.min(votes, 5); // Max of 5 votes
            }


            function updateEntitledVotes() {
                const shareCapital = parseFloat(shareCapitalElem.textContent.replace(/,/g, '')) || 0;
                const entitledVotes = calculateEntitledVotes(shareCapital);
                entitledVotesElem.textContent = entitledVotes; // Update the text in the <p> element
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
    @include('layouts.links')
</body>

</html>
