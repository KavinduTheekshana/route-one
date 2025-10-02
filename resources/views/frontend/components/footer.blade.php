<div class="footer-cta5" style="background-image: url({{ asset('frontend/img/bg/footer5-bg.png') }});">


    <!--===== FOOTER AREA START =======-->

    <div class="footer5 _relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer-items footer-logo-area">
                        <div class="footer-logo">
                            <a href=""><img src="{{ asset('frontend/img/logo/routeone_logo_light.svg') }}"
                                    alt=""></a>
                        </div>
                        <div class="space20"></div>
                        <div class="heading1-w">
                            <p>We specialize in matching professionals with the right job opportunities for lasting
                                success.</p>
                        </div>
                        <ul class="social-icon">
                            <li><a href="https://www.facebook.com/profile.php?id=61562057005093" target="_blank"><i
                                        class="fa-brands fa-facebook"></i></a></li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Quick Links</h3>

                        <ul class="menu-list">
                            <li><a href="#">Terms & Condetions</a></li>
                            <li><a href="#">Q&A</a></li>
                            <li><a href="#">Testimonial</a></li>
                            <li><a href="{{ route('verify') }}">Verify Certificates</a></li>
                            <li><a href="{{ route('verify.draft') }}">Verify COS Draft</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg col-md-6 col-12">
                    <div class="single-footer-items pl-5">
                        <h3>Explore</h3>

                        <ul class="menu-list">
                            <li><a href="{{ route('/') }}">Home </a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('jobs') }}">Jobs</a></li>
                            <li><a href="{{ route('services') }}">Service</a></li>
                            <li><a href="{{ route('contact') }}">Contact US</a></li>
                            <li><a href="{{ route('policy') }}">Policy</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer-items">
                        <h3>Contact Us</h3>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/img/icons/phone-svgrepo-com.svg') }}" alt="">
                            </div>
                            <div class="pera">
                                <a href="tel:+442071836484">+44 20 7183 6484</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/img/icons/whatsapp-svgrepo-com.svg') }}" alt="">
                            </div>
                            <div class="pera">
                                <a href="https://wa.me/447376288689">+44 7376 288 689</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/img/icons/envelope-open-svgrepo-com.svg') }}"
                                    alt="">
                            </div>
                            <div class="pera">
                                <a href="mailto:info@routeonerecruitment.com">info@routeonerecruitment.com</a>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/img/icons/location-pin-svgrepo-com.svg') }}"
                                    alt="">
                            </div>
                            <div class="pera">
                                <a>No 81, Brakens Lane, <br>
                                    Derby, DE24 0AQ</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="space70"></div>
        </div>

        <div class="copyright-area _relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="coppyright">
                            <p>© Copyright {{ date('Y') }} - Route One Recruitement. All Right Reserved | Developed
                                by <a href="https://codexer.co.uk" target="_blank" rel="Codexer">Codexer</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--===== FOOTER AREA END =======-->
</div>
