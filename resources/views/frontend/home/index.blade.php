@extends('layouts.frontend')

@section('content')
    @include('frontend.home.slider')
    @include('frontend.home.about')
    @include('frontend.home.service')
    @include('frontend.home.companies')
    {{-- @include('frontend.home.testimonial') --}}


 <!--===== VIDEO AREA START =======-->

 <div class="video-area5" style="background-image: url(assets/img/bg/video-bg.png);">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="video-area-button">
            <a href="https://www.youtube.com/watch?v=Y8XpQpW5OVY" class="play-btn"><i class="fa-solid fa-play"></i></a>
            <p>Watch Our Working Video</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--===== VIDEO AREA END =======-->

   <!--===== TESTIMONIAL AREA START =======-->

<div class="tes2 pb120">
<div class="container">
<div class="row align-items-center tes5-bg" style="background-image: url(assets/img/bg/tes5-bg.png);">
<div class="col-lg-6">
<div class="image overlay-anim">
<img src="assets/img/testimonial/testimonial2-img.png" alt="">
</div>
</div>

<div class="col-lg-6">
<div class="heading2">
<span class="span" data-aos="zoom-in-left" data-aos-duration="700">Clients Testimonials</span>
<h2 class="text-anime-style-3">What Our Customer’s <br> Say About Us</h2>
</div>

<div class="space40"></div>
<div class="tes2-slider owl-carousel">
<div class="tes2-signle-slider">
<div class="icon">
<img src="assets/img/icons/tes2-icon.png" alt="">
</div>
<div class="heading">
<p>“Hear directly from our satisfied clients about their experiences working with us. Our dedication to finding the right talent, streamlining the hiring process, and fostering”</p>
</div>
<div class="bottom-area">
<div class="image-bottom">
  <img src="assets/img/testimonial/tes2-img.png" alt="">
</div>
<div class="heading-bottom">
  <h5>Matthew C. Lansberry <span>/ CEO & Founder</span></h5>
</div>
</div>
</div>

<div class="tes2-signle-slider">
<div class="icon">
<img src="assets/img/icons/tes2-icon.png" alt="">
</div>
<div class="heading">
<p>“Hear directly from our satisfied clients about their experiences working with us. Our dedication to finding the right talent, streamlining the hiring process, and fostering”</p>
</div>
<div class="bottom-area">
<div class="image-bottom">
  <img src="assets/img/testimonial/tes2-img.png" alt="">
</div>
<div class="heading-bottom">
  <h5>Matthew C. Lansberry <span>/ CEO & Founder</span></h5>
</div>
</div>
</div>

<div class="tes2-signle-slider">
<div class="icon">
<img src="assets/img/icons/tes2-icon.png" alt="">
</div>
<div class="heading">
<p>“Hear directly from our satisfied clients about their experiences working with us. Our dedication to finding the right talent, streamlining the hiring process, and fostering”</p>
</div>
<div class="bottom-area">
<div class="image-bottom">
  <img src="assets/img/testimonial/tes2-img.png" alt="">
</div>
<div class="heading-bottom">
  <h5>Matthew C. Lansberry <span>/ CEO & Founder</span></h5>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

