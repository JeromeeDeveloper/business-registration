<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>T-Shirt Sizes Report</title>
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

        /* 🔹 PRINT STYLES */
        @media print {
            @page {
                size: A4 landscape; /* Ensures A4 size in landscape mode */
                margin: 10mm; /* Adds a small margin to fit content */
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
                overflow: hidden !important; /* Prevents scrolling */
                page-break-inside: auto; /* Prevents breaking tables */
            }

            table {
                width: 100%;
                border-collapse: collapse; /* Ensures proper table alignment */
                font-size: 12px; /* Adjust text size for better fit */
            }

            h2 {
                font-size: 18px; /* Reduce heading size */
                text-align: center;
                color: black !important; /* Ensures it prints properly */
            }

            /* Remove hover effect in print mode */
            .table-hover tbody tr:hover {
                background-color: transparent !important;
            }

            /* Ensure headers are printed properly */
            thead {
                display: table-header-group; /* Keeps headers on every printed page */
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
            📑 Summary of Participants by T-Shirt Sizes
        </h2>

        @if ($cooperatives->isEmpty())
            <div class="alert alert-warning" role="alert">No data available for T-Shirt sizes.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="bg-gradient bg-dark text-white">
                        <tr>
                            <th>Cooperative Name</th>
                            <th>Gender</th>
                            <th>Participant Name</th>
                            <th>T-Shirt Size</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($cooperatives as $cooperative)
                            @foreach ($cooperative->participants as $participant)
                                <tr>
                                    <td>{{ $cooperative->name }}</td>
                                    <td>{{ $participant->gender }}</td>
                                    <td>{{ $participant->first_name }} {{ $participant->middle_name }} {{ $participant->last_name }}</td>
                                    <td class="fw-semibold text-primary">{{ $participant->tshirt_size }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>


    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
