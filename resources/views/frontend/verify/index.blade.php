@push('styles')
    <style>
        .contact-page .contact1-form {
            background-color: transparent !important;
        }

        .contact-page .contact1-form .single-input input,
        .contact-page .contact1-form .single-input textarea {
            /* background-color: #E9E8E9; */
            color: black;
            text-align: center;
            border: 1px solid rgb(0, 160, 224);
        }
    </style>
@endpush
@extends('layouts.frontend')

@section('content')
@section('page_name', 'Verification')
@include('frontend.components.hero')
<!--=====SERVICE AREA START=======-->

<div class="service5 sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto text-center">
                <div class="heading5">
                    <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Certificate Verification</span>
                    <h2 class="text-anime-style-3">Verify Your Certificate Instantly</h2>
                    <div class="space16"></div>
                    <p data-aos="fade-left" data-aos-duration="800">Welcome to our certificate verification system. This
                        feature allows you to ensure the authenticity of certificates issued by us. Simply enter the
                        certificate number in the text box below and click 'Verify' to confirm its validity. The system
                        will instantly provide the details associated with the certificate. For any issues or queries,
                        feel free to contact our support team.</p>
                </div>
            </div>
        </div>

        <div class="space30"></div>
        <div class="contact-page">
            <div class="container">
                <div class="row align-items-center">


                    <div class="col-lg-12">
                        <div class="contact1-form">


                            <form id="certificate-form">
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <input id="certificate_number" name="certificate_number" type="text"
                                                placeholder="Certificate Number" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="button">
                                            <button class="theme-btn1">Submit Now <span><i
                                                        class="fa-solid fa-arrow-right"></i></span></button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <div id="certificate-result" style="display: none;">
                                <div class="after-box-details">
                                    <div class="heading1">
                                        ✅ Certificate Verified Successfully
                                        <br>
                                        <br>
                                        <p><strong>Applicant Name:</strong> <span id="applicant-name"></span></p>
                                        <p><strong>Date of Birth:</strong> <span id="dob"></span></p>
                                        <p><strong>Result:</strong> English Language Proficiency Result - <span id="result"></span></p>
                                        <p><strong>Assessment Date:</strong> <span id="assessment-date"></span></p>
                                        <p><strong>Expire Date:</strong> <span id="expire-date"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div id="certificate-error" style="display: none;">
                                <div class="after-box-details">
                                    <div class="heading1">
                                        ❌ Certificate Verification Failed
                                        <p>The certificate number you entered is invalid or does not exist in our records. Please double-check the number and try again.</p>
                                        <p>If you believe this is an error, contact our support team for assistance.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        {{-- <div id="certificate-result" style="display: none;">
            <h3>Certificate Details</h3>
            <p><strong>Applicant Name:</strong> <span id="applicant-name"></span></p>
            <p><strong>Date of Birth:</strong> <span id="dob"></span></p>
            <p><strong>Result:</strong> <span id="result"></span></p>
            <p><strong>Assessment Date:</strong> <span id="assessment-date"></span></p>
        </div> --}}

        <div class="space30"></div>

    </div>
</div>

<!--=====SERVICE AREA END=======-->




@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#certificate-form').on('submit', function(e) {
            e.preventDefault();

            const certificateNumber = $('#certificate_number').val();

            $.ajax({
                url: "{{ route('certificate.verify') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    certificate_number: certificateNumber
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#certificate-result').show();
                        $('#certificate-error').hide();
                        $('#applicant-name').text(response.data.applicant_name);
                        $('#dob').text(response.data.dob);
                        $('#result').text(response.data.result.toUpperCase());
                        $('#assessment-date').text(response.data.assessment_date);
                        $('#expire-date').text(response.data.expiry_date);
                    } else {
                        $('#certificate-result').hide();
                        $('#certificate-error').show().text(response.message);
                    }
                },
                error: function(xhr) {
                    $('#certificate-result').hide();
                    $('#certificate-error').show();
                }
            });
        });
    });
</script>
@endpush