<!--===== TESTIMONIAL AREA END =======-->


    <!--===== SERVICE BENEFITS AREA START =======-->

    <div class="service-benefits5 pb120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="heading5">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Service Benefits</span>
                        <h2 class="text-anime-style-3">Explore Our Value Proposition</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-left" data-aos-duration="900">Whether you're a small business or a large
                            corporation, our flexible staffing options and exceptional candidate matching ensure that you
                            find </p>
                    </div>
                </div>
            </div>

            <div class="space30"></div>
            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="700">
                    <div class="benefits-box">
                        <div class="icon">
                            <img src="assets/img/icons/service-benefit-icon1.png" alt="">
                        </div>
                        <div class="heading2">
                            <h4><a href="service-details.html">Industry-Specific Expertise</a></h4>
                            <div class="space16"></div>
                            <p>We streamline the recruitment process, saving you time </p>
                            <div class="space16"></div>
                            <a href="service-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="900">
                    <div class="benefits-box">
                        <div class="icon">
                            <img src="assets/img/icons/service-benefit-icon2.png" alt="">
                        </div>
                        <div class="heading2">
                            <h4><a href="service-details.html">Talent Acquisition Expertise</a></h4>
                            <div class="space16"></div>
                            <p>Discover the benefits of partnering with Recrute for all your staffing needs </p>
                            <div class="space16"></div>
                            <a href="service-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="1100">
                    <div class="benefits-box">
                        <div class="icon">
                            <img src="assets/img/icons/service-benefit-icon3.png" alt="">
                        </div>
                        <div class="heading2">
                            <h4><a href="service-details.html">Flexible Staffing Options</a></h4>
                            <div class="space16"></div>
                            <p>With our extensive industry expertise and personalized approach, </p>
                            <div class="space16"></div>
                            <a href="service-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in-up" data-aos-duration="800">
                    <div class="benefits-box">
                        <div class="icon">
                            <img src="assets/img/icons/service-benefit-icon4.png" alt="">
                        </div>
                        <div class="heading2">
                            <h4><a href="service-details.html">Personalized Staffing Solutions</a></h4>
                            <div class="space16"></div>
                            <p>Our dedicated team works closely with you to understand your unique </p>
                            <div class="space16"></div>
                            <a href="service-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--===== SERVICE BENEFITS AREA END =======-->

    <!--=====CONTACT AREA START=======-->

    <div class="contact5 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading5">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Contact Us</span>
                        <h2 class="text-anime-style-3">Get in Touch Let's Start the Conversation</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-right" data-aos-duration="700">We're here to help you find the right staffing
                            solutions for your needs. Whether you're a company looking to hire top talent or a candidate
                            seeking your next career opportunity,</p>

                        <div class="space10"></div>
                        <div class="contact3-box" data-aos="fade-right" data-aos-duration="900">
                            <div class="icon">
                                <img src="assets/img/icons/contact5-icon1.png" alt="">
                            </div>
                            <div class="heading4">
                                <h6>Gives us a Call</h6>
                                <h4><a href="tel:123-456-7890">123-456-7890</a></h4>
                            </div>
                        </div>

                        <div class="contact3-box" data-aos="fade-right" data-aos-duration="1100">
                            <div class="icon">
                                <img src="assets/img/icons/contact5-icon2.png" alt="">
                            </div>
                            <div class="heading4">
                                <h6>Send me Mail</h6>
                                <h4><a href="mailto:Consult@hotmail.com">Recrute@hotmail.com</a></h4>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact3-form" data-aos="zoom-out" data-aos-duration="900">
                        <div class="heading3-w">
                            <h5>Send us a Message</h5>
                            <div class="space16"></div>
                            <p>Feel free to reach out to us with any questions, inquiries, or staffing requirements you may
                                have. Our experienced</p>
                        </div>

                        <div class="space10"></div>

                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" placeholder="First Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="number" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-input">
                                        <input type="text" placeholder="Subject">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-input">
                                        <textarea rows="4" placeholder="Message"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="button">
                                        <button class="theme-btn4" type="submit">Submit Now <span><i
                                                    class="fa-solid fa-arrow-right"></i></span></button>
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====CONTACT AREA END=======-->

    <!--===== BLOG AREA START =======-->

    <div class="blog5 sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="heading5">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Our Blog & News</span>
                        <h2 class="text-anime-style-3"> Latest Trends in Talent Acquisition</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-left" data-aos-duration="900">Whether you're looking to navigate your career
                            path or enhance your organization's hiring practices, our blog is your go-to destination for
                            valuable insights </p>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="800">
                    <div class="blog2-box">
                        <div class="image overlay-anim">
                            <img src="assets/img/blog/blog2-img1.png" alt="">
                        </div>
                        <div class="heading5">
                            <div class="tags">
                                <a href="#"><img src="assets/img/icons/date2.png" alt=""> 16 August
                                    2023</a>
                                <a href="#"><img src="assets/img/icons/user2.png" alt=""> Ben Stokes</a>
                            </div>
                            <h4><a href="blog-details.html">Career Compass: Navigating Your Professional Path</a></h4>
                            <div class="space16"></div>
                            <p>Our blog covers a wide range of topics, from tips for optimizing your hiring process </p>
                            <div class="space16"></div>
                            <a href="blog-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="blog2-box" data-aos="zoom-in-up" data-aos-duration="700">
                        <div class="image overlay-anim">
                            <img src="assets/img/blog/blog2-img2.png" alt="">
                        </div>
                        <div class="heading5">
                            <div class="tags">
                                <a href="#"><img src="assets/img/icons/date2.png" alt=""> 16 August
                                    2023</a>
                                <a href="#"><img src="assets/img/icons/user2.png" alt=""> Ben Stokes</a>
                            </div>
                            <h4><a href="blog-details.html">Talent Chronicles: Stories from the Hiring Frontline</a></h4>
                            <div class="space16"></div>
                            <p>Whether you're a hiring manager looking to stay ahead of industry trends or a candidate </p>
                            <div class="space16"></div>
                            <a href="blog-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1100">
                    <div class="blog2-box">
                        <div class="image overlay-anim">
                            <img src="assets/img/blog/blog2-img3.png" alt="">
                        </div>
                        <div class="heading5">
                            <div class="tags">
                                <a href="#"><img src="assets/img/icons/date2.png" alt=""> 16 August
                                    2023</a>
                                <a href="#"><img src="assets/img/icons/user2.png" alt=""> Ben Stokes</a>
                            </div>
                            <h4><a href="blog-details.html">Recruitology: Where Recruitment Meets Technology</a></h4>
                            <div class="space16"></div>
                            <p>Stay tuned for regular updates and valuable insights from our team of staffing experts. </p>
                            <div class="space16"></div>
                            <a href="blog-details.html" class="learn">Read More <span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--===== BLOG AREA END =======-->
@endsection
