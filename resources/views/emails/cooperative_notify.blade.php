<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2025 CO-OPvention Online Registration Credentials</title>
</head>

<body>
    <div class="container">

        <img src="https://i.imgur.com/gsBSpUs.jpeg" alt="Banner Image" style="max-width: 70%; height: auto;" />



        <div class="content">

            <hr>

            <p><strong>Dear {{ $coop->name }},</strong></p>

            <h3><strong>Registration Notice!</strong></h3>

            <p><strong>STATUS:</strong></p>
            <p><strong>Cooperative Name:</strong> {{ $coop->name }}</p>

            <p><strong>Registration Status:</strong>
                @if ($gaRegistration)
                    @if ($gaRegistration->registration_status === 'Rejected')
                        {{ strtoupper('Not Registered') }}
                    @else
                        {{ strtoupper($gaRegistration->registration_status) }}
                    @endif
                @else
                    {{ strtoupper('Not Registered') }}
                @endif
            </p>

            <p><strong>Membership Status:</strong>
                @if ($gaRegistration)
                    {{ strtoupper($gaRegistration->membership_status) }}
                @else
                    {{ strtoupper('Not Available') }}
                @endif
            </p>

            <p><strong>No. of Allowed Voting Delegates:</strong> {{ $coop->no_of_entitled_votes }}</p>

            <p><strong>No. of Registered Participants:</strong>
                {{ \App\Models\Participant::where('coop_id', $coop->coop_id)->count() }}
            </p>

            <p><strong>No. of Registered Voting Delegates:</strong>
                {{ \App\Models\Participant::where('coop_id', $coop->coop_id)->where('delegate_type', 'Voting')->count() }}
            </p>

            <!-- Login Credentials -->
            <h3>Login Credentials:</h3>
            <p><strong>Username:</strong> {{ $coop->email }}</p>

            <p><strong>Password:</strong>
                @if ($coop->users->isNotEmpty())
                    @php
                        $words = preg_split('/\s+/', trim($coop->users->first()->cooperative->name));
                        $acronym = '';
                        foreach ($words as $word) {
                            $acronym .= strtoupper($word[0]);
                        }
                    @endphp
                    {{ $acronym }}GA2025
                @else
                    DefaultGA2025
                @endif
            </p>

            <h3>Steps to Register:</h3>
            <ol>
                <li>Go to the Registration Link:
                    <a href="http://eventregister.mass-specc.coop/" target="_blank">
                        http://eventregister.mass-specc.coop/
                    </a>
                </li>
                <li>Enter your username and password to log in.</li>
                <li>CLICK "REGISTER PARTICIPANTS" to register a participant.</li>
                <li>Input the participant’s details.</li>
                <li>UPLOAD the required valid documents.</li>
                <li>CLICK "Submit" to complete the registration.</li>

            </ol>

            <p>✅ To view the list of participants, CLICK Participant → Participants on the left side of the screen.</p>
            <p>✅ To edit or delete a participant’s profile, CLICK the Edit/Delete button in the action list under the identified participant.</p>


            <p><strong>Important:</strong> Please log in and complete your registration by <strong>May 22, 2025</strong></p>

            <p>If you need assistance, please contact us at <strong>0917-133-5218</strong>.</p>

            <p>Thank you.</p>

            <p><em>This is a system-generated email. Please do not reply.</em></p>
        </div>

        <hr>

        <!-- Signature Image -->
        <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4wvLE7Z259KZkYLTl4fj54VtU7p-zQ4jjAB9ZXkSAwUOFgAfT6LwPgnqjsOXo9LpNSC6IojBRszQ4Mm"
            alt="Signature Image" style="max-width: 250px; height: auto;" />

        <p>The contents of this email message and any attachments are intended solely for the addressee(s) and may contain confidential and/or privileged information...</p>

        <!-- Second Signature Image -->
        <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4y3f7vZ8XrGXNcxDBf4tYVurPLjYeeZt2kNny2Bwwzvi8OL66nmQ7o4LvVFkTijuDgTLV6e3DdOI0oA"
            alt="Second Signature Image" style="max-width: 250px; height: auto;" />

    </div>
</body>

</html>
