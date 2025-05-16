<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Cooperative Summary Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            border: 2px solid black;
            padding: 20px;
        }

        h1,
        h2 {
            text-align: center;
        }

        .italic {
            font-style: italic;
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .header-section p {
            margin: 0;
            line-height: 1.2;
        }

        .header-section {
            text-align: center;
        }

        .cooperative-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .underline-box {
            display: inline-block;
            width: 400px;
            border-bottom: 2px solid black;
        }

        .underline-box-med {
            display: inline-block;
            width: 250px;
            border-bottom: 2px solid black;
        }

        .underline-cell {
            border-bottom: 2px solid black;
            padding: 8px;
            font-weight: bold;
            text-align: center;
        }

        .single-box {
            border: 2px solid black;
            padding: 10px;
        }

        .single-box-value {
            border: 2px solid black;
            padding: 10px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 5px 10px;
            font-weight: bold;
        }

        .highlight {
            color: red;
        }

        .text-right {
            text-align: right;
        }

        .underline-cell:first-child {
            position: relative;
            padding-left: 20px;
            /* Adjust for space */
        }

        .underline-cell:first-child::before {
            content: counter(row-num) ". ";
            counter-increment: row-num;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        tbody {
            counter-reset: row-num;
            /* Reset counter for each tbody */
        }

        /* Handle page breaks and header repetition */
        @media print {
            .container {
                width: 90%;
                margin: 20px auto;
                padding: 20px;
                page-break-before: always;
                page-break-inside: avoid;
                /* Prevent breaking inside the container */
            }

            .underline-box-med {
                width: 120px;
                font-size: 10px;
            }

            .underline-box {
                width: 150px;
                font-size: 10px;
            }

            table,
            th,
            td {
                font-size: 10px;
                padding: 4px;
            }

            /* Page break and header repetition */
            .container {
                page-break-before: always;
            }

            /* Ensure the header appears on each new page */
            .header-section {
                page-break-before: always;
            }

            /* Prevent breaking between Prepared/Received by fields and content */
            .prepared-received-section {
                /* Removed page-break-before to keep it on the same page */
                page-break-inside: avoid;
                /* Prevent break inside this section */
            }
        }
    </style>
</head>

<body>
    @foreach ($registrations as $registration)
        <div class="container">
            <!-- Header Section -->
            <div class="header-section">
                <p>55th CO-OP LEADERS' CONGRESS</p>
                <p>51st General Assembly</p>
                <p class="italic">May 25, 2025</p>
                <p>Almont Inland Resort, Butuan City</p>
                <p class="bold">Cooperative Build a Better World</p>
            </div>

            <!-- Cooperative Info Section -->
            <div class="cooperative-info">
                <p>Cooperative Name: <span class="bold underline-box">{{ $registration->cooperative->name }}</span></p>
                <p>Region: <span class="bold underline-box">{{ $registration->cooperative->region }}</span></p>
            </div>

            <!-- Financial Information -->
            <div class="single-box">
                <table>
                    <tr>
                        <td>Required CETF Amount:</td>
                        <td class="text-right underline-box-med">
                            {{ number_format($registration->cooperative->cetf_required, 2) }}
                        </td>


                        <td>Required Registration Fee:</td>
                        <td class="text-right underline-box-med">
                            {{ number_format($registrationFees[$registration->coop_id] ?? 0, 2) }}
                        </td>


                        <td>[On-line] Payment:</td>
                        <td class="text-right underline-box-med">
                            {{ number_format($registration->cooperative->less_prereg_payment, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td>Paid CETF Amount:</td>
                        <td class="text-right underline-box-med">
                            {{ number_format($registration->cooperative->total_remittance, 2) }}
                        </td>

                        <td>[LESS] Free Registration:</td>

                        @php
                            $participantCount = $participants
                                ->where('coop_id', $registration->cooperative->coop_id)
                                ->count();
                            $registrationFee = $participantCount * 4500;

                            $mspOfficerFee = $registration->cooperative->free_migs_pax * 4500;

                            $cetfRemittance = $registration->cooperative->total_remittance;

                            // New: Calculate how many full 100K chunks (₱4500 free per chunk)
                            $free100kPax = floor($cetfRemittance / 100000);
                            $free4500 = $free100kPax * 4500;

                            // No more need to compute halfCetf since it's exclusive
                            $halfCetf = ($cetfRemittance == 50000) ? 2250 : 0;

                            $migsFree = $registration->membership_status === 'Migs' ? 9000 : 0;

                            $totalFreeRegistration = $mspOfficerFee + $halfCetf + $free4500 + $migsFree;

                            $regPayable = $registrationFee - ($totalFreeRegistration + $registration->cooperative->less_prereg_payment + $registration->cooperative->less_cetf_balance);
                        @endphp



                        <td class="text-right highlight underline-box-med">
                            {{ number_format($totalFreeRegistration, 2) }}
                        </td>

                        <td>Reg. Payable:</td>
                        <td class="text-right underline-box-med">
                            {{ number_format($registration->cooperative->reg_fee_payable, 2) }}
                        </td>
                    </tr>
                </table>
            </div>


            <!-- Participants Table -->
            <div>
                <table>
                    <thead>
                        <tr class="single-box-value">
                            <th>NAME<br />(CAPITAL LETTERS)</th>
                            <th>NICKNAME<br />(CAPITAL LETTERS)</th>
                            <th>MOBILE NUMBER</th>
                            <th>T-SHIRT SIZE</th>
                            <th>GENDER</th>
                            <th>VOTING STATUS</th>
                            <th>SIGNATURE</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-tbody">
                      @foreach ($registration->cooperative->participants as $participant)

                            <tr>
                                <td class="underline-cell">
                                    {{ strtoupper($participant->first_name . ' ' . $participant->last_name) }}</td>
                                <td class="underline-cell">{{ strtoupper($participant->nickname) }}</td>
                                <td class="underline-cell">{{ $participant->phone_number }}</td>
                                <td class="underline-cell">{{ $participant->tshirt_size }}</td>
                                <td class="underline-cell">{{ $participant->gender }}</td>
                                <td class="underline-cell">{{ $participant->delegate_type }}</td>
                                <td class="underline-cell"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Prepared and Received By Section -->
            <div class="prepared-received-section"
                style="display: flex; justify-content: space-between; margin-top: 50px;">
                <div>
                    <p>Prepared by:</p>
                    <div class="underline-box-med" style="margin-top: 20px;"></div>
                </div>
                <div>
                    <p>Received by:</p>
                    <div class="underline-box-med" style="margin-top: 20px;"></div>
                </div>
            </div>

        </div>
        <div style="page-break-after: always;"></div>
    @endforeach
</body>

</html>
