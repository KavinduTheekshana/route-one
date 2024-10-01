@push('styles')
@endpush

@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    @section('page_name', isset($vacancy) ? 'Edit Job' : 'Create Job')
    @include('backend.components.breadcrumb')
</div>

@include('backend.components.alert')



<div class="card">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">Job Details</h5>
    </div>
    <div class="card-body">
        <form
            action="{{ isset($vacancy) ? route('admin.vacancies.update', $vacancy->id) : route('admin.vacancies.store') }}"
            method="POST" enctype="multipart/form-data" class="form-content pt-4">
            @csrf

            @if (isset($vacancy))
                @method('PUT')
            @endif
            <div class="row gy-20">

                <div class="col-xxl-12 col-md-12 col-sm-12">
                    <div class="row g-20">

                        <div class="col-sm-6">
                            <label for="company" class="h5 mb-8 fw-semibold font-heading">Company</label>
                            <div class="position-relative">
                                <input type="text" name="company"
                                    class="text-counter placeholder-13 form-control py-11 pe-76"
                                    placeholder="Company Name"
                                    value="{{ old('company', isset($vacancy) ? $vacancy->company : '') }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="title" class="h5 mb-8 fw-semibold font-heading">Job Title <span
                                    class="text-13 text-red fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="text" name="title"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Job Title"
                                    value="{{ old('title', isset($vacancy) ? $vacancy->title : '') }}">
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Location <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <div class="position-relative">
                                <input type="text" name="location"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Location"
                                    value="{{ old('location', isset($vacancy) ? $vacancy->location : '') }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="jobType" class="h5 mb-8 fw-semibold font-heading">Job Type <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <div class="position-relative">
                                <select name="job_type" class="form-select py-9 placeholder-13 text-15 mb-10">
                                    <option value="" disabled {{ !isset($vacancy) ? 'selected' : '' }}>Select Job
                                        Type</option>
                                    <option value="full-time"
                                        {{ isset($vacancy) && $vacancy->job_type == 'full-time' ? 'selected' : '' }}>
                                        Full-time</option>
                                    <option value="part-time"
                                        {{ isset($vacancy) && $vacancy->job_type == 'part-time' ? 'selected' : '' }}>
                                        Part-time</option>
                                    <option value="contract"
                                        {{ isset($vacancy) && $vacancy->job_type == 'contract' ? 'selected' : '' }}>
                                        Contract</option>
                                    <option value="temporary"
                                        {{ isset($vacancy) && $vacancy->job_type == 'temporary' ? 'selected' : '' }}>
                                        Temporary</option>
                                    <option value="internship"
                                        {{ isset($vacancy) && $vacancy->job_type == 'internship' ? 'selected' : '' }}>
                                        Internship</option>
                                    <option value="volunteer"
                                        {{ isset($vacancy) && $vacancy->job_type == 'volunteer' ? 'selected' : '' }}>
                                        Volunteer</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-sm-4">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Salary</label>
                            <div class="position-relative">
                                <input type="number" name="salary"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Salary"
                                    value="{{ isset($vacancy) ? $vacancy->salary : old('salary') }}">
                                    <span class="text-11 text-gray fw-medium">Please Enter Yearly Salary</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="imageUpload" class="form-label mb-8 h6">Your Photo</label>
                            <div class="flex-align gap-22">
                                <div class="avatar-upload flex-shrink-0">
                                    <input type="file" name="profile_image" id="imageUpload"
                                        accept=".png, .jpg, .jpeg">
                                    <div class="avatar-preview-vacancies">
                                        <div id="profileImagePreview"
                                            style="background-image: url('{{ isset($vacancy) && $vacancy->file_path ? asset('storage/' . $vacancy->file_path) : asset('backend/images/bg/default.png') }}');">
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


                        <div class="col-sm-8">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Tags</label>
                            <div class="position-relative">
                                <input type="text" name="tags"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Tags"
                                    value="{{ isset($vacancy) ? $vacancy->tags : old('tags') }}">
                                    <span class="text-11 text-gray fw-medium">Kindly enter tags separated by commas.</span>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <label for="experience" class="h5 mb-8 fw-semibold font-heading">Needed Experience</label>
                            <div class="position-relative">
                                <select name="experience" class="form-select py-9 placeholder-13 text-15 mb-10">
                                    <option value="" disabled {{ !isset($vacancy) ? 'selected' : '' }}>Select
                                        Experience</option>
                                    <option value="No"
                                        {{ isset($vacancy) && $vacancy->experience == 'No' ? 'selected' : '' }}>No Experience Needed</option>
                                    <option value="1+"
                                        {{ isset($vacancy) && $vacancy->experience == '1+' ? 'selected' : '' }}>1+
                                        Years Of Experience</option>
                                    <option value="2+"
                                        {{ isset($vacancy) && $vacancy->experience == '2+' ? 'selected' : '' }}>2+
                                        Years Of Experience</option>
                                    <option value="3+"
                                        {{ isset($vacancy) && $vacancy->experience == '3+' ? 'selected' : '' }}>3+
                                        Years Of Experience</option>
                                    <option value="4+"
                                        {{ isset($vacancy) && $vacancy->experience == '4+' ? 'selected' : '' }}>4+
                                        Years Of Experience</option>
                                    <option value="5+"
                                        {{ isset($vacancy) && $vacancy->experience == '5+' ? 'selected' : '' }}>5+
                                        Years Of Experience</option>
                                </select>
                            </div>
                        </div>

                        {{-- Meta Description --}}
                        <div class="col-12">
                            <div class="editor">
                                <label class="form-label mb-8 h6">Meta Description <span
                                        class="text-13 text-red fw-medium">(Required)</span></label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ isset($vacancy) ? $vacancy->meta_description : old('meta_description') }}</textarea>
                            </div>
                        </div>

                        {{-- Job Description --}}
                        <div class="col-12">
                            <div class="editor">
                                <label class="form-label mb-8 h6">Description <span
                                        class="text-13 text-red fw-medium">(Required)</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ isset($vacancy) ? $vacancy->description : old('description') }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12" style="display: flex">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="featured"
                                    id="featuredCheckbox" value="1" {{ old('featured') ? 'checked' : '' }}
                                    {{ isset($vacancy) && $vacancy->featured ? 'checked' : '' }}>
                                <label class="form-check-label text-success" for="inlineCheckbox1">&nbsp;
                                    Featured</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="urgent" id="featuredCheckbox"
                                    value="1" {{ old('urgent') ? 'checked' : '' }}
                                    {{ isset($vacancy) && $vacancy->urgent ? 'checked' : '' }}>
                                <label class="form-check-label text-warning" for="inlineCheckbox2">&nbsp;
                                    Urgent</label>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="flex-align justify-content-end gap-8">
                    <button type="reset"
                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                    <button type="submit"
                        class="btn btn-main rounded-pill py-9">{{ isset($vacancy) ? 'Update Job' : 'Create Job' }}</button>
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

<script src="https://cdn.tiny.cloud/1/mc59edcciy0vssoo3ojx1vwpo2jbsemez61eo60xxi6p5wse/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>


<script>
    tinymce.init({
        selector: '#description',
        plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
            'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Oct 11, 2024:
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
            'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
            'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
            'autocorrect', 'typography', 'inlinecss', 'markdown',
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            'See docs to implement AI Assistant')),
    });
</script>
@endpush
