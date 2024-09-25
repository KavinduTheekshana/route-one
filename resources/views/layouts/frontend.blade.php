<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route One Recruitement - Bridging the Gap Talent and Opportunity</title>

    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="{{ asset('backend/images/logo/favicon.svg') }}">


    <!--=====CSS=======-->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    @stack('styles')


    <!--=====JQUERY=======-->
    <script src="{{ asset('frontend/js/jquery-3-6-0.min.js') }}"></script>
    @vite(['', 'resources/js/app.js'])
</head>

<body class="body">


    <!-- Preloader Start -->
    {{-- <div class="preloader">
        <div class="loading-container">
            <div class="loading loading3"></div>
            <div id="loading-icon"><img src="{{ asset('frontend/img/logo//titel2.png')}}" alt=""></div>
        </div>
    </div> --}}
    <!-- Preloader End -->

    <!--=====progress END=======-->

    <div class="paginacontainer">

        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>

    <!--=====progress END=======-->

    @include('frontend.components.header')
    @include('frontend.components.mobile-header')



    @yield('content')



    @include('frontend.components.footer')


    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/fontawesome.js') }}"></script>
    <script src="{{ asset('frontend//js/jquery.countup.js') }}"></script>
    <script src="{{ asset('frontend/js/mobile-menu.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick-slider.js') }}"></script>
    <script src="{{ asset('frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('frontend/js/Splitetext.js') }}"></script>
    <script src="{{ asset('frontend/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('frontend/js/text-animation.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.lineProgressbar.js') }}"></script>
    <script src="{{ asset('frontend/js/tilt.jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>
