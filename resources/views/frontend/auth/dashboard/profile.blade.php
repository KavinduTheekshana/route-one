@push('styles')
   <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    {{-- <style>
        .flag {
            height: 20px;
        }
    </style>

    <style>
        .country-select {
            width: 100%;
            max-width: 300px;
            padding: 8px;
            font-size: 16px;
        }

        .flag-icon {
            margin-right: 8px;
            width: 20px;
            height: 15px;
            vertical-align: middle;
        }

        /* Add padding to the selected area (input box) */
        .select2-container--default .select2-selection--single {
            padding: 0.48rem 1.13rem;
            height: auto;
            /* Adjust height dynamically */
            display: flex;
            align-items: center;
            /* Center flag and text vertically */
        }

        /* Add padding to dropdown options */
        .select2-container--default .select2-results__option {
            padding: 0.48rem 1.13rem;
            display: flex;
            align-items: center;
            /* Align flag and text */
        }

        /* Ensure the dropdown is styled properly */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 0;
            /* Avoid double padding */
            display: flex;
            align-items: center;
        }

        /* Adjust spacing for the flag inside the dropdown */
        .select2-container--default .select2-results__option img.flag,
        .select2-container--default .select2-selection--single img.flag {
            margin-right: 10px;
            /* Space between flag and text */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            display: none;
        }
    </style> --}}


@endpush

@extends('layouts.frontend')
@section('content')
@section('page_name', 'My Account')
@include('frontend.components.hero')
<div class="container-xl px-4 mt-4">

    @include('frontend.auth.dashboard.components.nav')
    <div class="row">
        <div class="col-xl-4">

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <form id="profileForm" method="POST" action="{{ route('user.profile.update.image') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="imageUpload" name="profile_image" accept="image/*"
                            style="display: none;">
                        <img id="imagePreview" alt="Profile Image" class="img-account-profile rounded-circle mb-2"
                            src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('frontend/img/hero/765-default-avatar.png') }}">


                        <div class="small font-italic text-muted mb-4">SVG, PNG, JPEG OR GIF (max 1080px1200px)</div>

                        <button onclick="document.getElementById('imageUpload').click()" class="btn btn-primary"
                            type="button">Upload new image</button>
                        <button type="submit" class="btn btn-success" id="saveButton" disabled>Save</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-xl-8">

            @include('backend.components.alert')
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update.details') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Full Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter your full name"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="row gx-3 mb-3">

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputCountry">Country</label>




                                <select id="countrySelect" class="form-control" name="country" style="width: 100%;">
                                    <option value="" disabled selected>Loading countries...</option>
                                </select>

                                {{-- <select id="countries" class="form-control" name="country" style="width: 100%;">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['name']['common'] }}"
                                            data-flag="{{ $country['flags']['svg'] }}"
                                            {{ auth()->user()->country == $country['name']['common'] ? 'selected' : '' }}>
                                            {{ $country['name']['common'] }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                {{-- <input class="form-control" name="country" type="text"
                                    placeholder="Enter your country" value="{{ auth()->user()->country }}"> --}}
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control" name="phone" type="text"
                                    placeholder="Enter your phone number" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input readonly class="form-control" name="email" type="email"
                                placeholder="Enter your email address" value="{{ auth()->user()->email }}">
                        </div>






                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('scripts')

<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Show image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Enable the Save button
            document.getElementById('saveButton').disabled = false;
        }
    });
</script>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#countries').select2({
            templateResult: formatCountry, // For dropdown options
            templateSelection: formatCountry, // For selected option
            escapeMarkup: function(markup) {
                return markup; // Allow HTML
            }
        });

        function formatCountry(country) {
            if (!country.id) {
                return country.text; // Return default text for search box
            }
            let flagUrl = $(country.element).data('flag'); // Get flag URL from data attribute
            let countryName = country.text; // Get country name
            return `<span><img class="flag" src="${flagUrl}" alt="flag" /> ${countryName}</span>`;
        }
    });
</script> --}}

<script>
    // Fetch country data
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('countrySelect');
            const savedCountryCode = "{{ auth()->user()->country }}"; // Get saved country code (e.g., "US")

            select.innerHTML = ''; // Clear the placeholder

            // Sort countries alphabetically by name
            data.sort((a, b) => a.name.common.localeCompare(b.name.common));

            // Populate the dropdown
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common; // Use country code (cca2) as value
                option.textContent = country.name.common; // Display country name

                // Check if this country matches the saved country code
                if (country.name.common === savedCountryCode) {
                    option.selected = true; // Set the saved country as selected
                }

                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching countries:', error);
            const select = document.getElementById('countrySelect');
            select.innerHTML = '<option value="" disabled>Error loading countries</option>';
        });
</script>




@endpush
