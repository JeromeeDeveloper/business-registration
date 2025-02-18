<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    @include('layouts.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('layouts.nav')
    <!-- Navbar End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="mb-5">
                        <img class="img-fluid w-100 rounded mb-5" src="img/blog-1.jpg" alt="">
                        <h1 class="mb-4">Diam dolor est labore duo ipsum clita sed et lorem tempor duo</h1>
                        <p>Sadipscing labore amet rebum est et justo gubergren. Et eirmod ipsum sit diam ut
                            magna lorem. Nonumy vero labore lorem sanctus rebum et lorem magna kasd, stet
                            amet magna accusam consetetur eirmod. Kasd accusam sit ipsum sadipscing et at at
                            sanctus et. Ipsum sit gubergren dolores et, consetetur justo invidunt at et
                            aliquyam ut et vero clita. Diam sea sea no sed dolores diam nonumy, gubergren
                            sit stet no diam kasd vero.</p>
                        <p>Voluptua est takimata stet invidunt sed rebum nonumy stet, clita aliquyam dolores
                            vero stet consetetur elitr takimata rebum sanctus. Sit sed accusam stet sit
                            nonumy kasd diam dolores, sanctus lorem kasd duo dolor dolor vero sit et. Labore
                            ipsum duo sanctus amet eos et. Consetetur no sed et aliquyam ipsum justo et,
                            clita lorem sit vero amet amet est dolor elitr, stet et no diam sit. Dolor erat
                            justo dolore sit invidunt.</p>
                        <p>Diam dolor est labore duo invidunt ipsum clita et, sed et lorem voluptua tempor
                            invidunt at est sanctus sanctus. Clita dolores sit kasd diam takimata justo diam
                            lorem sed. Magna amet sed rebum eos. Clita no magna no dolor erat diam tempor
                            rebum consetetur, sanctus labore sed nonumy diam lorem amet eirmod. No at tempor
                            sea diam kasd, takimata ea nonumy elitr sadipscing gubergren erat. Gubergren at
                            lorem invidunt sadipscing rebum sit amet ut ut, voluptua diam dolores at
                            sadipscing stet. Clita dolor amet dolor ipsum vero ea ea eos.</p>
                        <p>Voluptua est takimata stet invidunt sed rebum nonumy stet, clita aliquyam dolores
                            vero stet consetetur elitr takimata rebum sanctus. Sit sed accusam stet sit
                            nonumy kasd diam dolores, sanctus lorem kasd duo dolor dolor vero sit et. Labore
                            ipsum duo sanctus amet eos et. Consetetur no sed et aliquyam ipsum justo et,
                            clita lorem sit vero amet amet est dolor elitr, stet et no diam sit. Dolor erat
                            justo dolore sit invidunt.</p>
                    </div>
                    <!-- Blog Detail End -->


                </div>

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form Start -->

                    <!-- Search Form End -->

                     <!-- Category Start -->
                     <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Agenda 1</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Agenda 2</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Agenda 2</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Agenda 3</a>
                            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Agenda 4</a>
                        </div>
                    </div>
                    <!-- Category End -->



                    <!-- Image Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                    </div>
                    <!-- Image End -->


                    <!-- Plain Text Start -->
                    <div class="wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Plain Text</h3>
                        </div>
                        <div class="bg-light text-center" style="padding: 30px;">
                            <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                            <a href="" class="btn btn-primary py-2 px-4">Read More</a>
                        </div>
                    </div>
                    <!-- Plain Text End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Vendor Start -->
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
    <!-- Vendor End -->


    <!-- Footer Start -->
    @include('layouts.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
