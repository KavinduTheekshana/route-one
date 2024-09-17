@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
@section('page_name', 'Team Management')
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
                        aria-selected="true">Member Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password"
                        aria-selected="false">Password</button>
                </li>

            </ul>
        </div>

    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- My Details Tab start -->
    <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab"
        tabindex="0">
        <div class="card mt-24">

            <div class="card-header border-bottom">
                <h4 class="mb-4">Member Details</h4>
                <p class="text-gray-600 text-15">You have selected the team member's details. You can update their information below.</p>
            </div>
            <div class="card-body">



                @include('backend.components.alert')


                <form action="{{ route('team.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row gy-4">
                        <div class="col-sm-6 col-xs-6">
                            <label for="fname" class="form-label mb-8 h6">Full Name</label>
                            <input type="text" class="form-control py-11" name="name"
                                placeholder="Enter Full Name" value="{{ $user->name }}">
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <label for="email" class="form-label mb-8 h6">Email</label>
                            <input type="email" class="form-control py-11" name="email" placeholder="Enter Email"
                                value="{{ $user->email }}">
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <label for="country" class="form-label mb-8 h6">Country</label>
                            <input type="text" class="form-control py-11" name="country" placeholder="Enter Country"
                                value="{{ $user->country }}">
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                            <input type="text" class="form-control py-11" name="phone"
                                placeholder="Enter Phone Number" value="{{ $user->phone }}">
                        </div>

                        <div class="col-sm-6 col-xs-6">
                            <label for="phone" class="form-label mb-8 h6">Role</label>
                            <select name="role" class="form-select py-9 placeholder-13 text-15 mb-10">
                                <option value="admin" {{ $user->user_type === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="superadmin" {{ $user->user_type === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="teacher" {{ $user->user_type === 'teacher' ? 'selected' : '' }}>Teacher</option>
                            </select>
                        </div>




                        <div class="col-12">
                            <label for="imageUpload" class="form-label mb-8 h6">Your Photo</label>
                            <div class="flex-align gap-22">
                                <div class="avatar-upload flex-shrink-0">
                                    <input type="file" name="profile_image" id="imageUpload"
                                        accept=".png, .jpg, .jpeg">
                                    <div class="avatar-preview">
                                        <div id="profileImagePreview"
                                            style="background-image: url('{{ asset('storage/' . $user->profile_image) }}');">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="avatar-upload-box text-center position-relative flex-grow-1 py-24 px-4 rounded-16 border border-main-300 border-dashed bg-main-50 hover-bg-main-100 hover-border-main-400 transition-2 cursor-pointer">
                                    <label for="imageUpload"
                                        class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 rounded-16 cursor-pointer z-1"></label>
                                    <span class="text-32 icon text-main-600 d-inline-flex"><i
                                            class="ph ph-upload"></i></span>
                                    <span class="text-13 d-block text-gray-400 text my-8">Click to upload or drag and
                                        drop</span>
                                    <span class="text-13 d-block text-main-600">SVG, PNG, JPEG OR GIF (max
                                        1080px1200px)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="flex-align justify-content-end gap-8">
                                <button type="reset"
                                    class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                                <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- My Details Tab End -->

  <!-- Password Tab Start -->
  <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab" tabindex="0">
    <div class="card mt-24">
        <div class="card-header border-bottom">
            <h4 class="mb-4">Password Settings</h4>
            <p class="text-gray-600 text-15">Please fill full details about your team member</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('user.password.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-12">
                                <label for="new-password" class="form-label mb-8 h6">New Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control py-11" id="new-password" name="new_password" placeholder="Enter New Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"></span>
                                </div>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control py-11" id="confirm-password" name="new_password_confirmation" placeholder="Enter Confirm Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"></span>
                                </div>
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label mb-8 h6">Password Requirements:</label>
                                <ul class="list-inside">
                                    <li class="text-gray-600 mb-4">At least one lowercase character</li>
                                    <li class="text-gray-600 mb-4">Minimum 8 characters long - the more, the better</li>
                                    <li class="text-gray-600 mb-4">At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>

                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Password Tab End -->

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


    // ============================= Initialize Quill editor js Start =============================
    function editorFunction(editorId) {
        const quill = new Quill(editorId, {
            theme: 'snow'
        });
    }
    editorFunction('#editor');
    editorFunction('#editorTwo');
    // ============================= Initialize Quill editor js End =============================


    // Table Header Checkbox checked all js Start
    $('#selectAll').on('change', function() {
        $('.form-check .form-check-input').prop('checked', $(this).prop('checked'));
    });

    // Data Tables
    new DataTable('#studentTable', {
        searching: false,
        lengthChange: false,
        info: false, // Bottom Left Text => Showing 1 to 10 of 12 entries
        pagination: false,
        info: false, // Bottom Left Text => Showing 1 to 10 of 12 entries
        paging: false,
        "columnDefs": [{
                "orderable": false,
                "targets": [0, 6]
            } // Disables sorting on the 1st & 7th column (index 6)
        ]
    });
</script>
@endpush
