  <!--=====TESTIMONIAL AREA START=======-->

  <div class="tes4 sp">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6">
                  <div class="heading4">
                      <span class="span2" data-aos="zoom-in-left" data-aos-duration="800">Testimonial</span>
                      <h2 class="text-anime-style-3">What Our Clients Say</h2>
                      <div class="space16"></div>
                      <p data-aos="fade-right" data-aos-duration="1100">Their expertise and dedication to understanding
                          our unique needs resulted in us finding the perfect fit</p>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="tes7-buttons" data-aos="fade-up" data-aos-duration="800">
                      <button class="testimonial-prev-arrow1"><i class="fa-regular fa-arrow-left"></i></button>
                      <button class="testimonial-next-arrow1"><i class="fa-regular fa-arrow-right"></i></button>
                  </div>
              </div>
          </div>

          <div class="space60"></div>
          <div class="row">
              <div class="tes4-slider" data-aos="fade-up" data-aos-duration="1000">

                  @foreach ($testimonials as $testimonial)
                      <div class="single-slider">
                          <div class="single-slider-content heading4">
                              <ul class="stars">
                                  <li><i class="fa-solid fa-star"></i></li>
                                  <li><i class="fa-solid fa-star"></i></li>
                                  <li><i class="fa-solid fa-star"></i></li>
                                  <li><i class="fa-solid fa-star"></i></li>
                                  <li><i class="fa-solid fa-star"></i></li>
                              </ul>
                              <div class="pera">
                                <p>“{{ Str::limit($testimonial->review, 180) }}”</p>

                              </div>
                          </div>
                          <div class="bottom-heading">

                              <div class="image testimonial-image-about">
                                  <img src="{{ $testimonial->file_path ? asset('storage/' . $testimonial->file_path) : asset('backend/images/bg/default.png') }}" alt="">
                              </div>
                              <div class="heading4">
                                  <h4><a href="#">{{ $testimonial->name }}</a></h4>
                                  <p>{{ $testimonial->title }}</p>
                              </div>

                          </div>
                      </div>
                  @endforeach




              </div>
          </div>
      </div>
  </div>
  </div>

  <!--=====TESTIMONIAL AREA END=======-->
