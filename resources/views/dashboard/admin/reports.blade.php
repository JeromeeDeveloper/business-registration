<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cooperative Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Forces columns to fit within the table */
        }
        th, td {
            padding: 8px;
            border: 1px solid #dee2e6;
            text-align: center;
            word-wrap: break-word; /* Ensures long text wraps */
        }
        th {
            background-color: #343a40;
            color: white;
        }

        /* Print Styling */
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .container {
                box-shadow: none;
            }
            .btn {
                display: none; /* Hide buttons when printing */
            }
            table {
                font-size: 10px; /* Reduce font size for better fit */
            }
            @page {
                size: A4 landscape; /* Set print to A4 landscape */
                margin: 1cm;
            }
        }
    </style>
</head>
<body>

<div class="container my-4">
    <div class="text-center">
        <h1 class="mb-3">MASS-SPECC Cooperative Development Center</h1>
        <p class="text-muted">2025 GENERAL ASSEMBLY</p>
        <p class="text-muted">Date & Time: <span id="date-time"></span></p>
    </div>

    <!-- Print Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" onclick="printReport()">
            <i class="fas fa-print"></i> Print Report
        </button>
    </div>

    <div id="report-content" class="p-4 bg-white shadow rounded">
        <h4 class="text-center mb-4">Voting Delegates Status/Count</h4>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
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
</div>

<script>
    function updateDateTime() {
        const now = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };
        document.getElementById("date-time").textContent = now.toLocaleString('en-US', options);
    }

    function printReport() {
        window.print();
    }

    // Update date and time when page loads
    document.addEventListener("DOMContentLoaded", updateDateTime);
</script>

</body>
</html>
