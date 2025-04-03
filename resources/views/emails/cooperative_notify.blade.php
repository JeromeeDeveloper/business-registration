<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2025 CO-OPvention Online Registration Credentials</title>

</head>

<body>
    <div class="container">

        <img src="https://i.imgur.com/gsBSpUs.jpeg" alt="Signature Image" style="max-width: 70%; height: auto;" />

        <p><strong>Dear {{ $coop->name }},</strong></p>

        <div class="content">

            <p>This is an automated email from MASS-SPECC.
                {{-- Below are your credentials for the GA Online Registration: --}}
            </p>

            <p><strong>GA Registration Status:</strong>
                @if ($gaRegistration)
                    @if ($gaRegistration->registration_status === 'Rejected')
                        Not Registered
                    @else
                        {{ $gaRegistration->registration_status }}
                    @endif
                @else
                    Not Registered
                @endif
            </p>


            <p><strong>Membership Status:</strong>
                @if ($gaRegistration)
                    {{ $gaRegistration->membership_status }}
                @else
                    Not Available
                @endif
            </p>

            <p><strong>Registration Link: <a href="http://eventregister.mass-specc.coop/"
                        target="_blank">http://eventregister.mass-specc.coop/</a></strong></p>

            {{-- <p><strong>Username: {{ $coop->email }}</strong></p>

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


            <p>Important: Please log in and complete your registration by May 22, 2025. For security reasons, we
                recommend changing your password upon first login.</p>

                <p>If you need assistance, please contact us at 0917-133-5218</a></p>

            <p>Thank you.</p>

            <p>
                <em>This is a system-generated email. Please do not reply.</em>
            </p>
        </div>

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



    </div>
</body>

</html>
