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
@section('page_name', 'Draft Verification')
@include('frontend.components.hero')
<!--=====SERVICE AREA START=======-->

<div class="service5 sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto text-center">
                <div class="heading5">
                    <span class="span" data-aos="zoom-in-left" data-aos-duration="700">COS Draft Verification</span>
                    <h2 class="text-anime-style-3">Verify Your COS Draft Certificate Instantly</h2>
                    <div class="space16"></div>
                    <p data-aos="fade-left" data-aos-duration="800">Welcome to our COS Draft verification system. This
                        feature allows you to ensure the authenticity of certificates issued by us. Simply enter the
                        Barcode number in the text box below and click 'Verify' to confirm its validity. The system
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
                                                placeholder="Barcode Number" required>
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
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('certificate-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const certificateNumber = document.getElementById('certificate_number').value.trim();

            if (!certificateNumber) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Empty Input',
                    text: 'Please enter a certificate number',
                    confirmButtonColor: '#3085d6',
                });
                return;
            }

            fetch('/check-certificate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ certificate_number: certificateNumber })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Certificate Found!',
                        html: `Full Name: <b>${data.family_name} ${data.given_name}</b>`,
                        confirmButtonColor: '#3085d6',
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: error.error === 'Not found' ? 'Not Found' : 'Error',
                        text: error.error === 'Not found' ?
                              'Certificate number not found in our database' :
                              (error.message || 'An unexpected error occurred'),
                        confirmButtonColor: '#d33',
                    });
                });
        });
    });
</script>
@endpush
