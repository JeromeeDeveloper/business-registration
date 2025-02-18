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


    <!-- Navbar & Carousel Start -->
    @include('layouts.navbar')


    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{asset('images/assembly-1.jpg')}}" alt="General Assembly">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome to the</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">General Assembly 2025</h1>
                        <a href="{{route('login')}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Login Now</a>
                        <a href="{{url('/detail')}}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">View Agenda</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{asset('images/assembly-2.jpg')}}" alt="General Assembly">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Join Us Online</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">Engage, Collaborate, and Grow</h1>
                        <a href="https://www.facebook.com/MASS.SPECC" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Join Live</a>
                        <a href="contact" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Get Support</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Navbar & Carousel End -->


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


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Registered Participants</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-handshake text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Successful Assemblies</h5>
                            <h1 class="mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-user-tie text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Elected Officials</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">12345</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facts Start -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">About the Event</h5>
                        <h1 class="mb-0">MASS-SPECC General Assembly 2025</h1>
                    </div>
                    <p class="mb-4">
                        The **MASS-SPECC General Assembly** is an **annual gathering of cooperative members and affiliates across the country**.
                        This significant event is dedicated to **discussing cooperative sector issues, strengthening cooperative advocacies,
                        and sharing best practices**.
                        <br><br>
                        The assembly also marks the **election of new Board officers and committee members**, making it a crucial event for
                        shaping the future of cooperative leadership. Due to the growing number of attendees, a **streamlined online registration
                        system** is now in place to ensure an efficient registration process.
                    </p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Cooperative Sector Discussions</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Strengthening Coop Advocacy</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Best Practice Sharing</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Election of New Officers</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-calendar-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Event Date</h5>
                            <h4 class="text-primary mb-0">March 2025</h4>
                        </div>
                    </div>
                    <a href="login" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Login Now</a>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{asset('images/about.png')}}" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About End -->


    <!-- Features Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Why Attend?</h5>
                <h1 class="mb-0">Empowering Cooperatives for a Stronger Future</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-handshake text-white"></i>
                            </div>
                            <h4>Cooperative Networking</h4>
                            <p class="mb-0">Connect with cooperative leaders and members nationwide to exchange ideas, strategies, and best practices.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-chart-line text-white"></i>
                            </div>
                            <h4>Leadership Development</h4>
                            <p class="mb-0">Gain insights from industry experts and participate in discussions that shape the future of cooperative governance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-laptop text-white"></i>
                            </div>
                            <h4>Seamless Online Registration</h4>
                            <p class="mb-0">Our easy-to-use online portal ensures a hassle-free registration experience, saving you time and effort.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-headset text-white"></i>
                            </div>
                            <h4>Dedicated Support Team</h4>
                            <p class="mb-0">Need assistance? Our support team is available to help with any questions regarding the event or registration.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Start -->

<!-- General Assembly Start -->
{{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">General Assembly</h5>
            <h1 class="mb-0">Meet the Participants of Our General Assembly</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="img/participant-1.jpg" style="width: 60px; height: 60px;">
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">John Doe</h4>
                        <small class="text-uppercase">Department of IT</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                    "Excited to collaborate and discuss new initiatives in this assembly!"
                </div>
            </div>
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="img/participant-2.jpg" style="width: 60px; height: 60px;">
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Jane Smith</h4>
                        <small class="text-uppercase">HR Department</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                    "A great opportunity to connect and strategize for the future!"
                </div>
            </div>
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="img/participant-3.jpg" style="width: 60px; height: 60px;">
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Michael Johnson</h4>
                        <small class="text-uppercase">Finance Team</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                    "Looking forward to insightful discussions in this assembly."
                </div>
            </div>
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="img/participant-4.jpg" style="width: 60px; height: 60px;">
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Emily Davis</h4>
                        <small class="text-uppercase">Marketing & PR</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                    "Honored to be part of this impactful gathering!"
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- General Assembly End -->




    <!-- Agenda Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Agenda</h5>
                <h1 class="mb-0">Review the Latest Topics for Discussion</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="agenda-item bg-light rounded overflow-hidden">
                        <div class="agenda-img position-relative overflow-hidden">
                            <img class="img-fluid size" src="{{asset('images/agenda-1.jpg')}}" alt="">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Meeting Topic</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">Strategic Planning Overview</h4>
                            <p>Discussion on key objectives and goals for the upcoming quarter.</p>
                            <a class="text-uppercase" href="">View Details <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="agenda-item bg-light rounded overflow-hidden">
                        <div class="agenda-img position-relative overflow-hidden">
                            <img class="img-fluid size" src="{{asset('images/agenda-2.jpg')}}" alt="">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Meeting Topic</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>Jane Smith</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">Budget Allocation Review</h4>
                            <p>Analyzing current financials and resource distribution for projects.</p>
                            <a class="text-uppercase" href="">View Details <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="agenda-item bg-light rounded overflow-hidden">
                        <div class="agenda-img position-relative overflow-hidden">
                            <img class="img-fluid size" src="{{asset('images/agenda-3.jpg')}}" alt="">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Meeting Topic</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>Michael Brown</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">Policy and Compliance Updates</h4>
                            <p>Review of new regulations and their impact on operations.</p>
                            <a class="text-uppercase" href="">View Details <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agenda Start -->


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
