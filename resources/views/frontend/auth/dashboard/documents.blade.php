@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/calander.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <style>
        .rounded-12 {
            border-radius: 0.75rem !important;
        }

        .bg-main-50 {
            background-color: hsl(219, 94%, calc(61% + (100% - 61%) * 0.9)) !important;
        }

        .p-16 {
            padding: 1rem !important;
        }

        .gap-10 {
            gap: 0.625rem !important;
        }

        .rounded-circle {
            object-fit: cover;
        }

        .text-lg {
            font-size: 1.125rem !important;
        }

        .bg-white {
            background-color: hsl(0 0% 100%) !important;
        }

        .text-main-600 {
            color: hsl(219 94% 61%) !important;
        }

        .h-36 {
            height: 2.25rem !important;
        }

        .w-36 {
            width: 2.25rem !important;
        }

        .flex-align,
        .form-check {
            display: flex;
            align-items: center;
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-main {
            margin-top: 15px !important;
            display: inline-block;
            vertical-align: middle;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: none;
            outline: none !important;
            font-weight: var(--f-fw-bold);
            font-size: var(--f-fs-font-fs16);
            line-height: var(--f-fs-font-fs16);
            color: var(--vtc-text-text-white-text-1);
            text-transform: capitalize;
            padding: 18px 22px 18px 22px;
            background-color: var(--vtc-bg-main-bg-7);
            overflow: hidden;
            z-index: 1;
            border-radius: 4px !important;
            position: relative;
        }

        .btn-main:hover {
            background-color: #3d86ac;
            color: #fff;
        }

        /* ---------  */

        .bg-primary-100 {
            background-color: #BFDCFF !important;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gap-8 {
            gap: 0.5rem !important;
        }

        .mb-20 {
            margin-block-end: 1.25rem !important;
        }

        .dropdown button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }

        .text-gray-300 {
            color: #667797 !important;
        }

        .text-gray-300:hover {
            color: #334360 !important;
        }
    </style>
@endpush

@extends('layouts.frontend')
@section('content')
@section('page_name', 'My Account')
@include('frontend.components.hero')
<div class="container-xl px-4 mt-4">

    @include('frontend.auth.dashboard.components.nav')
    <div class="row">


        <div class="col-xl-6">

            @include('backend.components.alert')
            <div class="card mb-4">
                <div class="card-header">Documents Manager</div>
                <div class="card-body">
                    <div class="col-12 mt-16">
                        <label for="documentType" class="h5 mb-8 fw-semibold font-heading">Select Document
                            Type</label>
                        <div class="position-relative">
                            <select id="documentType" onchange="showFields()"
                                class="form-select py-9 placeholder-13 text-15">



                                <!-- Proof of Identity -->
                                <optgroup label="Proof of Identity">
                                    <option value="passport">Passport</option>
                                    <option value="national_id_card">National ID Card (NIC)</option>
                                    <option value="drivers_license">Driver's License</option>
                                </optgroup>

                                <!-- Curriculum vitae -->
                                <optgroup label="Curriculum vitae">
                                    <option value="curriculum_vitae">Curriculum vitae (CV)</option>
                                </optgroup>

                                <!-- Proof of Address -->
                                <optgroup label="Proof of Address">
                                    <option value="proof_of_address">Proof Of Address</option>
                                </optgroup>

                                <!-- Qualifications and Certifications -->
                                <optgroup label="Qualifications and Certifications">
                                    <option value="educational_certificates">Educational Certificates</option>
                                </optgroup>

                                <!-- Employment History -->
                                <optgroup label="Employment History">
                                    <option value="reference_letters">Reference Letters</option>
                                    <option value="employment_contracts">Employment Contracts</option>
                                </optgroup>

                                <!-- Criminal Record -->
                                <optgroup label="Criminal Record">
                                    <option value="police_clearance">Police Clearance Certificate</option>
                                </optgroup>

                                <!-- Health Documents -->
                                <optgroup label="Health Documents">
                                    <option value="medical_certificate">Medical Certificate</option>
                                </optgroup>

                                <!-- Other Documents -->
                                <optgroup label="Other Documents">
                                    <option value="other_documents">Other Documents</option>
                                </optgroup>





                            </select>
                        </div>
                    </div>
                    <br>
                    @include('backend.user.settings.form.passport')
                    @include('backend.user.settings.form.id')
                    @include('backend.user.settings.form.license')
                    @include('backend.user.settings.form.address')
                    @include('backend.user.settings.form.education')
                    @include('backend.user.settings.form.reference')
                    @include('backend.user.settings.form.employement')
                    @include('backend.user.settings.form.police')
                    @include('backend.user.settings.form.medical')
                    @include('backend.user.settings.form.cv')
                    @include('backend.user.settings.form.other')
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">Submited Documents</div>
                <div class="card-body">
                    @include('backend.user.settings.form.attachments')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space30"></div>


@endsection


@push('scripts')
<!-- Phosphor Js -->
<script src="{{ asset('backend/js/phosphor-icon.js') }}"></script>
<script src="{{ asset('frontend/js/calander.js') }}"></script>
<script>
    function showFields() {
        const documentType = document.getElementById("documentType").value;

        // Hide all document fields initially
        document.querySelectorAll('.document-fields').forEach(field => {
            field.style.display = 'none';
        });

        // Show specific fields based on selected document type
        if (documentType === 'passport') {
            document.getElementById('passportFields').style.display = 'block';
        } else if (documentType === 'national_id_card') {
            document.getElementById('nationalIdCardFields').style.display = 'block';
        } else if (documentType === 'other_documents') {
            document.getElementById('otherFields').style.display = 'block';
        } else if (documentType === 'drivers_license') {
            document.getElementById('licenseFields').style.display = 'block';
        } else if (documentType === 'curriculum_vitae') {
            document.getElementById('cvFields').style.display = 'block';
        } else if (documentType === 'proof_of_address') {
            document.getElementById('proofOfAddressFields').style.display = 'block';
        } else if (documentType === 'educational_certificates') {
            document.getElementById('educationalCertificatesFields').style.display = 'block';
        } else if (documentType === 'reference_letters') {
            document.getElementById('referenceLettersFields').style.display = 'block';
        } else if (documentType === 'employment_contracts') {
            document.getElementById('employmentContractsFields').style.display = 'block';
        } else if (documentType === 'police_clearance') {
            document.getElementById('policeClearanceFields').style.display = 'block';
        } else if (documentType === 'medical_certificate') {
            document.getElementById('medicalCertificateFields').style.display = 'block';
        }
    }

    // Upload Video & show it's name js Start
    //   document.getElementById('passport').addEventListener('change', function(event) {
    //       var uploadedVideoName = document.getElementById('uploaded-passport-name');
    //       var files = event.target.files;

    //       if (files.length > 0) {
    //           var fileNames = Array.from(files).map(file => file.name).join(', ');
    //           uploadedVideoName.textContent = fileNames;
    //           $('.show-uploaded-passport-name').removeClass('d-none');
    //       } else {
    //           uploadedVideoName.textContent = '';
    //       }
    //   });

    // Function to handle file input changes
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
@endpush
