<!DOCTYPE html>
<html>
<head>
    <title>Print All IDs</title>
    <style>
        .page {

            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .id-card {
            width: 250px;
            height: 400px;
            margin: -30px auto 0;

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .id-card h2 {
            font-size: 18px;
        }

        .id-card p {
            font-size: 14px;
        }

        .id-card img {
            width: 100px;
            height: 100px;
        }

        @media print {
            .page {
                page-break-after: always;
            }

            .page:last-child {
                page-break-after: auto;
            }

        }
    </style>
</head>
<body>
    @foreach($participants as $participant)
        @php
            $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode(route('adminDashboard', ['participant_id' => $participant->participant_id])) . '&size=200x200';
        @endphp

        <div class="page">
            <div class="id-card">
                <h2>{{ strtoupper($participant->nickname) }}</h2>
                <p>
                    <strong>{{ strtoupper($participant->first_name) }},
                    {{ strtoupper($participant->last_name) }}
                    {{ $participant->middle_name ? strtoupper(substr($participant->middle_name, 0, 1)) . '.' : '' }}</strong>
                </p>
                <p><strong><em>{{ strtoupper(optional($participant->cooperative)->name ?? 'N/A') }}</em></strong></p>

                <img class="qr-code" src="{{ $qrCodeUrl }}" alt="QR Code">
                <p class="footer">{{ $participant->reference_number }}</p>
            </div>
        </div>
    @endforeach

    <script>
        const qrImages = document.querySelectorAll('.qr-code');
        let loaded = 0;
        let printTriggered = false;

        function triggerPrint() {
            if (!printTriggered) {
                printTriggered = true;
                window.print();
            }
        }

        window.onafterprint = () => {
            setTimeout(() => window.close(), 300);
        };

        if (qrImages.length > 0) {
            qrImages.forEach(img => {
                if (img.complete) {
                    markLoaded();
                } else {
                    img.onload = markLoaded;
                    img.onerror = markLoaded;
                }
            });

            setTimeout(triggerPrint, 5000); // Only calls print if not already triggered
        } else {
            triggerPrint();
        }

        function markLoaded() {
            loaded++;
            if (loaded === qrImages.length) {
                setTimeout(triggerPrint, 300);
            }
        }
    </script>


</body>
</html>
