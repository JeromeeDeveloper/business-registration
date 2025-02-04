<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASS-SPECC GENERAL ASSEMBLY ONLINE REGISTRATION PORTAL</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }
    .calculator {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }
    label {
        display: block;
        margin-top: 10px;
    }
    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .result {
        margin-top: 15px;
        font-weight: bold;
    }
</style>

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
