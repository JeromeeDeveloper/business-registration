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
                <!-- Blog list Start -->
                <div class="col-lg-8">
                    <div class="row g-5">
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-1.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.6s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-2.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-3.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.6s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-1.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-2.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.6s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-3.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-1.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.6s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-2.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-3.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.6s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden">
                                    <img class="img-fluid" src="img/blog-1.jpg" alt="">
                                    <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">Web Design</a>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                        <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                    <h4 class="mb-3">Agenda</h4>
                                    <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow slideInUp" data-wow-delay="0.1s">
                            <nav aria-label="Page navigation">
                              <ul class="pagination pagination-lg m-0">
                                <li class="page-item disabled">
                                  <a class="page-link rounded-0" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                  </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link rounded-0" href="#" aria-label="Next">
                                    <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Blog list End -->

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Keyword">
                            <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
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

                    <!-- Recent Post Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Post</h3>
                        </div>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                            </a>
                        </div>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="img/blog-2.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                            </a>
                        </div>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="img/blog-3.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                            </a>
                        </div>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                            </a>
                        </div>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="img/blog-2.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                            </a>
                        </div>
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="img/blog-3.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet adipis elit
                            </a>
                        </div>
                    </div>
                    <!-- Recent Post End -->

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
