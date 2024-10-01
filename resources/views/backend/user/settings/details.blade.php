    <!-- My Details Tab start -->
    <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab"
        tabindex="0">
        <div class="card mt-24">

            <div class="card-header border-bottom">
                <h4 class="mb-4">Member Details</h4>
                <p class="text-gray-600 text-15">You have selected the user's details. You can update their information below.</p>
            </div>
            <div class="card-body">



                {{-- @include('backend.components.alert') --}}


                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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