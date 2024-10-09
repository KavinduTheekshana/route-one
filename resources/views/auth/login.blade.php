<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Route One Recruitement - Bridging the Gap Talent and Opportunity</title>

    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="{{ asset('backend/images/logo/favicon.svg') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('backend/css/file-upload.css') }}">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('backend/css/plyr.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="{{ asset('backend/css/full-calendar.css') }}">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="{{ asset('backend/css/editor-quill.css') }}">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="{{ asset('backend/css/apexcharts.css') }}">
    <!-- calendar Css -->
    <link rel="stylesheet" href="{{ asset('backend/css/calendar.css') }}">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-jvectormap-2.0.5.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}">
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24"
            style="background-image: url('https://picsum.photos/1920/1080')">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="{{ route('/') }}" class="auth-right__logo">
                    <img src="{{ asset('backend/images/logo/routeone_logo.svg') }}" alt=""
                        style="width: 80%;">
                </a>
                <h2 class="mb-8">Welcome Back, Admin! 🇬🇧</h2>
                <p class="text-gray-600 text-15 mb-32">Please sign in to your account to manage the system and continue
                    your tasks.</p>

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
                    <div class="mb-24">
                        <label for="fname" class="form-label mb-8 h6">Email Address</label>
                        <div class="position-relative">
                            <input type="email" class="form-control py-11 ps-40" id="email" name="email"
                                placeholder="Type your email address">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-user"></i></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="current-password" class="form-label mb-8 h6">Current Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="current-password" name="password"
                                placeholder="Enter Current Password" value="">
                            <span
                                class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                id="#current-password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-lock"></i></span>
                        </div>
                    </div>
                    <div class="mb-32 flex-between flex-wrap gap-8">
                        <div class="form-check mb-0 flex-shrink-0">
                            <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" value="" name="remember"
                                id="remember">
                            <label class="form-check-label text-15 flex-grow-1" for="remember">Remember Me </label>
                        </div>
                        <a href="{{ route('password.request') }}"
                            class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-main rounded-pill w-100">Sign In</button>





                </form>
            </div>
        </div>
    </section>

    <!-- Jquery js -->
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('backend/js/boostrap.bundle.min.js') }}"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('backend/js/phosphor-icon.js') }}"></script>
    <!-- file upload -->
    <script src="{{ asset('backend/js/file-upload.js') }}"></script>
    <!-- file upload -->
    <script src="{{ asset('backend/js/plyr.js') }}"></script>
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- full calendar -->
    <script src="{{ asset('backend/js/full-calendar.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('backend/js/editor-quill.js') }}"></script>
    <!-- apex charts -->
    <script src="{{ asset('backend/js/apexcharts.min.js') }}"></script>
    <!-- Calendar Js -->
    <script src="{{ asset('backend/js/calendar.js') }}"></script>
    <!-- jvectormap Js -->
    <script src="{{ asset('backend/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <!-- jvectormap world Js -->
    <script src="{{ asset('backend/js/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('backend/js/main.js') }}"></script>



</body>

</html>




{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

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

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}
