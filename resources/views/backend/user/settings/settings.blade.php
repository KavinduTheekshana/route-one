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

                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt=""
                            class="w-120 h-120 rounded-circle border border-white">


                    <div>
                        <h4 class="mb-8">{{ $user->name }}</h4>
                        <div class="setting-profile__infos flex-align flex-wrap gap-16">
                            <div class="flex-align gap-6">
                                <span class="text-gray-600 d-flex text-lg"><i class="ph ph-swatches"></i></span>
                                <span
                                    <span class="text-gray-600 d-flex text-15">{{ ucfirst($user->user_type) }}</span>
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
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                        aria-selected="true">User Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password"
                        aria-selected="false">Password</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents"
                        aria-selected="false">Documents</button>
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
@endpush
