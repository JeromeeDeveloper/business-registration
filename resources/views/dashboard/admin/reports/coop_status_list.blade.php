<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        background-color: #f8f9fa;
    }
    .table-hover tbody tr:hover {
        background-color: #e9ecef !important;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            background-color: white !important;
        }

        .table-responsive {
            overflow: hidden !important;
            page-break-inside: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        h2 {
            font-size: 18px;
            text-align: center;
            color: black !important;
        }

        .table-hover tbody tr:hover {
            background-color: transparent !important;
        }

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }
    }
</style>
<body>

    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-primary text-center">
            📑 Cooperative Registration Status
        </h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="bg-gradient bg-dark text-white">
            <tr>
                <th>Cooperative Name</th>
                <th>Coop ID</th>
                <th>Region</th>

                <th>No. of Participants</th>

                <th>GA Registration Status</th>
                <th>GA Membership Status</th>

                <th>Financial Statement</th>
                <th>Resolution for Voting Delegates</th>
                <th>Deposit Slip for Registration Fee</th>
                <th>Deposit Slip for CETF Remittance</th>
                <th>CETF Undertaking</th>
                <th>Certificate of Candidacy</th>
                <th>CETF Utilization Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cooperatives as $coop)
                <tr>
                    <td>{{ $coop->name }}</td>
                    <td>{{ $coop->coop_identification_no }}</td>
                    <td>{{ $coop->region }}</td>

                    <td>{{ $coop->participants->count() }}</td>

                    {{-- GA Registration Status --}}
                    <td>
                        @if ($coop->gaRegistration)
                            @if($coop->gaRegistration->registration_status == 'Rejected')
                                <span class="badge bg-secondary">Not Available</span>
                            @else
                                <span class="badge
                                    @if($coop->gaRegistration->registration_status == 'Fully Registered') bg-success
                                    @elseif($coop->gaRegistration->registration_status == 'Partial Registered') bg-warning
                                    @endif">
                                    {{ $coop->gaRegistration->registration_status }}
                                </span>
                            @endif
                        @else
                            <span class="badge bg-secondary">Not Available</span>
                        @endif
                    </td>

                    <td>
                        @if ($coop->gaRegistration)
                            <span class="badge
                                @if($coop->gaRegistration->membership_status == 'Migs') bg-success
                                @else bg-danger
                                @endif">
                                {{ strtoupper($coop->gaRegistration->membership_status) }}
                            </span>
                        @else
                            <span class="badge bg-secondary">NOT AVAILABLE</span>
                        @endif
                    </td>

                    @php
                        $documents = [
                            'Financial Statement',
                            'Resolution for Voting delegates',
                            'Deposit Slip for Registration Fee',
                            'Deposit Slip for CETF Remittance',
                            'CETF Undertaking',
                            'Certificate of Candidacy',
                            'CETF Utilization invoice'
                        ];
                    @endphp

                    @foreach ($documents as $doc)
                        @php
                            $docStatus = $coop->uploadedDocuments->where('document_type', $doc)->first();
                        @endphp
                        <td>
                            @if ($docStatus)
                                @switch($docStatus->status)
                                    @case('Pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @break
                                    @case('Checked')
                                        <span class="badge bg-primary">Checked</span>
                                        @break
                                    @case('Approved')
                                        <span class="badge bg-success">Accepted</span>
                                        @break
                                    @case('Rejected')
                                        <span class="badge bg-danger">Decline</span>
                                        @break
                                @endswitch
                            @else
                                <span class="badge bg-secondary">Not Uploaded</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
