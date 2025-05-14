<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voting Participants per Region</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
                margin: 0;
                padding: 0;
            }

            .container-fluid {
                width: 100%;
                padding: 0;
                margin: 0;
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

        <h2 class="mb-4 fw-bold text-primary text-center">
            🗳️ Summary of Voting Participants by Region
        </h2>

        @if ($regionCounts->isEmpty())
            <div class="alert alert-warning" role="alert">No voting participants found.</div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="bg-gradient bg-dark text-white">
                    <tr>
                        <th>Region</th>
                        <th>Total Voting Participants</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($regionCounts as $region)
                        <tr>
                            <td class="fw-semibold text-primary">{{ $region->region ?? 'N/A' }}</td>
                            <td>{{ $region->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
