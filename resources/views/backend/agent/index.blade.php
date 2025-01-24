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

        #documentViewer {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Agent Verification')
    @include('backend.components.breadcrumb')

    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">

        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-check-square"></i></span>
            <button id="download-btn" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">
                Download Selected Users CSV
                </a>
        </div>

        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-download"></i></span>
            <a href="{{ route('download.users.csv') }}"
                class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">
                Download User's Details CSV
            </a>
        </div>



        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-plus"></i></span>
            <a href="{{ route('user.create') }}"
                class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">ADD USER</a>
        </div>
    </div>
    <!-- Breadcrumb Right End -->
</div>


@include('backend.components.alert')

<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Routeone Agent Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Agent Details</th>
                    <th>Documents</th>
                    <th>Status</th>
                    <th>Join date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                                alt="Profile Image" width="50px" class="rounded-circle round-profile" height="50px">
                        </td>
                        <td>Name : {{ $user->name }} <br>
                            Email: {{ $user->email }} <br>
                            Phone: {{ $user->phone ?? 'N/A' }} <br>
                            Country: {{ $user->country ?? 'N/A' }}
                        </td>
                        <td>
                            @foreach ($user->documents as $document)
                                <div>
                                    {{ $document->file_original_name }} &nbsp;
                                    <a class="text-primary"
                                        onclick="viewDocument('{{ asset('storage/' . $document->file_path) }}', '{{ pathinfo($document->file_path, PATHINFO_EXTENSION) }}')">
                                        View
                                    </a>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            @if ($user->type == 'unverifiedagent')
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
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>

                            <a href="{{ route('user.settings', $user->id) }}" class="btn btn-warning btn-sm"><i
                                class="ph ph-eye"></i></a>

                            @if ($user->type == 'unverifiedagent')
                                <a href="{{ route('agent.block', $user->id) }}" class="btn btn-danger btn-sm"><i
                                        class="ph ph-lock"></i></a>
                            @else
                                <a href="{{ route('agent.unblock', $user->id) }}" class="btn btn-success btn-sm"><i
                                        class="ph ph-check"></i></a>
                            @endif

                            <button class="btn btn-dark btn-sm" onclick="confirmDelete({{ $user->id }})">
                                <i class="ph ph-trash"></i>
                            </button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}"
                                method="POST" style="display: none;">
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
                    <th>Agent Details</th>
                    <th>Documents</th>
                    <th>Status</th>
                    <th>Join date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        {{-- <div class="flex-align justify-content-end gap-8 mt-3">
            <button type="button" class="btn btn-secondary rounded-pill py-9" id="download-btn">Download Selected
                Users</button>
        </div> --}}
        <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="documentModalLabel">Document Viewer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


@endsection

@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.uikit.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            // columnDefs: [
            //     {
            //         width: "2%",
            //         targets: 0
            //     },
            //     {
            //         width: "7%",
            //         targets: 1
            //     }, // Sets the width for the first column
            //     {
            //         width: "18%",
            //         targets: 2
            //     }, // Second column
            //     {
            //         width: "15%",
            //         targets: 3
            //     }, // Third column
            //     {
            //         width: "10%",
            //         targets: 4
            //     }, // Fourth column
            //     {
            //         width: "10%",
            //         targets: 5
            //     }, // Fifth column
            //     {
            //         width: "10%",
            //         targets: 6
            //     }, // Sixth column
            //     {
            //         width: "10%",
            //         targets: 7
            //     }, // Sixth column
            //     {
            //         width: "18%",
            //         targets: 8
            //     }, // Sixth column
            // ],
            autoWidth: false // Disable automatic column width calculation
        });
    });
</script>



<script>
    function confirmDelete(userId) {
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
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }

    // function viewDocument(documentUrl) {
    //     const documentViewer = document.getElementById('documentViewer');
    //     documentViewer.src = documentUrl;
    //     const documentModal = new bootstrap.Modal(document.getElementById('documentModal'));
    //     documentModal.show();
    // }

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
