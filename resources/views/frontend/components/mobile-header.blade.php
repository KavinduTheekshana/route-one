    <!--=====Mobile header start=======-->
    <div class="mobile-header mobile-header-main d-block d-lg-none ">
        <div class="container-fluid">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">
                        <a href="{{ route('/') }}"><img src="{{ asset('frontend/img/logo/routeone_logo.svg') }}"
                                alt=""></a>
                    </div>
                    <div class="mobile-nav-icon">
                        <i class="fa-duotone fa-bars-staggered"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-sidebar d-block d-lg-none">
        <div class="logo-m">
            <a href="{{ route('/') }}"><img src="{{ asset('frontend/img/logo/routeone_logo.svg') }}"
                    alt=""></a>
        </div>
        <div class="menu-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-nav">

            <ul>

                <li><a class="{{ request()->is('/') ? 'active-mob' : '' }}" href="{{ route('/') }}">Home</a></li>
                <li><a class="{{ request()->is('about') ? 'active-mob' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li><a class="{{ request()->is('jobs') ? 'active-mob' : '' }}" href="{{ route('jobs') }}">Jobs</a></li>
                <li><a class="{{ request()->is('services') ? 'active-mob' : '' }}"
                        href="{{ route('services') }}">Services</a></li>
                <li><a class="{{ request()->is('contact') ? 'active-mob' : '' }}"
                        href="{{ route('contact') }}">Contact</a></li>


            </ul>

            <hr>

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

        <hr>

            <div class="single-footer-items">
                <h3>Contact Us</h3>

                <div class="contact-box">
                    <div class="icon">
                        <img src="{{ asset('frontend/img/icons/footer-icon1.png') }}" alt="">
                    </div>
                    <div class="pera">
                        <a href="tel:+442031378313">+44 20 313 78 313</a>
                    </div>
                </div>

                <div class="contact-box">
                    <div class="icon">
                        <img src="{{ asset('frontend/img/icons/footer-icon2.png') }}" alt="">
                    </div>
                    <div class="pera">
                        <a href="mailto:info@routeonerecruitment.com">info@routeonerecruitment.com</a>
                    </div>
                </div>

                <div class="contact-box">
                    <div class="icon">
                        <img src="{{ asset('frontend/img/icons/footer-icon3.png"') }}' alt="">
                    </div>
                    <div class="pera">
                        <a href="#">24 Colston Rise, Ampthill, <br> Bedford, England MK45 2GN</a>
                    </div>
                </div>

            </div>



            <div class="contact-infos">
                <h3>Social Media</h3>
                <ul class="social-icon">
                    <li><a href="https://www.facebook.com/profile.php?id=61562057005093" target="_blank"><i
                                class="fa-brands fa-facebook"></i></a></li>
                </ul>
            </div>

        </div>
    </div>

    <!--=====Mobile header end=======-->
