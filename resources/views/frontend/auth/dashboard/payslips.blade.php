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
            <div class="card mb-4">
                <div class="card-header">My Payslips</div>
                <div class="card-body">
                    @if ($payslips->isEmpty())
                        <p>No Payslips found for this user.</p>
                    @else
                        <ul>
                            <div class="row">
                                @foreach ($payslips as $document)
                                    <li class="col-12">
                                        <div class="upload-card-item p-16 rounded-12 bg-primary-100 mb-20">
                                            <div class="flex-between gap-8">
                                                <div class="flex-align gap-10 flex-wrap">
                                                    <span
                                                        class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                                                        @if ($document->file_type == 'image/jpeg')
                                                            <i class="ph ph-file-jpg"></i>
                                                        @elseif($document->file_type == 'image/png')
                                                            <i class="ph ph-file-png"></i>
                                                        @elseif($document->file_type == 'pdf')
                                                            <i class="ph ph-file-pdf"></i>
                                                        @else
                                                            <i class="ph ph-paperclip"></i>
                                                        @endif


                                                    </span>
                                                    <div class="">
                                                        <p class="text-15 text-gray-500"><strong>
                                                                Payslip ({{ $document->date }})

                                                            </strong> - {{ $document->file_original_name }} </p>
                                                        <p class="text-13 text-gray-600">( File Size :
                                                            {{ number_format($document->file_size / 1024, 2) }} KB )</p>
                                                        <p class="text-13 text-gray-600">{{ $document->file_name }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex-align gap-8">
                                                    <span class="text-main-600 d-flex text-xl"><i
                                                            class="ph-fill ph-check-circle"></i></span>
                                                    <!-- Dropdown Start -->
                                                    <div class="dropdown flex-shrink-0">
                                                        <button class="text-gray-600 text-xl d-flex rounded-4"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ph-fill ph-dots-three-outline"></i>
                                                        </button>
                                                        <div
                                                            class="dropdown-menu dropdown-menu--md border-0 bg-transparent p-0">
                                                            <div
                                                                class="card border border-gray-100 rounded-12 box-shadow-custom">
                                                                <div class="card-body p-12">
                                                                    <div
                                                                        class="max-h-200 overflow-y-auto scroll-sm pe-8">
                                                                        <ul>
                                                                            <li class="mb-0">
                                                                                <button type="button"
                                                                                    onclick="viewDocument('{{ asset('storage/' . $document->file_path) }}', '{{ pathinfo($document->file_path, PATHINFO_EXTENSION) }}')"
                                                                                    class="view-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                                                    <span class="text">View</span>
                                                                                </button>

                                                                                <a href="{{ asset('storage/' . $document->file_path) }}"
                                                                                    type="button"
                                                                                    download="{{ $document->file_original_name }}"
                                                                                    class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                                                    <span class="text">Download</span>
                                                                                </a>




                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Dropdown end -->
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space30"></div>
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-full">
                <iframe id="documentFrame" src="" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script src="{{ asset('backend/js/phosphor-icon.js') }}"></script>

<script>



    function viewDocument(fileUrl, fileType) {
        const documentFrame = document.getElementById('documentFrame');
        const modalBody = document.querySelector('.modal-body-full');

        // Clear the modal content first
        modalBody.innerHTML = '';

        if (fileType === 'pdf') {
            // For PDFs, use an iframe
            modalBody.innerHTML = `<iframe src="${fileUrl}" width="100%" height="500px" frameborder="0"></iframe>`;
        } else if (fileType === 'jpeg' || fileType === 'png' || fileType === 'jpg') {
            // For images, show an image element
            modalBody.innerHTML = `<img src="${fileUrl}" class="modal-image" />`;
        }

        // Show the modal
        $('#documentModal').modal('show');
    }
</script>
@endpush
