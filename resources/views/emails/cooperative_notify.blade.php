<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVITATION: 52nd CO-OP LEADERS CONGRESS and 48th GENERAL ASSEMBLY</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            background: white;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #2c3e50;
        }
        .logo {
            width: 150px;
            margin: 20px auto;
        }
        .content {
            text-align: left;
            line-height: 1.6;
        }
        .event-details {
            background: #f8f9fa;
            padding: 15px;
            border-left: 5px solid #3498db;
            margin: 20px 0;
        }
        .cta {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
        }
        .cta:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">

        <h1>You're Invited!</h1>
        <p><strong>Dear {{ $coop->contact_person }},</strong></p>

        <div class="content">
            <p>
                As one of our valued member-owners of the federation, we are pleased to invite you and your cooperative,
                <strong>{{ $coop->name }}</strong>, to participate in our upcoming event:
            </p>

            <div class="event-details">
                <p><strong>Event Name:</strong> {{ $event->title }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
            </div>

            <p><strong>Cooperative Details:</strong></p>
            <p>Type: {{ $coop->type }}</p>
            <p>Email: {{ $coop->email }}</p>
            <p>Address: {{ $coop->address }}</p>
        </div>

        <p><a href="http://127.0.0.1:8000/login">Confirm Attendance</a></p>

        <p style="margin-top: 20px;">We look forward to your participation! If you have any questions, feel free to contact us.</p>


        <p><em>
            The contents of this email message and any attachments are intended solely for the addressee(s) and may contain confidential and/or privileged information and may be legally protected from disclosure. If you are not the intended recipient of this message or their agent, or if this message has been addressed to you in error, please immediately alert the sender by reply email and then delete this message and any attachments.

            If you are not the intended recipient, you are hereby notified that any use, dissemination, copying, or storage of this message or its attachments is strictly prohibited.
        </em></p>

        <p>
            <strong>ICT Projects</strong><br>
            MASS-SPECC Cooperative Development Center <br>
            Tiano-Yacapin Sts., Cagayan de Oro City <br>
            <strong>Office Tel. No.:</strong> +63 88 326-4617 <br>
            <strong>Mobile No.:</strong> +63 917 323-6637
        </p>

        <p>Visit us at: <a href="https://www.mass-specc.coop" target="_blank">www.mass-specc.coop</a></p>
    </div>
</body>
</html>
