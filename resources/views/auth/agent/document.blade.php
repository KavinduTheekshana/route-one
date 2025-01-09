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
    <style>
        .auth-center {
            width: 100%;
        }

        .auth-right__logo {
            display: flex;
            justify-content: center;
        }

        .auth-right__inner {
            max-width: 600px;
        }

        .check-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            font-size: 12px;
            background-color: #28a745;
            /* Green background */
            color: white;
            /* White icon */
            border-radius: 50%;
            /* Circular shape */
        }
    </style>
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
        <div class="auth-center py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="{{ route('/') }}" class="auth-right__logo">
                    <img src="{{ asset('backend/images/logo/routeone_logo.svg') }}" alt="" style="width: 60%;">
                </a>
                <h2 class="mb-8">Become an Agent! 🇬🇧</h2>
                <p class="text-gray-600 text-15 mb-32">Please upload all the documents listed below. Our team will
                    review them and get back to you shortly.</p>

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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if ($userDocuments->isNotEmpty())
                    <div class="alert alert-info mb-24">
                        Your documents have been uploaded. Our team will manually review them and update you via email.
                        Once approved, you will gain access to the agent portal.
                    </div>
                @endif
                <form method="POST" action="{{ route('agent.store.documents') }}" enctype="multipart/form-data">
                    @csrf

                    @foreach (['passport' => 'Passport', 'br' => 'Business Registration (Optional)', 'police' => 'Police Clearance', 'address' => 'Address Proof'] as $type => $label)
                        @php
                            $document = $userDocuments->firstWhere('document_type', $type);
                        @endphp

                        <div class="mb-24">
                            <label class="form-label mb-8 h6">{{ $label }}</label>
                            <div class="position-relative">
                                <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4">
                                    <div class="flex-align gap-10 flex-wrap">
                                        <!-- Icon Section -->
                                        <span
                                            class="w-36 h-36 text-lg rounded-circle flex-center flex-shrink-0 {{ $document ? 'bg-success' : 'bg-white' }}">
                                            @if ($document)
                                                <i class="ph ph-check text-white"></i> <!-- White check icon -->
                                            @else
                                                <i class="ph ph-paperclip text-main-600"></i> <!-- Paperclip icon -->
                                            @endif
                                        </span>

                                        <!-- Upload Section -->
                                        <div class="upload-section">
                                            <p class="text-15 text-gray-500">
                                                Please upload a clear image of your <b>{{ $label }}</b>.
                                                <label class="text-main-600 cursor-pointer file-label">Browse</label>
                                                <input name="{{ $type }}" type="file" class="file-input"
                                                    accept=".jpg,.jpeg,.png,.webp,.pdf" hidden>
                                            </p>
                                            <p class="text-13 text-gray-600">JPG, PNG, WEBP, or PDF format (max file
                                                size 10MB each)</p>

                                            <!-- Display selected file name -->
                                            <span
                                                class="text-13 text-success d-block show-uploaded-passport-name d-none"></span>

                                            <!-- Display uploaded file details -->
                                            @if ($document)
                                                <div class="mt-2">
                                                    <span class="text-13 text-success d-block">
                                                        Uploaded: {{ $document->file_original_name }}
                                                        &nbsp;
                                                        <a href="{{ asset('storage/' . $document->file_path) }}"
                                                            target="_blank" class="text-main-600">View</a>
                                                    </span>
                                                    <p class="text-13 text-muted mt-2">Uploading a new file will replace
                                                        the existing one.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-main rounded-pill w-100">Submit Documents</button>
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

    {{-- <script>
        fetch('https://restcountries.com/v3.1/all')
            .then(response => {
                console.log("Response Status:", response.status);
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                const select = document.getElementById('country');
                select.innerHTML = ''; // Clear the placeholder

                // Sort countries alphabetically by name
                data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                // Add a default option
                const defaultOption = document.createElement('option');
                defaultOption.value = "";
                defaultOption.disabled = true;
                defaultOption.selected = true;
                defaultOption.textContent = "Select your country";
                select.appendChild(defaultOption);

                // Populate the dropdown with country options
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.name.common; // Use the country name as the value
                    option.textContent = country.name.common; // Display the country name
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching countries:', error);
                const select = document.getElementById('country');
                select.innerHTML = '<option value="" disabled>Error loading countries</option>';
            });
    </script>
 --}}

    <script>
        function handleFileInputChange(event) {
            var fileInput = event.target;
            var fileContainer = fileInput.closest('.upload-section');
            var uploadedFileName = fileContainer.querySelector('.show-uploaded-passport-name');

            var files = fileInput.files;

            if (files.length > 0) {
                var fileName = files[0].name; // Only one file
                uploadedFileName.textContent = fileName;
                uploadedFileName.classList.remove('d-none'); // Show the file name
            } else {
                uploadedFileName.textContent = '';
                uploadedFileName.classList.add('d-none'); // Hide if no file selected
            }
        }

        // Function to trigger the file input when "Browse" is clicked
        function handleBrowseClick(event) {
            var label = event.target;
            var fileInput = label.closest('.upload-section').querySelector(
                '.file-input'); // Find the correct input in the same section

            fileInput.click(); // Trigger the hidden file input
        }

        // Attach event listeners after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Attach event listeners to all labels with class 'file-label'
            document.querySelectorAll('.file-label').forEach(label => {
                label.addEventListener('click', handleBrowseClick);
            });

            // Handle file input changes
            document.querySelectorAll('.file-input').forEach(input => {
                input.addEventListener('change', handleFileInputChange);
            });
        });
    </script>
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
