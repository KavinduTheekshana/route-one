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
                    <h2 class="text-anime-style-3">Sign In to Your Account</h2>
                    <div class="space16"></div>
                    <p data-aos="fade-left" data-aos-duration="900">Access your dashboard, manage your profile, and
                        explore opportunities. Enter your credentials below to get started.</p>
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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" class="form-control login-input" name="email" autofocus
                            autocomplete="username" required value="{{ old('email') }}" placeholder="Enter email">
                        <div class="space20"></div>
                        <input type="password" name="password" required autocomplete="current-password"
                            class="form-control login-input" placeholder="Password">
                        <div class="space10"></div>
                        <div class="row link-row">
                            <div class="col d-flex">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="remember" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Check me out
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex">
                                <a href="" class="right-link">Forgotten your password?</a>
                            </div>
                        </div>
                        <div class="space20"></div>
                        <button type="submit" class="btn btn-dark login-button">Sign In</button>

                    </form>
                    <div class="space20"></div>
                    <span>Don't have an account? <a href="">Create an Account</a></span>
                </div>
            </div>


        </div>

        <div class="space30"></div>

    </div>
</div>

<!--===== SERVICE BENEFITS AREA END =======-->



@endsection
