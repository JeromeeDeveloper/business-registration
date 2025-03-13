<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Status Report</title>

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

        /* Remove padding/margins for full-width printing */
        @media print {
            body {
                background-color: white;
            }
            .container-fluid {
                margin: 0;
                padding: 0;
            }
            .table-responsive {
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid mt-4">
    <h2 class="mb-4 fw-bold text-primary text-center">
        📑 Status Report on Documents Required
    </h2>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-gradient bg-dark text-white">
                <tr>
                    <th><i class="fas fa-building"></i> Cooperative Region</th>
                    <th><i class="fas fa-file-alt"></i> Financial Statement</th>
                    <th><i class="fas fa-file-alt"></i> Resolution for Voting delegates</th>
                    <th><i class="fas fa-file-alt"></i> Deposit Slip for Registration Fee</th>

                    <th><i class="fas fa-file-alt"></i> Deposit Slip for CETF Remittance</th>
                    <th><i class="fas fa-file-alt"></i> CETF Undertaking</th>
                    <th><i class="fas fa-file-alt"></i> Certificate of Candidacy</th>
                    <th><i class="fas fa-file-alt"></i> CETF Utilization invoice</th>
                </tr>
            </thead>
            <tbody class="bg-light">
                @foreach($documentsByRegion as $region => $documents)
                <tr>
                    <td class="fw-semibold text-primary">{{ $region }}</td>
                    <td>{{ $documents->where('document_type', 'Financial Statement')->count() }}</td>
                    <td>{{ $documents->where('document_type', 'Resolution for Voting delegates')->count() }}</td>
                    <td>{{ $documents->where('document_type', 'Deposit Slip for Registration Fee')->count() }}</td>

                    <td>{{ $documents->where('document_type', 'Deposit Slip for CETF Remittance')->count() }}</td>
                    <td>{{ $documents->where('document_type', 'CETF Undertaking')->count() }}</td>
                    <td>{{ $documents->where('document_type', 'Certificate of Candidacy')->count() }}</td>
                    <td>{{ $documents->where('document_type', 'CETF Utilization invoice')->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
