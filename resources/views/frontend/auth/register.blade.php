@extends('layouts.frontend')

@section('content')
@section('page_name', 'Register')
@include('frontend.components.hero')

<!--===== SERVICE BENEFITS AREA START =======-->

<div class="service-benefits5 pb120 sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-12 m-auto text-center">
                <div class="heading5">
                    <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Welcome Aboard</span>
                    <h2 class="text-anime-style-3">Create Your Account</h2>
                    <div class="space16"></div>
                    <p data-aos="fade-left" data-aos-duration="900">Join our community today! Create your account to
                        access personalized features, manage your profile, and explore the latest opportunities. Simply
                        fill out the form below to get started.</p>
                    <div class="space30"></div>


                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600 text-success">
                            {{ $value }}
                        </div>
                        <br>
                    @endsession

                    @if (session('error'))
                        <div style="color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
                            {{ session('error') }}
                        </div>
                        <br>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <!-- @error('g-recaptcha-response')
                        <div style="color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
                            {{ $message }}
                        </div>
                        <br>
                    @enderror -->


                    <form method="POST" action="{{ route('user.register') }}" id="registrationForm">
                        @csrf
                        <!-- Name Field -->
                        <input type="text" class="form-control login-input" name="name" autofocus
                            autocomplete="name" required value="{{ old('name') }}" placeholder="Enter your name">
                        <div class="space20"></div>

                        <!-- Email Field -->
                        <input type="email" class="form-control login-input" name="email" autofocus
                            autocomplete="username" required value="{{ old('email') }}" placeholder="Enter email">
                        <div class="space20"></div>

                        <!-- Password Field -->
                        <input type="password" name="password" required autocomplete="current-password"
                            class="form-control login-input" placeholder="Password">
                        <div class="space20"></div>

                        <!-- Password Confirmation Field -->
                        <input type="password" name="password_confirmation" required
                            autocomplete="password_confirmation" class="form-control login-input"
                            placeholder="Password confirmation">
                        <div class="space10"></div>

                    <div class="mb-24">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback="recaptchaCallback"></div>
                        <div id="recaptcha-error" class="text-danger mt-2" style="display: none;">
                            Please complete the reCAPTCHA verification.
                        </div>
                    </div>
                   


                        <div class="space20"></div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-dark login-button">Sign Up</button>
                    </form>

                    <!-- Include reCAPTCHA Script -->

                    <div class="space20"></div>
                    <span>Already have an account? <a href="{{ route('user.login') }}">Sign In here</a></span>

                </div>
            </div>


        </div>

        <div class="space30"></div>

    </div>
</div>

<!--===== SERVICE BENEFITS AREA END =======-->



@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

 <script>
        // reCAPTCHA callback function
        function recaptchaCallback(response) {
            if (response.length > 0) {
                document.getElementById('recaptcha-error').style.display = 'none';
            }
        }

        // Form submission validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            var recaptchaResponse = grecaptcha.getResponse();
            
            if (recaptchaResponse.length === 0) {
                e.preventDefault();
                document.getElementById('recaptcha-error').style.display = 'block';
                document.getElementById('recaptcha-error').scrollIntoView({ behavior: 'smooth' });
                return false;
            }
            
            return true;
        });

        // Optional: Reset reCAPTCHA on form reset
        function resetRecaptcha() {
            grecaptcha.reset();
            document.getElementById('recaptcha-error').style.display = 'none';
        }
    </script>
@endpush
