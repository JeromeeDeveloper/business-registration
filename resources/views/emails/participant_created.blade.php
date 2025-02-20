<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <p>Hello {{ $name }},</p>
    <p>Your participant account has been successfully created. Below are your login details:</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>You can log in using the following link:</p>
    <p><a href="{{ $login_url }}">{{ $login_url }}</a></p>
    <p>Please change your password after logging in.</p>
    <p>Best regards,<br>Your Team</p>
</body>
</html>
