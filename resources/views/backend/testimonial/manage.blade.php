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
    @section('page_name', 'Testimonial Management')
    @include('backend.components.breadcrumb')

    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">

        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-plus"></i></span>
            <a href="{{ route('admin.testimonial.create') }}"
                class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">CREATE TESTIMONIAL</a>
        </div>
    </div>
    <!-- Breadcrumb Right End -->
</div>


@include('backend.components.alert')

<div class="card overflow-hidden p-16">
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
                @foreach ($testimonials as $testimonial)
                <tr>
                    <td>

                        <img src="{{ $testimonial->file_path ? asset('storage/' . $testimonial->file_path) : asset('backend/images/bg/default.png') }}" alt="Profile Image" width="50px"
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
            @endforeach


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
    new DataTable('#example');
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
