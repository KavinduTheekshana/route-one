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

                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                        alt="" class="w-120 h-120 rounded-circle border border-white">


                    <div>
                        <h4 class="mb-8">{{ $user->name }}</h4>
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

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-document-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-document" type="button" role="tab" aria-controls="pills-document"
                        aria-selected="false">Documents</button>
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
                <p class="text-gray-600 text-15">You have selected the team member's details. You can update their
                    information below.</p>
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
                            <input type="number" class="form-control py-11" name="phone"
                                placeholder="Enter Phone Number" value="{{ $user->phone }}">
                        </div>

                        <div class="col-sm-6 col-xs-6">
                            <label for="phone" class="form-label mb-8 h6">Role</label>
                            <select name="role" class="form-select py-9 placeholder-13 text-15 mb-10">
                                <option value="admin" {{ $user->user_type === 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="agent" {{ $user->user_type === 'agent' ? 'selected' : '' }}>Agent
                                </option>
                                <option value="superadmin" {{ $user->user_type === 'superadmin' ? 'selected' : '' }}>
                                    Super Admin</option>
                                <option value="teacher" {{ $user->user_type === 'teacher' ? 'selected' : '' }}>Teacher
                                </option>
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
                                            style="background-image: url('{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}');">
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
    <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab"
        tabindex="0">
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
                                        <input type="password" class="form-control py-11" id="new-password"
                                            name="new_password" placeholder="Enter New Password">
                                        <span
                                            class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"></span>
                                    </div>
                                    @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control py-11" id="confirm-password"
                                            name="new_password_confirmation" placeholder="Enter Confirm Password">
                                        <span
                                            class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"></span>
                                    </div>
                                    @error('new_password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label mb-8 h6">Password Requirements:</label>
                                    <ul class="list-inside">
                                        <li class="text-gray-600 mb-4">At least one lowercase character</li>
                                        <li class="text-gray-600 mb-4">Minimum 8 characters long - the more, the better
                                        </li>
                                        <li class="text-gray-600 mb-4">At least one number, symbol, or whitespace
                                            character</li>
                                    </ul>
                                </div>

                                <div class="col-12">
                                    <div class="flex-align justify-content-end gap-8">
                                        <button type="reset"
                                            class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                                        <button type="submit" class="btn btn-main rounded-pill py-9">Save
                                            Changes</button>
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

    {{-- document tab  --}}
    <div class="tab-pane fade" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab"
        tabindex="0">
        <div class="card mt-24">
            <div class="card-header border-bottom">
                <h4 class="mb-4">Documents</h4>
                <p class="text-gray-600 text-15">Agent Documents</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="col-12">
                            {{-- <label for="documentType" class="h5 mb-8 fw-semibold font-heading">Attached Documents</label> --}}

                            @if ($documents->isEmpty())
                                <p>No documents found for this user.</p>
                            @else
                                <ul>
                                    <div class="row">
                                        @foreach ($documents as $document)
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
                                                                @elseif($document->file_type == 'application/pdf')
                                                                    <i class="ph ph-file-pdf"></i>
                                                                @else
                                                                    <i class="ph ph-paperclip"></i>
                                                                @endif


                                                            </span>
                                                            <div class="">
                                                                <p class="text-15 text-gray-500"><strong>
                                                                        {{ ucwords(str_replace('_', ' ', $document->document_type)) }}

                                                                    </strong> - {{ $document->file_original_name }}
                                                                </p>
                                                                <p class="text-13 text-gray-600">( File Size :
                                                                    {{ number_format($document->file_size / 1024, 2) }}
                                                                    KB )</p>
                                                                <p class="text-13 text-gray-600">
                                                                    {{ $document->file_name }}</p>
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
                                                                                            <span
                                                                                                class="text">View</span>
                                                                                        </button>

                                                                                        <a href="{{ asset('storage/' . $document->file_path) }}"
                                                                                            type="button"
                                                                                            download="{{ $document->file_original_name }}"
                                                                                            class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                                                            <span
                                                                                                class="text">Download</span>
                                                                                        </a>


                                                                                        <button type="button"
                                                                                            onclick="confirmDelete({{ $document->id }})"
                                                                                            class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                                                            <span
                                                                                                class="text">Delete</span>
                                                                                        </button>
                                                                                        <form
                                                                                            id="delete-form-{{ $document->id }}"
                                                                                            action="{{ route('documents.destroy', $document->id) }}"
                                                                                            method="POST"
                                                                                            style="display: none;">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                        </form>

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

                        <!-- Modal for viewing document -->
                        <div class="modal fade" id="documentModal" tabindex="-1"
                            aria-labelledby="documentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="documentModalLabel">Document Viewer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal-body-full">
                                        <iframe id="documentFrame" src="" width="100%" height="500px"
                                            frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

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

<!-- SweetAlert Script -->
<script>
    function confirmDelete(documentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + documentId).submit();
            }
        })
    }


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

