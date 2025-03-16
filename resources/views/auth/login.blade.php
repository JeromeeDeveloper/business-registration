<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mass Specc Login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
</head>
<body>
    @include('layouts.navbar')
    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div> --}}
    <section class="content">
    <div class="container_login">
      <input type="checkbox" id="flip">
      <div class="cover">
        <div class="front">
            <img class="backImg" src="{{asset('images/assembly-1.jpg')}}" alt="">
          <div class="text">
            <span class="text-1">Join the movement, <br> shape the future</span>
            <span class="text-2">Be part of the assembly</span>
          </div>
        </div>
        <div class="back">
            <img class="backImg" src="{{asset('images/agenda-3.jpg')}}" alt="">
          <div class="text">
            <span class="text-1">Every voice matters, <br> every decision counts</span>
            <span class="text-2">Let's get started</span>
          </div>
        </div>
      </div>
      <div class="forms">
          <div class="form-content">
            <div class="login-form">
                <img class="logo1" src="{{asset('images/logo.png')}}" alt="">
              <div class="title">Login</div>
                    {{-- login form --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box position-relative">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-2" id="togglePassword" style="cursor: pointer;"></i>
                </div>
                <div class="button input-box">
                    <input type="button" value="Login" onclick="showAgreement()">
                </div>

                <div class="text sign-up-text">
                    Sign in to access the General Assembly portal.
                    <br>By continuing, you agree to our
                    <a href="#" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal" style="color: rgb(47, 0, 255);">Privacy Policy</a>
                    <!-- Modal -->
                </div>
                {{-- <div class="text sign-up-text">Sign in to access the General Assembly portal.
                    <label for="flip">Sign up</label>
                </div> --}}
            </form>



        </div>
          <div class="signup-form">
            <img class="logo" src="{{asset('images/logo.png')}}" alt="">
            <div class="title">Signup</div>

           

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>

                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="button input-box">
                    <input type="submit" value="Register">
                </div>
                <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </form>

      </div>
      </div>
      </div>
    </div>

</section>

<div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyPolicyModalLabel"><img class="logo_modal" src="{{asset('images/logo.png')}}" alt=""></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <h3>Data Privacy Notice</h3>
                <p>This notice is intended to inform you that when you visit our website or engage in transactions with MASS-SPECC, we may process your personal data.</p>

                <h4>Personal Information Collected</h4>
                <p>MASS-SPECC understands the importance of securing your personal information and is committed to respecting your privacy.</p>
                <p><strong>Personal Information may include, but is not limited to:</strong></p>
                <ul>
                    <li>Your name, gender, birthday, marital status, employment details, social security, tax identification number, home address, e-mail address, contact information and other information from which your identity is apparent or can be reasonably and directly ascertained;</li>
                    <li>Certain technical information, such us, but not limited to, IP addresses, internet browser used, and web pages accessed, your login information and Information about your visit to our websites including the full Uniform Resource Locators (URL) clickstream to, through and from our websites (including date and time), products you viewed or searched for, pages you accessed, page response times, download errors, lengths of visits to certain pages, page interaction information (such as scrolling, clicks and mouse-ovens), and methods used to browse away from the page;</li>
                    <li>Transaction details and payment information</li>
                    <li>Payment, remittances and fund transfers done for our services, such as credit/debit card number and expiry date;</li>
                    <li>Information collected about your participation in our promotions and competitions or attendance at our events, recordings you or we have made, details of your guests in connection with any promotions and competitions you have entered, or other information related to your attendance at events, including any access assistance requirements you may have;</li>
                    <li>Marketing and communication preference and information to help us determine what products and services may be of interest to you;</li>
                    <li>Information about your use of our chat rooms, message boards, social media pages or other interactive forums including any comments, photos, videos or other information that you post online;</li>
                    <li>Correspondence with you including any feedback, complaints and comments from you via telephone, email or social media, or records of any online, paper or in-person correspondence and interactions between us. If you have communicated with us by phone, we will collect details of the phone number you used to call us and any information collected via a call recording; and</li>
                    <li>Credit and anti-fraud information relating to your financial situation, your creditworthiness or any criminal or fraudulent activities provided to us by you or third parties.</li>
                </ul>

                <h4>Your Consent</h4>
                <p>By using the MASS-SPECC websites, mobile applications and other online services, you are consenting to the collection, storage, use, processing and disclosure of your Personal Information by MASS-SPECC.</p>

                <h4>Use of Personal Information</h4>
                <p>MASS-SPECC shall use your Personal Information to provide you with details and information regarding our products and services; to conduct billing processing and other business transactions; to provide and manage products and services you have requested to; to communicate effectively with you; to monitor activities and record our correspondence with you; to provide you with marketing materials; to understand our customers; and to develop and tailor our products and services; to run our promotions and our events; to prevent fraud; to conduct certain checks on you, such as KYC and credit checks; to improve and administer our websites, and to ensure that content is relevant; to reorganize or make changes to our services and to comply with legal and regulatory obligations.</p>
                <p>MASS-SPECC may disclose your Personal Information to third party service providers (such as providers of marketing, IT or administrative services) who may process it on our behalf for any of the purposes set out above.</p>
                  <p><strong>MASS-SPECC may also disclose your Personal Information under any of the following circumstances:</strong></p>
                    <ul>
                        <li>Required by law or by court decisions/processes;</li>
                        <li>for information, update and marketing purposes; and</li>
                        <li>for research purposes.</li>
                    </ul>
                <h4>PERIOD OF STORAGE OF PERSONAL INFORMATION</h4>
                <p>The Personal Information that MASS-SPECC holds about you will not be kept for longer than is permitted by law and will only be kept for as long as necessary to provide you with any requested products, services or information, in addition thereto, we may retain certain transaction details and correspondence until the time limit for claims arising from the transaction has expired, or to comply with regulatory requirements regarding the retention of such data.</p>

                <h4>SAFEGUARD PERSONAL INFORMATION</h4>
                <p>MASS-SPECC will take all steps reasonably necessary to ensure that your Personal Information is treated securely and in accordance with this privacy notice.
                    Where a password enables you to access certain parts of our websites, you are responsible for keeping this password confidential.
                    Unfortunately, the transmission of information via the Internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your personal data transmitted to our websites. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorized access.</p>

                <h4>YOUR DATA PRIVACY RIGHTS</h4>
                <p>You have the right to be informed, to access, update or correct your personal data, withdraw your consent, request the disposal of your personal data subject to regulatory limitations, request a copy of your data in an electronic format, claim damages for violations of your data privacy rights, and raise data privacy concerns.</p>
                <p> If you intend to exercise any of your data privacy rights, you can reach out our Data Protection Officer through this email ad, <a href="mailto:privacy@mass-specc.coop">privacy@mass-specc.coop</a>.</p>

                <h4>CHANGES TO THIS PRIVACY NOTICE</h4>
                <p>MASS-SPECC reserves the right to change this Privacy Notice from time to time. Please check back frequently to see any updates or changes.</p>

                <p><strong>Data Protection Officer</strong><br>
                MASS-SPECC Cooperative Development Center</p>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5 mb-5">
        <div class="bg-white">
            <div class="owl-carousel vendor-carousel">
                <img src="images/vendor-1.jpg" alt="">
                <img src="images/vendor-2.jpg" alt="">
                <img src="images/vendor-3.jpg" alt="">
                <img src="images/vendor-4.jpg" alt="">
                <img src="images/vendor-5.jpg" alt="">
                <img src="images/vendor-6.jpg" alt="">
                <img src="images/vendor-7.jpg" alt="">
                <img src="images/vendor-8.jpg" alt="">
                <img src="images/vendor-9.jpg" alt="">
                <img src="images/vendor-10.jpg" alt="">
                <img src="images/vendor-11.jpg" alt="">
                <img src="images/vendor-12.jpg" alt="">
                <img src="images/vendor-13.jpg" alt="">
                <img src="images/vendor-15.jpg" alt="">
                <img src="images/vendor-14.jpg" alt="">
                <img src="images/vendor-16.jpg" alt="">
                <img src="images/vendor-17.jpg" alt="">
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordInput = document.getElementById("password");
        let icon = this;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>

<script>
function showAgreement() {
    // Show a success message after login
    Swal.fire({
        title: "Logging In...",
        text: "Please wait while we log you in.",
        icon: "info",
        timer: 1500,
        showConfirmButton: false
    });

    // Submit the form after a short delay
    setTimeout(() => {
        document.querySelector("form").submit();
    }, 1500);
}


function openPrivacyPolicyModal() {
    let modal = document.getElementById("privacy-policy-modal");
    if (modal) {
        modal.style.display = "block";
    }
}

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Show error alert if login fails
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: '{{ session("error") }}'
        });
        @endif
    });
</script>

  </body>
</html>
