    <!--=====CONTACT AREA START=======-->

    <div class="contact5 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading5">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Get in Touch</span>
                        <h2 class="text-anime-style-3">We’re Here to Help</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-right" data-aos-duration="700">Need assistance or have questions? Contact
                            Route One Recruitment Services Ltd, and our team will be happy to help with your recruitment
                            needs. Let's connect!</p>

                        <div class="space10"></div>
                        <div class="contact3-box" data-aos="fade-right" data-aos-duration="900">
                            <div class="icon">
                                <img class="contact-icon" src="{{ asset('frontend/img/icons/phone-svgrepo-com.svg')}}" alt="">
                            </div>
                            <div class="heading4">
                                <h6>Give Us a Call</h6>
                                <h4><a href="tel:+442071836484">+44 20 7183 6484</a></h4>
                            </div>
                        </div>

                        <div class="contact3-box" data-aos="fade-right" data-aos-duration="900">
                            <div class="icon">
                                <img class="contact-icon" src="{{ asset('frontend/img/icons/whatsapp-svgrepo-com.svg')}}" alt="">
                            </div>
                            <div class="heading4">
                                <h6>Message Us on WhatsApp</h6>
                                <h4><a href="https://wa.me/447376288689" target="_blank">+44 7376 288 689</a></h4>
                            </div>
                        </div>

                        <div class="contact3-box" data-aos="fade-right" data-aos-duration="1100">
                            <div class="icon">
                                <img class="contact-icon" src="{{ asset('frontend/img/icons/envelope-open-svgrepo-com.svg')}}" alt="">
                            </div>
                            <div class="heading4">
                                <h6>Send Us an Email</h6>
                                <h4><a href="mailto:Consult@hotmail.com">info@routeonerecruitment.com</a></h4>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact3-form" data-aos="zoom-out" data-aos-duration="900">
                        <div class="heading3-w">
                            <h5>Send us a Message</h5>
                            <div class="space16"></div>
                            <p>Fill out the form below, and our team will get back to you as soon as possible!</p>
                        </div>

                        <div class="space10"></div>

                        <form id="contactForm">
                            @csrf
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" name="first_name" placeholder="First Name"
                                            id="first_name">
                                        <div class="text-danger" id="first_name_error"></div>
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" name="last_name" placeholder="Last Name" id="last_name">
                                        <div class="text-danger" id="last_name_error"></div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="email" name="email" placeholder="Email" id="email">
                                        <div class="text-danger" id="email_error"></div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="number" name="phone" placeholder="Phone" id="phone">
                                        <div class="text-danger" id="phone_error"></div>
                                    </div>
                                </div>

                                <!-- Subject -->
                                <div class="col-md-12">
                                    <div class="single-input">
                                        <input type="text" name="subject" placeholder="Subject" id="subject">
                                        <div class="text-danger" id="subject_error"></div>
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="col-md-12">
                                    <div class="single-input">
                                        <input type="text" name="country" placeholder="Country" id="country">
                                        <div class="text-danger" id="country_error"></div>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-md-12">
                                    <div class="single-input">
                                        <textarea rows="4" name="message" placeholder="Message" id="message"></textarea>
                                        <div class="text-danger" id="message_error"></div>
                                    </div>
                                </div>
                                <!-- Success Message -->
                                <div class="text-success mt-3" id="success_message"></div>

                                <!-- Submit Button -->
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
