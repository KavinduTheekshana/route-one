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
                    <span class="span" data-aos="zoom-in-left" data-aos-duration="700">Reset Your Password</span>
                    <h2 class="text-anime-style-3">Create a New Password</h2>
                    <div class="space16"></div>
                    <p data-aos="fade-left" data-aos-duration="900">Please enter your new password below to regain
                        access to your account. Ensure it's strong and secure.</p>

                    <div class="space30"></div>
                    @session('status')
                        <div class="mb-4 font-medium text-sm text-green-600 text-success">
                            {{ $value }}
                        </div>
                    @endsession

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div style="color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.password.update.token') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">


                        <input type="password" name="password" required autocomplete="current-password"
                            class="form-control login-input" placeholder="Password">
                        <div class="space20"></div>

                        <input type="password" name="password_confirmation" required class="form-control login-input"
                            placeholder="Confirm Password">

                        <div class="space10"></div>

                        <div class="space20"></div>
                        <button type="submit" class="btn btn-dark login-button">Reset Password</button>

                    </form>
                    <div class="space20"></div>
                    {{-- <span>Don't have an account? <a href="{{ route('user.register') }}">Create an Account</a></span> --}}
                </div>
            </div>


        </div>

        <div class="space30"></div>

    </div>
</div>

<!--===== SERVICE BENEFITS AREA END =======-->



@endsection
