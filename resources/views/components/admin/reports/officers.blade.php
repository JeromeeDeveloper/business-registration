<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants Voting List</title>

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
            📑 List of
            {{ request('officer_type') === 'msp' ? 'MSP Officers' : (request('officer_type') === 'non-msp' ? 'Non-MSP Officers' : 'Delegates') }}
        </h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="bg-gradient bg-dark text-white">
                    <tr>
                        <th>Full Name</th>
                        <th>Access Key</th>
                        <th>Officer Type</th>

                        <th>Cooperative</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Region</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @foreach ($participants as $index => $participant)
                        <tr>
                            <td>
                                {{ strtoupper(trim($participant->first_name . ' ' . ($participant->middle_name && $participant->middle_name !== 'N/A' ? $participant->middle_name . ' ' : '') . $participant->last_name)) }}
                            </td>
                            <td>{{ $participant->reference_number }}</td>
                            <td>
                                {{ $participant->is_msp_officer === 'Yes' ? 'MSP Officer' : 'Non-MSP Officer' }}
                            </td>

                            <td>{{ $participant->coop_name }}</td>
                            <td>{{ $participant->phone_number }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->coop_region }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
