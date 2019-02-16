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
    <link href="{{URL::asset('frontend/css/responsive.css')}}" rel="stylesheet"> @yield('styles')
</head>

<body data-spy="scroll" data-target="#navbar-example">
    <div id="preloader"></div>
    @include('frontend.partials.header')
    @include('frontend.partials.info_modal') @yield('content')
    @include('frontend.partials.footer')

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