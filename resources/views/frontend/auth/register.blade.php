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
                    @error('g-recaptcha-response')
                        <div style="color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
                            {{ $message }}
                        </div>
                        <br>
                    @enderror


                    <form method="POST" action="{{ route('register') }}">
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

                        <!-- Google reCAPTCHA Widget -->
                        <div class="g-recaptcha" data-sitekey="6Lequ8UqAAAAAHBEB1dRaq2ydJ2855goX61BnxNu"></div>


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
@endpush
