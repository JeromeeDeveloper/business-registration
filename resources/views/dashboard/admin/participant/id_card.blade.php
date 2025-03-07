<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .id-card {
            width: 300px;
            height: 450px;
            border: 2px solid black;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
        }
        .id-card img {
            width: 100px;
            height: 100px;
        }
        .btn-print {
            margin-top: 10px;
        }
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="id-card">
        <h2>Participant ID</h2>
        <p><strong>Cooperative Name</strong> {{ optional($participant->cooperative)->name ?? 'N/A' }}</p>
        <p><strong>Nickname:</strong> {{ $participant->nickname}}</p>
        <p><strong>Designation:</strong> {{ $participant->designation ?? 'N/A' }}</p>
        <p><strong>Access Key:</strong> {{ $participant->reference_number ?? 'N/A' }}</p>

        @if ($participant->qr_code)
            <img src="{{ asset('storage/' . $participant->qr_code) }}" alt="QR Code">
        @else
            <p>No QR Code</p>
        @endif

        <br>
        <button class="btn-print" onclick="window.print()">Print ID</button>
    </div>

</body>
</html>
