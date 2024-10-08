  <!--===== VIDEO AREA START =======-->

  <div class="video-area5" style="background-image: url({{ asset('frontend/img/bg/group.webp') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">

            </div>
        </div>
    </div>
</div>

<!--===== VIDEO AREA END =======-->

<!--===== TESTIMONIAL AREA START =======-->

<div class="tes2 pb120">
    <div class="container">
        <div class="row align-items-center tes5-bg"
            style="background-image: url({{ asset('frontend/img/bg/tes5-bg.png') }});">
            <div class="col-lg-6">
                <div class="image overlay-anim">
                    <img src="{{ asset('frontend/img/testimonial/testimonial2-img.webp') }}" alt="">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="heading2">
                    <span class="span" data-aos="zoom-in-left">What Our Clients Say</span>
                    <h2 class="text-anime-style-3">Trusted by Professionals <br> and Employers Alike</h2>
                </div>

                <div class="space40"></div>
                <div class="tes2-slider owl-carousel">

                    @foreach ($testimonials as $testimonial)
                    <div class="tes2-signle-slider">
                        <div class="icon">
                            <img src="{{ asset('frontend/img/icons/tes2-icon.png') }}" alt="">
                        </div>
                        <div class="heading">
                            <p>“{{$testimonial->review}}”
                            </p>
                        </div>
                        <div class="bottom-area">
                            <div class="image-bottom testimonial">
                                <img src="{{ $testimonial->file_path ? asset('storage/' . $testimonial->file_path) : asset('backend/images/bg/default.png') }}" alt="">
                            </div>
                            <div class="heading-bottom">
                                <h5>{{$testimonial->name}} <span>/ {{$testimonial->title}}</span></h5>
                            </div>
                        </div>
                    </div>

                    @endforeach



                </div>
            </div>
        </div>
    </div>
</div>

<!--===== TESTIMONIAL AREA END =======-->