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
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
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
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="button input-box">
                    <input type="button" value="Login" onclick="showAgreement()">
                </div>
                <div class="text sign-up-text">Sign in to access the General Assembly portal.
                    <label for="flip">Sign up</label>
                </div>
            </form>

        </div>
          <div class="signup-form">
            <img class="logo" src="{{asset('images/logo.png')}}" alt="">
            <div class="title">Signup</div>

            {{-- signup form --}}

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
function showAgreement() {
    Swal.fire({
        title: "Disclosure Agreement",
        html: `
            <p>By proceeding, you agree to the terms and conditions of this platform.</p>
            <label>
                <input type="checkbox" id="agreeCheckbox"> I agree to the terms and conditions
            </label>
        `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Proceed",
        cancelButtonText: "Cancel",
        preConfirm: () => {
            if (!document.getElementById('agreeCheckbox').checked) {
                Swal.showValidationMessage("You must agree before proceeding.");
                return false;
            }
            return true;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector(".login-form form").submit();
        }
    });
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
