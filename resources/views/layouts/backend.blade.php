<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ ucfirst(auth()->user()->user_type) }} Dashboard - Route One Recruitment</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/logo/favicon.svg') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('backend/css/file-upload.css') }}">
    <!-- file upload -->
    <link rel="stylesheet" href="{{ asset('backend/css/plyr.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/full-calendar.css') }}"> --}}
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
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">


    @stack('styles')
    {{-- @vite(['', 'resources/js/app.js']) --}}
    {{-- git update-index --no-assume-unchanged resources/views/layouts/backend.blade.php --}}

</head>

<body>
    {{-- Preloader Start  --}}
    <div class="preloader">
        <div class="loader"></div>
    </div>

    {{-- Sidebar Overlay End  --}}
    <div class="side-overlay"></div>

    {{-- Sidebar  --}}
    @include('backend.components.sidebar')


    <div class="dashboard-main-wrapper">
        {{-- Topbar  --}}
        @include('backend.components.topbar')

        <div class="dashboard-body">
            {{-- Content  --}}
            @yield('content')
        </div>
        {{-- footer  --}}
        @include('backend.components.footer')
    </div>

    <!-- Jquery js -->
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }}"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Bootstrap JavaScript -->
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}

    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('backend/js/boostrap.bundle.min.js') }}"></script>
    <!-- Phosphor Js -->
    <script src="{{ asset('backend/js/phosphor-icon.js') }}"></script>
    <!-- file upload -->
    <script src="{{ asset('backend/js/file-upload.js') }}"></script>
    <!-- file upload -->
    <script src="{{ asset('backend/js/plyr.js') }}"></script>
    <!-- dataTables -->
    {{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> --}}
    <!-- full calendar -->
    {{-- <script src="{{ asset('backend/js/full-calendar.js') }}"></script> --}}
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
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    @stack('textarea')
    @stack('scripts')


</body>

</html>
