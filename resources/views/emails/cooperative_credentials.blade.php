<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperative Notification</title>
</head>
<body>
    <h1>Notification for Cooperative: {{ $coop->name }}</h1>

    <p>Dear {{ $coop->contact_person }},</p>

    <p>We are notifying you about an upcoming event related to your cooperative, as well as your cooperative credentials.</p>

    <h2>Event Details:</h2>
    <p>
        <strong>Event Name:</strong> {{ $event->title }}<br>
        <strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}<br>
        <strong>Event Location:</strong> {{ $event->location }}<br><br>
    </p>

    <h2>User Login Credentials:</h2>
    @if ($users->isEmpty())
        <p>No users found for this cooperative.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ str_replace(' ', '', $user->cooperative->name) }}GA2025</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p>
        We look forward to your participation in the event. If you have any questions, feel free to contact us.
    </p>
</body>
</html>
