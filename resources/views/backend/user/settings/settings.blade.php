@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
@section('page_name', 'User Management')
@include('backend.components.breadcrumb')

<div class="card overflow-hidden">
    <div class="card-body p-0">
        <div class="cover-img position-relative">

            <div class="avatar-upload">
                <div class="avatar-preview">
                    <div id="coverImagePreview"
                        style="background-image: url('{{ asset('https://picsum.photos/1920/1080') }}');">
                    </div>
                </div>
            </div>
        </div>

        <div class="setting-profile px-24">
            <div class="flex-between">
                <div class="d-flex align-items-end flex-wrap mb-32 gap-24">

                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                        alt="" class="w-120 h-120 rounded-circle border border-white">


                    <div>
                        <h4 class="mb-8">{{ $user->name }}
                            @if($application)
                                <small
                                    style="font-weight: 100; letter-spacing: 4px;"> - ({{ $application->application_number }})</small>
                            @endif
                        </h4>
                        <div class="setting-profile__infos flex-align flex-wrap gap-16">
                            <div class="flex-align gap-6">
                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-swatches"></i></span>
                                <span <span class="text-gray-600 d-flex text-15">{{ ucfirst($user->user_type) }}</span>
                            </div>
                            <div class="flex-align gap-6">
                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-map-pin"></i></span>
                                <span class="text-gray-600 d-flex text-15">{{ $user->country }}</span>
                            </div>
                            <div class="flex-align gap-6">
                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-calendar-dots"></i></span>
                                <span class="text-gray-600 d-flex text-15">Join
                                    {{ date('F Y', strtotime($user->created_at)) }}</span>
                            </div>
                            <div class="form-switch switch-primary d-flex align-items-center gap-8">
                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch2" onchange="toggleStaffStatus(this)">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch2" id="staffLabel">Not Staff</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('showApplicationTab') ? '' : 'active' }}" id="pills-details-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-details" type="button" role="tab"
                        aria-controls="pills-details"
                        aria-selected="{{ session('showApplicationTab') ? 'false' : 'true' }}">
                        User Details
                    </button>
                </li>
                @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password"
                        aria-selected="false">
                        Password
                    </button>
                </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents"
                        aria-selected="false">
                        Documents
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-jobs-tab" data-bs-toggle="pill" data-bs-target="#pills-jobs"
                        type="button" role="tab" aria-controls="pills-jobs" aria-selected="false">
                        Applied Positions
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('showApplicationTab') ? 'active' : '' }}"
                        id="pills-application-tab" data-bs-toggle="pill" data-bs-target="#pills-application"
                        type="button" role="tab" aria-controls="pills-application"
                        aria-selected="{{ session('showApplicationTab') ? 'true' : 'false' }}">
                        Application
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-message-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-message" type="button" role="tab" aria-controls="pills-message"
                        aria-selected="true">
                        Message
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-notes-tab" data-bs-toggle="pill" data-bs-target="#pills-notes"
                        type="button" role="tab" aria-controls="pills-notes" aria-selected="true">
                        Notes
                    </button>
                </li>
            </ul>


        </div>

    </div>
</div>
<br>
@include('backend.components.alert')

<div class="tab-content" id="pills-tabContent">

    @include('backend.user.settings.details')
    @include('backend.user.settings.password')
    @include('backend.user.settings.application')
    @include('backend.user.settings.jobs')
    @include('backend.user.settings.notes')
    @include('backend.user.settings.message')
    @include('backend.user.settings.documents')





</div>
@endsection

@push('scripts')
<script>
    // ============================= Avatar Upload js =============================
    function uploadImageFunction(imageId, previewId) {
        $(imageId).on('change', function() {
            var input = this; // 'this' is the DOM element here
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(previewId).css('background-image', 'url(' + e.target.result + ')');
                    $(previewId).hide();
                    $(previewId).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    }
    uploadImageFunction('#coverImageUpload', '#coverImagePreview');
    uploadImageFunction('#imageUpload', '#profileImagePreview');
</script>

<script>
    function toggleStaffStatus(switchElement) {
        const hiddenUserIdField = document.getElementById('user_id'); // Get the hidden field
        const userId = hiddenUserIdField.value; // Retrieve the user ID
        const isStaff = switchElement.checked ? 1 : 0; // Get the switch state
        const label = document.getElementById('staffLabel'); // Get the label element

        // Update the label text
        label.textContent = isStaff ? 'Staff' : 'Not Staff';

        // Make an AJAX request to update the staff status
        $.ajax({
            url: '/update-staff-status', // Laravel route to handle the update
            method: 'POST',
            data: {
                user_id: userId,
                is_staff: isStaff,
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Staff status updated successfully!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload the page after SweetAlert confirmation
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update staff status.',
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating staff status.',
                });
            }
        });
    }
</script>

@endpush
