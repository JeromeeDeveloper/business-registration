<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cooperative Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

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
</head>
<body>

    <div class="container-fluid mt-4">

        {{-- <h1 class="mb-3">MASS-SPECC Cooperative Development Center</h1>
        <p class="text-muted">2025 GENERAL ASSEMBLY</p> --}}




        <h2 class="mb-4 fw-bold text-primary text-center">
            📑 Voting Delegate Status Count
        </h2>

        <table class="table table-hover align-middle border">
            <thead class="bg-gradient bg-dark text-white">
                <tr>
                    <th>Region</th>
                    <th>MIGS Coops (Voting Delegates)</th>
                    <th>Fully Registered MIGS Coops</th>
                    <th>NON-MIGS Coops (Voting Delegates)</th>
                    <th>Total Allowable Votes</th>
                    <th>MIGS Voting Delegates</th>
                    <th>NON-MIGS Voting Delegates</th>
                </tr>
            </thead>
            <tbody>
                @foreach($totalAllowableVotes as $regionData)
                    <tr>
                        <td>{{ $regionData->region }}</td>
                        <td>{{ optional($migsCoopsWithVotingDelegates->firstWhere('region', $regionData->region))->total ?? 0 }}</td>
                        <td>{{ optional($fullyRegisteredMigsCoops->firstWhere('region', $regionData->region))->total ?? 0 }}</td>
                        <td>{{ optional($nonMigsCoopsWithVotingDelegates->firstWhere('region', $regionData->region))->total ?? 0 }}</td>
                        <td>{{ $regionData->total_votes }}</td>
                        <td>{{ optional($totalVotingDelegatesMigs->firstWhere('region', $regionData->region))->total ?? 0 }}</td>
                        <td>{{ optional($totalVotingDelegatesNonMigs->firstWhere('region', $regionData->region))->total ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
