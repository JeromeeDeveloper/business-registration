<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperative Notification</title>
</head>
<body>
    <h1>Notification for Cooperative: {{ $coop->name }}</h1>
    <p>
        Dear {{ $coop->contact_person }},
    </p>
    <p>
        We are notifying you about an upcoming event related to your cooperative.
    </p>
    <p>
        Cooperative Type: {{ $coop->type }}<br>
        Cooperative Email: {{ $coop->email }}<br>
        Cooperative Address: {{ $coop->address }}<br><br>

        <strong>Event Details:</strong><br>
        <strong>Event Name:</strong> {{ $event->title }}<br>
        <strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}<br>
        <strong>Event Location:</strong> {{ $event->location }}<br><br>

        We look forward to your participation in the event. Should you have any questions, please don't hesitate to reach out.
    </p>
</body>
</html>
