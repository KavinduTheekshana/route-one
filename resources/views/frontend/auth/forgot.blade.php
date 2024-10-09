@extends('layouts.frontend')

@section('content')
@section('page_name', 'Login')
@include('frontend.components.hero')

<!--===== SERVICE BENEFITS AREA START =======-->

<div class="service-benefits5 pb120 sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto text-center">
                <div class="heading5">
                    <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Welcome Back</span>
                    <h2 class="text-anime-style-3">Reset Your Password</h2>
                    <div class="space16"></div>
                    <p data-aos="fade-left" data-aos-duration="900">Enter your email address to receive a password reset
                        link and regain access to your account.</p>

                    <div class="space30"></div>
                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ $value }}
                        </div>
                    @endsession
                    @if (session('error'))
                        <div style="color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <input type="email" class="form-control login-input" name="email" required autofocus
                            autocomplete="username" value="{{ old('email') }}" placeholder="Enter email">


                        <div class="space10"></div>

                        <div class="space20"></div>
                        <button type="submit" class="btn btn-dark login-button">Email Password Reset Link</button>

                    </form>
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
