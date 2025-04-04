<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>

    <img src="https://i.imgur.com/gsBSpUs.jpeg" alt="Signature Image" style="max-width: 70%; height: auto;" />

    <p>Hello {{ $name }},</p>
    <p>Your participant account has been successfully created from your cooperative. Below are your login details:</p>
    <p><strong>Participant Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>You can log in using the following link:</p>
    <p>
        <a href="http://eventregister.mass-specc.coop" class="styled-button" target="_blank">
          Login for the Event
        </a>
      </p>

      <style>
        .styled-button {
          display: inline-block;
          background-color: #007bff; /* Blue color */
          color: white;
          padding: 10px 20px;
          text-decoration: none;
          font-size: 16px;
          font-weight: bold;
          border-radius: 5px;
          transition: background 0.3s ease;
        }

        .styled-button:hover {
          background-color: #0056b3; /* Darker blue on hover */
        }
      </style>

<p>If you need assistance, please contact us at 0917-133-5218</a></p>

<p>Thank you.</p>

<hr>
<div>



    <!-- Signature Image -->
    <!-- First Signature Image -->
    <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4wvLE7Z259KZkYLTl4fj54VtU7p-zQ4jjAB9ZXkSAwUOFgAfT6LwPgnqjsOXo9LpNSC6IojBRszQ4Mm"
        alt="Signature Image" style="max-width: 250px; height: auto;" />

    <!-- Add Banner Image from Google Drive -->


    <p>The contents of this email message and any attachments are intended solely for the addressee(s) and may
        contain confidential and/or privileged information and may be legally protected from disclosure. If you
        are not the intended recipient of this message or their agent, or if this message has been addressed to
        you in error, please immediately alert the sender by reply email and then delete this message and any
        attachments. If you are not the intended recipient, you are hereby notified that any use, dissemination,
        copying, or storage of this message or its attachments is strictly prohibited.</p>

    <!-- Second Signature Image -->
    <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4y3f7vZ8XrGXNcxDBf4tYVurPLjYeeZt2kNny2Bwwzvi8OL66nmQ7o4LvVFkTijuDgTLV6e3DdOI0oA"
        alt="Second Signature Image" style="max-width: 250px; height: auto;" />
</div>

</body>
</html>
