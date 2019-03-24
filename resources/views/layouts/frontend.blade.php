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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('compiled/frontend/frontend.css') }}"> 
    <link href="{{URL::asset('frontend/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    @yield('styles')
</head>

<body data-spy="scroll" data-target="#navbar-example">
    <div id="preloader"></div>
    @include('frontend.partials.header')
    @include('frontend.partials.info_modal') @yield('content')
    @include('frontend.partials.footer')

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <script type="text/javascript" src="{{elixir('compiled/frontend/frontend.js')}}"></script>
    @yield('scripts')
</body>

</html> 