<!--=====HEADER START=======-->
<div class="header5-top d-none d-lg-block">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-4">
                <div class="icon-text">
                    <a href="#"><img src="{{ asset('frontend/img/icons/header5-top-icon1.png') }}" alt="">
                        info@routeonerecruitment.com</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="icon-text">
                    <a href="#"><img src="{{ asset('frontend/img/icons/header5-top-icon3.png') }}" alt="">
                        Monday - Friday 9:00 Am - 6:00 Pm </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-text">
                    <a href="tel:+442031378313"><img src="{{ asset('frontend/img/icons/header5-top-icon4.png') }}"
                            alt=""> Call Now: +44 20 313 78 313</a>
                </div>
            </div>

        </div>
    </div>
</div>

<header>
    <div class="header-area header-area5 header-area-all d-none d-lg-block" id="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-elements">
                        <div class="site-logo">
                            <a href="{{ route('/') }}">
                                <img src="{{ asset('frontend/img/logo/routeone_logo.svg') }}" alt=""
                                    class="company-logo">
                            </a>
                        </div>


                        <div class="main-menu-ex main-menu-ex1">
                            <ul>
                                <li><a class="{{ request()->is('/') ? 'active' : '' }}"
                                        href="{{ route('/') }}">Home</a></li>
                                <li><a class="{{ request()->is('about') ? 'active' : '' }}"
                                        href="{{ route('about') }}">About Us</a></li>
                                <li><a class="{{ request()->is('jobs') ? 'active' : '' }}"
                                        href="javascript:void(0)">Jobs</a></li>
                                <li><a class="{{ request()->is('services') ? 'active' : '' }}"
                                        href="{{ route('services') }}">Services</a></li>
                                <li><a class="{{ request()->is('contact') ? 'active' : '' }}"
                                        href="{{ route('contact') }}">Contact</a></li>







                            </ul>
                        </div>


                        @if (Auth::check())
                            <div class="header2-buttons">
                                <div class="button">
                                    <a class="theme-btn4" href="{{ route('dashboard') }}">My Account</a>
                                </div>
                            </div>
                        @else
                            <div class="header2-buttons">
                                <div class="button">
                                    <a class="theme-btn4" href="{{ route('user.login') }}">Sign In <span
                                            class="straight"><i class="fa-solid fa-right-to-bracket"></i></span></a>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--=====HEADER END=======-->
