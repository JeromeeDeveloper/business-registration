<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coop Registration Summary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
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
<body>
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-primary text-center">
            📑 Coop Registration Summary with Breakdown
        </h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="bg-gradient bg-dark text-white">
                    <tr>
                        <th>Cooperative Name</th>
                        <th>CETF</th>
                        <th>No. of Delegates</th>
                        <th>Region</th>
                        <th>Share Capital Balance</th>
                        <th>No. of Entitled Votes</th>
                        <th>Free for MSP Officer</th>
                        <th>Free half for 1/2 CETF</th>
                        <th>Free pax for every 100k CETF</th>
                        <th>Less CETF Balance</th>
                        <th>Less Pre-reg payment</th>
                        <th>Regristration Fee payable</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($financialData as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ number_format($data->cetf_balance, 2) }}</td>
                        <td>{{ $data->participant_count }}</td>
                        <td>{{ $data->region }}</td>
                        <td>{{ number_format($data->share_capital_balance, 2) }}</td>
                        <td id="votes-{{ $data->share_capital_balance }}"></td> <!-- This is where the votes will be displayed -->
                        <td>{{ number_format($data->free_migs_pax, 2) }}</td>
                        <td>{{ number_format($data->half_cetf, 2) }}</td>
                        <td>{{ number_format(floor($data->cetf_remittance / 100000) * 4500, 2) }}</td>
                        <td>{{ number_format($data->less_cetf_balance, 2) }}</td>
                        <td>{{ number_format($data->less_prereg_payment, 2) }}</td>
                        <td>{{ number_format($data->reg_fee_payable, 2) }}</td>
                        <td>{{ $data->ga_remark }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to calculate the entitled votes
        function calculateVotes(shareCapitalBalance) {
    let remaining = shareCapitalBalance;
    let votes = 0;

    // If the share capital is 25,000 or more, it grants 1 vote
    if (remaining >= 25000) {
        votes = 1; // 1 vote for the first 25k
        remaining -= 25000; // Subtract the first 25k
    }

    // For every 100,000, add 1 vote
    if (remaining >= 100000) {
        votes += Math.floor(remaining / 100000); // Add 1 vote for every 100k
    }

    // Cap the votes at 5
    return Math.min(votes, 5);
}


        // Pass the financialData array to JavaScript
        const financialData = @json($financialData);

        // Iterate over the financialData and calculate the votes
        document.addEventListener('DOMContentLoaded', function () {
            financialData.forEach(function (data) {
                const shareCapitalBalance = data.share_capital_balance;
                const noOfVotes = calculateVotes(shareCapitalBalance);
                document.getElementById('votes-' + data.share_capital_balance).textContent = noOfVotes;
            });
        });
    </script>


</body>
</html>
