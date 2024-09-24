        <!--=====HERO AREA START =======-->

        <div class="common-hero" style="background-image: url({{ asset('frontend/img/bg/hero5-bg.png')}});">
            <div class="container main-hero-container">
                <div class="row">
                    <div class="col-lg-6 m-auto text-center">
                        <div class="main-heading">
                            <h1 class="color-white">@yield('page_name')</h1>
                            <div class="pages-intro">
                                <a class="color-white" href="{{ route('/') }}">Home </a>
                                <span class="color-white"><i class="fa-regular fa-angle-right"></i></span>
                                <p class="color-white">@yield('page_name')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=====HERO AREA END=======-->