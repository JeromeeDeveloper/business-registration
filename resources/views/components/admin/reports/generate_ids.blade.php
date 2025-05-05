<!DOCTYPE html>
<html>
<head>
    <title>Print All IDs</title>
    <style>
         body {
                font-family: Arial, sans-serif;
                text-align: center;
                margin: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

        .page {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .id-card {
            width: 250px;
            height: 400px;
            border: 2px solid black;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-sizing: border-box;
        }
            .id-card h2 {
                margin: 1px 0;
                font-size: 18px;
            }
            .id-card p {
                margin: 2px;
                font-size: 14px;
            }
            .id-card img {
                width: 100px;
                height: 100px;
            }
            .footer {
                position: relative;
                bottom: 2px;
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
            $backgroundUrl = $participant->is_msp_officer === 'Yes' ? '/img/2.png' : '/img/1.png';
            $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode(route('adminDashboard', ['participant_id' => $participant->participant_id])) . '&size=200x200';
        @endphp

        <div class="page">
            <div class="id-card" style="background-image: url('{{ $backgroundUrl }}');">
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
