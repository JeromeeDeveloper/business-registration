<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        @media print {
            .no-print { display: none; }
        }
    </style>
    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</head>
<body>
    <h2>Attended Participants List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Designation</th>
               
                <th>Cooperative</th>
                <th>Attendance Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $index => $participant)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $participant->first_name }} {{ $participant->middle_name }} {{ $participant->last_name }}</td>
                    <td>{{ $participant->designation }}</td>

                    <td>{{ $participant->cooperative->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($participant->attendance_datetime)->format('F j, Y g:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
