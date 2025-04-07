<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2025 MASS-SPECC CO-OPVENTION REGISTRATION NOTICE</title>
</head>

<body>
    <div class="container">

        <img src="https://i.imgur.com/gsBSpUs.jpeg" alt="Banner Image" style="max-width: 70%; height: auto;" />



        <div class="content">

            <hr>

            <p><strong>2025 MASS-SPECC CO-OPVENTION REGISTRATION  NOTICE(Edcom Forum, Sectoral Congress, 55th Co-op Leaders' Congress, and 51st General Assembly)</strong></p>

            <p>Co-operative greetings from MASS-SPECC!</p>

            <p>Thank you for taking the time to register for our upcoming CO-OPvention. We're excited to have you with us. Please see below the latest update on your registration.</p>

            <p><strong>REGISTRATION STATUS</strong></p>

            <p><strong>Cooperative Name:</strong> {{ $coop->name }}</p>
            <p><strong>GA Registration Status:</strong>
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


            {{-- <h3>Login Credentials:</h3>
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
            </p> --}}

            <h3>Need to register more participants? Here's how:</h3>
            <ol>
                <li>Click the Registration Link:
                    <a href="http://eventregister.mass-specc.coop/" target="_blank">
                        https://eventregister.mass-specc.coop/
                    </a>
                </li>
                <li>Log in using your co-op's username and password</li>
                <li>Click "REGISTER PARTICIPANTS"</li>
                <li>Fill in the participant details</li>
                <li>Click "SUBMIT" to confirm</li>

            </ol>

            <p>Helpful Reminders:</p>

            <p>✅ To view your co-op's list of participants, click <strong>Participant → Participants</strong> on the left side of the screen.</p>
            <p>✅ To edit or remove a participant’s profile, simply click the <strong>Edit/Delete</strong> button in the action list under the identified participant. Kindly take note that editing of participant details is only allowed until May 17, 2025.</p>




            <p>If you need any assistance, feel free to reach out to our Member Support Unit at <strong>0917-133-5218.</strong> We're here to help!</p>

            <p>We look forward to your presence at the upcoming CO-OPvention!</p>

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
