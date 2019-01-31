<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{URL::asset('frontend/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{URL::asset('frontend/lib/nivo-slider/css/nivo-slider.css')}}" rel="stylesheet">
    <link href="{{URL::asset('frontend/lib/owlcarousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{URL::asset('frontend/lib/owlcarousel/owl.transitions.css')}}" rel="stylesheet">
    <link href="{{URL::asset('frontend/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('frontend/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('frontend/lib/venobox/venobox.css')}}" rel="stylesheet">

    <!-- Nivo Slider Theme -->
    <link href="{{URL::asset('frontend/css/nivo-slider-theme.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{URL::asset('frontend/css/style.css')}}" rel="stylesheet">

    <!-- Responsive Stylesheet File -->
    <link href="{{URL::asset('frontend/css/responsive.css')}}" rel="stylesheet">
     @yield('styles')
</head>

<body data-spy="scroll" data-target="#navbar-example">

    <div id="preloader"></div>
    @include('frontend.partials.header')
    @include('frontend.partials.info_modal') 
    
    @yield('content') 



    <!-- Start reviews Area -->
    <div class="reviews-area hidden-xs">
        <div class="work-us">
            <div class="work-left-text">
                <a href="#">
						<img src="img/about/2.jpg" alt="">
					</a>
            </div>
            <div class="work-right-text text-center">
                <h2>working with us</h2>
                <h5>Web Design, Ready Home, Construction and Co-operate Outstanding Buildings.</h5>
                <a href="#contact" class="ready-btn">Contact us</a>
            </div>
        </div>
    </div>
    <!-- End reviews Area -->

    <!-- Start portfolio Area -->
    <div id="portfolio" class="portfolio-area area-padding fix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-center">
                        <h2>Our Portfolio</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Start Portfolio -page -->
                <div class="awesome-project-1 fix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="awesome-menu ">
                            <ul class="project-menu">
                                <li>
                                    <a href="#" class="active" data-filter="*">All</a>
                                </li>
                                <li>
                                    <a href="#" data-filter=".development">Development</a>
                                </li>
                                <li>
                                    <a href="#" data-filter=".design">Design</a>
                                </li>
                                <li>
                                    <a href="#" data-filter=".photo">Photoshop</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="awesome-project-content">
                    <!-- single-awesome-project start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 design development">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="img/portfolio/1.jpg" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="venobox" data-gall="myGallery" href="img/portfolio/1.jpg">
                                            <h4>Business City</h4>
                                            <span>Web Development</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-awesome-project end -->
                    <!-- single-awesome-project start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 photo">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="img/portfolio/2.jpg" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="venobox" data-gall="myGallery" href="img/portfolio/2.jpg">
                                            <h4>Blue Sea</h4>
                                            <span>Photosho</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-awesome-project end -->
                    <!-- single-awesome-project start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 design">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="img/portfolio/3.jpg" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="venobox" data-gall="myGallery" href="img/portfolio/3.jpg">
                                            <h4>Beautiful Nature</h4>
                                            <span>Web Design</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-awesome-project end -->
                    <!-- single-awesome-project start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 photo development">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="img/portfolio/4.jpg" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="venobox" data-gall="myGallery" href="img/portfolio/4.jpg">
                                            <h4>Creative Team</h4>
                                            <span>Web design</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-awesome-project end -->
                    <!-- single-awesome-project start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 development">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="img/portfolio/5.jpg" alt="" /></a>
                                <div class="add-actions text-center text-center">
                                    <div class="project-dec">
                                        <a class="venobox" data-gall="myGallery" href="img/portfolio/5.jpg">
                                            <h4>Beautiful Flower</h4>
                                            <span>Web Development</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-awesome-project end -->
                    <!-- single-awesome-project start -->
                    <div class="col-md-4 col-sm-4 col-xs-12 design photo">
                        <div class="single-awesome-project">
                            <div class="awesome-img">
                                <a href="#"><img src="img/portfolio/6.jpg" alt="" /></a>
                                <div class="add-actions text-center">
                                    <div class="project-dec">
                                        <a class="venobox" data-gall="myGallery" href="img/portfolio/6.jpg">
                                            <h4>Night Hill</h4>
                                            <span>Photoshop</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-awesome-project end -->
                </div>
            </div>
        </div>
    </div>
    <!-- awesome-portfolio end -->
    <!-- start pricing area -->
    <div id="pricing" class="pricing-area area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-center">
                        <h2>Pricing Table</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pri_table_list">
                        <h3>basic <br/> <span>$80 / month</span></h3>
                        <ol>
                            <li class="check">Online system</li>
                            <li class="check cross">Full access</li>
                            <li class="check">Free apps</li>
                            <li class="check">Multiple slider</li>
                            <li class="check cross">Free domin</li>
                            <li class="check cross">Support unlimited</li>
                            <li class="check">Payment online</li>
                            <li class="check cross">Cash back</li>
                        </ol>
                        <button>sign up now</button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pri_table_list active">
                        <span class="saleon">top sale</span>
                        <h3>standard <br/> <span>$110 / month</span></h3>
                        <ol>
                            <li class="check">Online system</li>
                            <li class="check">Full access</li>
                            <li class="check">Free apps</li>
                            <li class="check">Multiple slider</li>
                            <li class="check cross">Free domin</li>
                            <li class="check">Support unlimited</li>
                            <li class="check">Payment online</li>
                            <li class="check cross">Cash back</li>
                        </ol>
                        <button>sign up now</button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="pri_table_list">
                        <h3>premium <br/> <span>$150 / month</span></h3>
                        <ol>
                            <li class="check">Online system</li>
                            <li class="check">Full access</li>
                            <li class="check">Free apps</li>
                            <li class="check">Multiple slider</li>
                            <li class="check">Free domin</li>
                            <li class="check">Support unlimited</li>
                            <li class="check">Payment online</li>
                            <li class="check">Cash back</li>
                        </ol>
                        <button>sign up now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pricing table area -->
    <!-- Start Testimonials -->
    <div class="testimonials-area">
        <div class="testi-inner area-padding">
            <div class="testi-overly"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Start testimonials Start -->
                        <div class="testimonial-content text-center">
                            <a class="quate" href="#"><i class="fa fa-quote-right"></i></a>
                            <!-- start testimonial carousel -->
                            <div class="testimonial-carousel">
                                <div class="single-testi">
                                    <div class="testi-text">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar luctus est eget congue.<br>consectetur
                                            adipiscing elit. Sed pulvinar luctus est eget congue.
                                        </p>
                                        <h6>Boby</h6>
                                    </div>
                                </div>
                                <!-- End single item -->
                                <div class="single-testi">
                                    <div class="testi-text">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar luctus est eget congue.<br>consectetur
                                            adipiscing elit. Sed pulvinar luctus est eget congue.
                                        </p>
                                        <h6>Jhon</h6>
                                    </div>
                                </div>
                                <!-- End single item -->
                                <div class="single-testi">
                                    <div class="testi-text">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar luctus est eget congue.<br>consectetur
                                            adipiscing elit. Sed pulvinar luctus est eget congue.
                                        </p>
                                        <h6>Fleming</h6>
                                    </div>
                                </div>
                                <!-- End single item -->
                            </div>
                        </div>
                        <!-- End testimonials end -->
                    </div>
                    <!-- End Right Feature -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials -->
    <!-- Start Suscrive Area -->
    <div class="suscribe-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
                    <div class="suscribe-text text-center">
                        <h3>Welcome to our eBusiness company</h3>
                        <a class="sus-btn" href="#">Get A quate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Suscrive Area -->
    <!-- Start contact Area -->
    <div id="contact" class="contact-area">
        <div class="contact-inner area-padding">
            <div class="contact-overly"></div>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-headline text-center">
                            <h2>Contact us</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Start contact icon column -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-icon text-center">
                            <div class="single-icon">
                                <i class="fa fa-mobile"></i>
                                <p>
                                    Call: +1 5589 55488 55<br>
                                    <span>Monday-Friday (9am-5pm)</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Start contact icon column -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-icon text-center">
                            <div class="single-icon">
                                <i class="fa fa-envelope-o"></i>
                                <p>
                                    Email: info@example.com<br>
                                    <span>Web: www.example.com</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Start contact icon column -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-icon text-center">
                            <div class="single-icon">
                                <i class="fa fa-map-marker"></i>
                                <p>
                                    Location: A108 Adam Street<br>
                                    <span>NY 535022, USA</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- Start Google Map -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- Start Map -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452"
                            width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
                        <!-- End Map -->
                    </div>
                    <!-- End Google Map -->

                    <!-- Start  contact -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form contact-form">
                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                            <div id="errormessage"></div>
                            <form action="" method="post" role="form" class="contactForm">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                    />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"
                                    />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject"
                                    />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                    <div class="validation"></div>
                                </div>
                                <div class="text-center"><button type="submit">Send Message</button></div>
                            </form>
                        </div>
                    </div>
                    <!-- End Left contact -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->

    <!-- Start Footer bottom Area -->
    <footer>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="footer-content">
                            <div class="footer-head">
                                <div class="footer-logo">
                                    <h2><span>e</span>Business</h2>
                                </div>

                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                                    totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
                                <div class="footer-icons">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end single footer -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="footer-content">
                            <div class="footer-head">
                                <h4>information</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                                </p>
                                <div class="footer-contacts">
                                    <p><span>Tel:</span> +123 456 789</p>
                                    <p><span>Email:</span> contact@example.com</p>
                                    <p><span>Working Hours:</span> 9am-5pm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end single footer -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="footer-content">
                            <div class="footer-head">
                                <h4>Instagram</h4>
                                <div class="flicker-img">
                                    <a href="#"><img src="img/portfolio/1.jpg" alt=""></a>
                                    <a href="#"><img src="img/portfolio/2.jpg" alt=""></a>
                                    <a href="#"><img src="img/portfolio/3.jpg" alt=""></a>
                                    <a href="#"><img src="img/portfolio/4.jpg" alt=""></a>
                                    <a href="#"><img src="img/portfolio/5.jpg" alt=""></a>
                                    <a href="#"><img src="img/portfolio/6.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-area-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="copyright text-center">
                            <p>
                                &copy; Copyright <strong>eBusiness</strong>. All Rights Reserved
                            </p>
                        </div>
                        <div class="credits">
                            <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eBusiness
              -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="{{URL::asset('frontend/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/venobox/venobox.min.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/knob/jquery.knob.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/wow/wow.min.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/parallax/parallax.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/nivo-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('frontend/lib/appear/jquery.appear.js')}}"></script>
    <script src="{{URL::asset('frontend/lib/isotope/isotope.pkgd.min.js')}}"></script>

    <!-- Contact Form JavaScript File -->
    <script src="{{URL::asset('frontend/contactform/contactform.js')}}"></script>

    <script src="{{URL::asset('frontend/js/main.js')}}"></script>
    @yield('scripts')
</body>

</html>