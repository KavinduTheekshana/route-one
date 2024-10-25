@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">
    <style>
        ol,
        ul {
            padding-left: 0 !important;
        }

        *+address,
        *+dl,
        *+fieldset,
        *+figure,
        *+ol,
        *+p,
        *+pre,
        *+ul {
            margin-top: 0 !important;
        }

        .round-image {
            border-radius: 50%;
            object-fit: cover;
        }

        a:hover {
            text-decoration: none !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Services Management')
    @include('backend.components.breadcrumb')


</div>


@include('backend.components.alert')

<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Create Service</b></h4>
    <div class="card-body p-16">
        <form
            action="{{ route('admin.services.store') }}"
            method="POST" enctype="multipart/form-data" class="form-content pt-4">
            @csrf

            <div class="row gy-20">

                <div class="col-xxl-12 col-md-12 col-sm-12">
                    <div class="row g-20">

                        <div class="col-sm-8">
                            <label for="name" class="h6 mb-8 fw-semibold font-heading">Service Name <span
                                class="text-13 text-red fw-medium">*</span></label>
                            <div class="position-relative">
                                <input type="text" name="service_name"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Service Name"
                                    value="">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="name" class="h6 mb-8 fw-semibold font-heading">Price</label>
                            <div class="position-relative">
                                <input type="text" name="price"
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Price"
                                    value="">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="name" class="h6 mb-8 fw-semibold font-heading">Currency</label>
                            <div class="position-relative">
                                <select name="currency" class="form-select py-9 placeholder-13 text-15">
                                    <option value="GBP">GBP</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="AUD">AUD</option>
                                    <option value="JPY">JPY</option>
                                </select>
                            </div>
                        </div>














                        {{-- Meta Description --}}
                        <div class="col-12">
                            <div class="editor">
                                <label for="name" class="h6 mb-8 fw-semibold font-heading">Service Description : <span
                                    class="text-13 text-gray fw-medium">( Optional )</span></label>
                                <textarea placeholder="Service Description" name="review" class="form-control" rows="3">{{ isset($testimonial) ? $testimonial->review : old('review') }}</textarea>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="flex-align justify-content-end gap-8">
                    <button type="reset"
                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                    <button type="submit"
                        class="btn btn-main rounded-pill py-9">{{ isset($testimonial) ? 'Update Testimonial' : 'Create Service' }}</button>
                </div>
            </div>
        </form>
    </div>

</div>


<div class="card overflow-hidden p-16 mt-30">
    <h4 class="mb-0 ml-4"><b>Routeone Jobs Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($testimonials as $testimonial)
                <tr>
                    <td>

                        <img src="{{ $testimonial->file_path ? asset('storage/' . $testimonial->file_path) : asset('backend/images/bg/default.png') }}" alt="Testimonial Image" width="50px"
                            class="rounded-circle round-profile" height="50px">

                        </td>
                    <td>{{ $testimonial->name }}</td>
                    <td>{{ $testimonial->title }}</td>
                    <td>{{ $testimonial->review }}</td>


                    <td>
                        @if ($testimonial->status == 1)
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                Active
                            </span>
                        @else
                            <span
                                class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                Disabled
                            </span>
                        @endif
                    </td>

                    <td>

                            @if ($testimonial->status == 1)
                                <a href="{{ route('testimonial.block', $testimonial->id) }}" class="btn btn-danger btn-sm"><i class="ph ph-lock"></i></a>
                            @else
                                <a href="{{ route('testimonial.unblock', $testimonial->id) }}" class="btn btn-success btn-sm"><i class="ph ph-lock-open"></i></a>
                            @endif

                            <a href="{{ route('testimonial.settings', $testimonial->id) }}" class="btn btn-warning btn-sm"><i
                                    class="ph ph-eye"></i></a>
                            <!-- Delete Button -->
                            <button class="btn btn-dark btn-sm" onclick="confirmDelete({{ $testimonial->id }})">
                                <i class="ph ph-trash"></i>
                            </button>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $testimonial->id }}"
                                action="{{ route('testimonial.destroy', $testimonial->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                    </td>
                </tr>
            @endforeach --}}


            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>


    </div>

</div>


@endsection

@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.uikit.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            columnDefs: [{
                    targets: 2,
                    width: "10%"
                }, // 3rd column (index 2) width set to 40%
                {
                    targets: 0,
                    width: "10%"
                }, // Example: 1st column width to 10%
                {
                    targets: 1,
                    width: "10%"
                }, // Example: 2nd column width to 10%
                {
                    targets: 3,
                    width: "40%"
                }, // Example: 2nd column width to 10%
            ]
        });
    });
</script>




<script>
    function confirmDelete(testimonialId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('delete-form-' + testimonialId).submit();
            }
        });
    }
</script>
@endpush
