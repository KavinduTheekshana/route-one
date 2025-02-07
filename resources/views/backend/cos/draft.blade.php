@push('styles')
@endpush

@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    @section('page_name', 'Create COS Draft')
    @include('backend.components.breadcrumb')
</div>

@include('backend.components.alert')



<div class="card">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">COS Draft Details for {{ $application->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('draft.store') }}" method="POST" class="form-content pt-4">
            @csrf
            <input type="hidden" name="application_id" value="{{ $application->id }}">
            <div class="row gy-20">

                <div class="col-xxl-12 col-md-12 col-sm-12">
                    <div class="row g-20">

                        <h4 class="mt-40 text-dark">Sponsor Details</h4>
                        <hr>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Sponsor License Number</label>
                            <input type="text" name="sponsor_license_number" class="form-control py-11 pe-76"
                                value="{{ $submittedData->sponsor_license_number ?? '' }}"
                                placeholder="Sponsor License Number">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Sponsor Name</label>
                            <input type="text" name="sponsor_name" class="form-control py-11 pe-76"
                                value="{{ $submittedData->sponsor_name ?? '' }}" placeholder="Sponsor Name">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Certificate Number</label>
                            <input type="text" name="certificate_number" class="form-control py-11 pe-76"
                                value="{{ $submittedData->certificate_number ?? '' }}" placeholder="Certificate Number">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Status</label>
                            <select name="role" class="form-select py-9 placeholder-13 text-15 mb-10">
                                <option value="DRAFT" {{ ($submittedData->role ?? '') == 'DRAFT' ? 'selected' : '' }}>
                                    DRAFT</option>
                                <option value="ASSIGNED"
                                    {{ ($submittedData->role ?? '') == 'ASSIGNED' ? 'selected' : '' }}>ASSIGNED</option>
                                <option value="READY TO GO"
                                    {{ ($submittedData->role ?? '') == 'READY TO GO' ? 'selected' : '' }}>READY TO GO
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Certificate Status Date</label>
                            <input type="date" name="current_certificate_status_date"
                                class="form-control py-11 pe-76"
                                value="{{ $submittedData->current_certificate_status_date ?? '' }}"
                                class="form-control py-11 pe-76">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Date Assigned</label>
                            <input type="date" name="date_assign" class="form-control py-11 pe-76"
                                value="{{ $submittedData->date_assign ?? '' }}" class="form-control py-11 pe-76">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Expire Date</label>
                            <input type="date" name="expire_date" class="form-control py-11 pe-76"
                                value="{{ $submittedData->expire_date ?? '' }}" class="form-control py-11 pe-76">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Sponsor Note</label>
                            <textarea name="sponsor_note" class="form-control" rows="10">{{ $submittedData->sponsor_note ?? '' }}</textarea>
                        </div>

                        <h4 class="mt-40 text-dark">Personal Information </h4>
                        <hr>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Family Name <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="family_name" class="form-control py-11 pe-76"
                                value="{{ $submittedData->family_name ?? '' }}" placeholder="Family Name">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Given Name <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="given_name" class="form-control py-11 pe-76"
                                value="{{ $submittedData->given_name ?? '' }}" placeholder="Given Name">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Other Names</label>
                            <input type="text" name="Other_names" class="form-control py-11 pe-76"
                                value="{{ $submittedData->Other_names ?? '' }}" placeholder="Other Names"
                                value="N/A">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Nationality <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="nationality" class="form-control py-11 pe-76"
                                value="{{ $submittedData->nationality ?? '' }}" placeholder="Nationality">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Place of Birth <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="place_of_birth" class="form-control py-11 pe-76"
                                value="{{ $submittedData->place_of_birth ?? '' }}" placeholder="Place of Birth">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Country of Birth <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="country_of_birth" class="form-control py-11 pe-76"
                                value="{{ $submittedData->country_of_birth ?? '' }}" placeholder="Country of Birth">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Date of Birth <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="date" name="dob" class="form-control py-11 pe-76"
                                value="{{ $submittedData->dob ?? '' }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Gender</label>
                            <input type="text" name="gender" class="form-control py-11 pe-76"
                                value="{{ $submittedData->gender ?? '' }}" placeholder="Gender">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Country of Residence <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="country_of_residence" class="form-control py-11 pe-76"
                                value="{{ $submittedData->country_of_residence ?? '' }}"
                                placeholder="Country of Residence">
                        </div>

                        <h4 class="mt-40 text-dark">Passport Information </h4>
                        <hr>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Passport Number <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="passport" class="form-control py-11 pe-76"
                                value="{{ $submittedData->passport ?? '' }}" placeholder="Passport Number">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Issue Date <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="date" name="issue_date" class="form-control py-11 pe-76"
                                value="{{ $submittedData->issue_date ?? '' }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Expiry Date <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="date" name="expiry_date" class="form-control py-11 pe-76"
                                value="{{ $submittedData->expiry_date ?? '' }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Place of Issue <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="place_of_issue" class="form-control py-11 pe-76"
                                value="{{ $submittedData->place_of_issue ?? '' }}" placeholder="Place of Issue">
                        </div>

                        <h4 class="mt-40 text-dark">Current Address</h4>
                        <hr>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Address <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="address" class="form-control py-11 pe-76"
                                value="{{ $submittedData->address ?? '' }}" placeholder="Address">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">City <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="city" class="form-control py-11 pe-76"
                                value="{{ $submittedData->city ?? '' }}" placeholder="City">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Postcode <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="postcode" class="form-control py-11 pe-76"
                                value="{{ $submittedData->postcode ?? '' }}" placeholder="Postcode">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">County, area district or province <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="county" class="form-control py-11 pe-76"
                                value="{{ $submittedData->county ?? '' }}" placeholder="County">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Country <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="country" class="form-control py-11 pe-76"
                                value="{{ $submittedData->country ?? '' }}" placeholder="Country">
                        </div>

                        <h4 class="mt-40 text-dark">Work Details </h4>
                        <hr>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Start Date <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="date" name="start_date" class="form-control py-11 pe-76"
                                value="{{ $submittedData->start_date ?? '' }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">End Date <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="date" name="end_date" class="form-control py-11 pe-76"
                                value="{{ $submittedData->end_date ?? '' }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Hours of Work <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="hours_of_work" class="form-control py-11 pe-76"
                                value="{{ $submittedData->hours_of_work ?? '' }}" placeholder="Hours of Work">
                        </div>

                        <h4 class="mt-40 text-dark">Employment Details </h4>
                        <hr>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Job Title <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="job_title" class="form-control py-11 pe-76"
                                value="{{ $submittedData->job_title ?? '' }}" placeholder="Job Title">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Job Type <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="text" name="job_type" class="form-control py-11 pe-76"
                                value="{{ $submittedData->job_type ?? '' }}" placeholder="Job Type">
                        </div>

                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Job Description <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <textarea name="description" class="form-control py-11 pe-76" rows="4" placeholder="Job Description">{{ $submittedData->description ?? '' }}</textarea>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Salary (£) <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <input type="number" name="salary" class="form-control py-11 pe-76"
                                value="{{ $submittedData->salary ?? '' }}" placeholder="Salary">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">PAYE Reference</label>
                            <input type="text" name="paye_reference" class="form-control py-11 pe-76"
                                value="{{ $submittedData->paye_reference ?? '' }}" placeholder="PAYE Reference">
                        </div>

                    </div>
                </div>

                {{-- Buttons --}}
                {{-- <div class="flex-align justify-content-end gap-8 mt-20">
                    <button type="button" class="btn btn-outline-main rounded-pill py-9"
                        id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Save Draft</button>
                </div> --}}

                <div class="flex-align justify-content-end gap-8 mt-20">
                    <button type="button" class="btn btn-outline-main" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-main">
                        {{ $submittedData ? 'Update COS Draft' : 'Create COS Draft' }}
                    </button>
                    @if ($submittedData)
                        <a href="{{ route('draft.issue', $application->id) }}" class="btn btn-dark" target="_blank">
                            Preview COS Draft
                        </a>

                        <a href="{{ route('draft.download', $application->id) }}" class="btn btn-success">
                            Download COS Draft
                        </a>
                    @endif
                </div>

            </div>
        </form>

    </div>
</div>






@endsection

@push('scripts')
@endpush
