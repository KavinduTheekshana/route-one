@push('styles')
@endpush

@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    @section('page_name', isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial')
    @include('backend.components.breadcrumb')
</div>

@include('backend.components.alert')



<div class="card">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">Testimonial Details</h5>
    </div>
    <div class="card-body">
        <form
            action="{{ isset($testimonial) ? route('admin.testimonial.update', $testimonial->id) : route('admin.testimonial.store') }}"
            method="POST" enctype="multipart/form-data" class="form-content pt-4">
            @csrf

            @if (isset($testimonial))
                @method('PUT')
            @endif
            <div class="row gy-20">

                <div class="col-xxl-12 col-md-12 col-sm-12">
                    <div class="row g-20">

                        <div class="col-sm-6">
                            <label for="name" class="h5 mb-8 fw-semibold font-heading">Name <span
                                class="text-13 text-red fw-medium">(Required)</span></label>
                            <div class="position-relative">
                                <input type="text" name="name"
                                    class="text-counter placeholder-13 form-control py-11 pe-76"
                                    placeholder="Name"
                                    value="{{ old('name', isset($testimonial) ? $testimonial->name : '') }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="title" class="h5 mb-8 fw-semibold font-heading">Job Title <span
                                    class="text-13 text-red fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="text" name="title"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Job Title"
                                    value="{{ old('title', isset($testimonial) ? $testimonial->title : '') }}">
                            </div>
                        </div>







                        <div class="col-12">
                            <label for="imageUpload" class="form-label mb-8 h6">Photo</label>
                            <div class="flex-align gap-22">
                                <div class="avatar-upload flex-shrink-0">
                                    <input type="file" name="testimonial_image" id="imageUpload"
                                        accept=".png, .jpg, .jpeg">
                                    <div class="avatar-preview-vacancies">
                                        <div id="profileImagePreview"
                                            style="background-image: url('{{ isset($testimonial) && $testimonial->file_path ? asset('storage/' . $testimonial->file_path) : asset('backend/images/bg/default.png') }}');">
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






                        {{-- Meta Description --}}
                        <div class="col-12">
                            <div class="editor">
                                <label class="form-label mb-8 h6">Review <span
                                        class="text-13 text-red fw-medium">(Required)</span></label>
                                <textarea name="review" class="form-control" rows="3">{{ isset($testimonial) ? $testimonial->review : old('review') }}</textarea>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="flex-align justify-content-end gap-8">
                    <button type="reset"
                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                    <button type="submit"
                        class="btn btn-main rounded-pill py-9">{{ isset($testimonial) ? 'Update Testimonial' : 'Create Testimonial' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>






@endsection

@push('scripts')
<script>
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
