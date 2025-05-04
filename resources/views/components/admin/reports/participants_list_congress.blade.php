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
            📑 List of Delegates
        </h2>

        @foreach($eventParticipants as $eventTitle => $participants)
        <h3 class="mt-4 text-primary fw-bold">{{ $eventTitle }}</h3>
    
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Full Name</th>
                        <th>Delegate Type</th>
                        <th>Cooperative</th>
                        <th>Region</th>
                        <th>Access Key</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $participant)
                        <tr>
                            <td>{{ $participant['Full Name'] }}</td>
                            <td>{{ $participant['Delegate Type'] }}</td>
                            <td>{{ $participant['Cooperative'] }}</td>
                            <td>{{ $participant['Region'] }}</td>
                            <td>{{ $participant['Access Key'] }}</td>
                            <td>{{ $participant['Phone Number'] }}</td>
                            <td>{{ $participant['Email'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No participants registered for this event.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endforeach
    
    </div>
</body>
</html>
