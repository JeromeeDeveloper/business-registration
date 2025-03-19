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
            <strong>Event Name:</strong> 51st General Assembly<br>
            <strong>Event Date:</strong> May 25, 2025<br>
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
                        <td>
                            @if ($user->cooperative)
                                @php
                                    $words = preg_split('/\s+/', trim($user->cooperative->name));
                                    $acronym = '';
                                    foreach ($words as $word) {
                                        $acronym .= strtoupper($word[0]);
                                    }
                                @endphp
                                {{ $acronym }}GA2025
                            @else
                                DefaultGA2025
                            @endif
                        </td>

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
