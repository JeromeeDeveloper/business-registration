<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASS-SPECC GENERAL ASSEMBLY ONLINE REGISTRATION PORTAL</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>


<body>
    <div class="calculator">
        <h2>CETF Calculator</h2>
        <label for="totalIncome">Total Income:</label>
        <input type="number" id="totalIncome" placeholder="Enter total income">

        <label for="cetfRemittance">CETF Remittance:</label>
        <input type="number" id="cetfRemittance" placeholder="Enter CETF remittance">

        <div class="result" id="cetfRequired">CETF Required: 0</div>
        <div class="result" id="cetfBalance">CETF Balance: 0</div>
    </div>

    <script>
        function calculateCETF() {
            const totalIncome = parseFloat(document.getElementById('totalIncome').value) || 0;
            const cetfRemittance = parseFloat(document.getElementById('cetfRemittance').value) || 0;

            // Formula: (Total Income x 5%) x 30%
            const cetfRequired = (totalIncome * 0.05) * 0.30;
            const cetfBalance = cetfRequired - cetfRemittance;

            document.getElementById('cetfRequired').textContent = `CETF Required: ${cetfRequired.toFixed(2)}`;
            document.getElementById('cetfBalance').textContent = `CETF Balance: ${cetfBalance.toFixed(2)}`;
        }

        document.getElementById('totalIncome').addEventListener('input', calculateCETF);
        document.getElementById('cetfRemittance').addEventListener('input', calculateCETF);
    </script>
</body>
</html>
