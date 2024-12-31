@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">

    <style>
        a:hover {
            text-decoration: none !important;
        }

        ol,
        ul {
            padding-left: 0 !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'User Application Management')
    @include('backend.components.breadcrumb')

    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">

        <div
    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
    <span class="text-lg"><i class="ph ph-download"></i></span>
    <a href="{{ route('download.applications.csv') }}" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">
        Download Application Data CSV
    </a>
</div>





    </div>
    <!-- Breadcrumb Right End -->

</div>


@include('backend.components.alert')
<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Routeone User Application Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name & Email</th>
                    <th>Country & Phone</th>

                    <th>Agent & Applied Position</th>

                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td><img src="{{ $application->user->profile_image ? asset('storage/' . $application->user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                                alt="Profile Image" width="50px" class="rounded-circle round-profile" height="50px">
                        </td>
                        <td>{{ $application->name }} <br> {{ $application->email }}

                            @if ($application->application_number)
                                <br>
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    {{ $application->application_number }}
                            @endif
                            </span>

                        </td>
                        <td>{{ $application->country }} <br> {{ $application->phone }}</td>


                        <td><b>{{ $application->agent->name ?? 'N/A' }}</b> <br>
                            @if ($application->vacancies->isNotEmpty())
                                {{ $application->vacancies->pluck('title')->implode(', ') }}
                            @else
                                No vacancies assigned.
                            @endif
                        </td>

                        <td>{{ $application->created_at->format('Y-m-d') }} <br>
                            @if ($application->status == 1)
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    Approved
                                </span>
                            @elseif($application->status == 0)
                                <span
                                    class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                    Rejected
                                </span>
                            @else
                                <span
                                    class="text-13 py-2 px-8 bg-warning-100 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                    Pending
                                </span>
                            @endif

                            <br>
                            @if ($application->certificate)
                                @if ($application->certificate->result == 'pass')
                                    <span
                                        class="text-13 py-2 px-10 rounded-pill bg-purple-50 text-purple-600 mt-4">English
                                        : {{ ucfirst($application->certificate->result) }}
                                    </span>
                                @else
                                    <span class="text-13 py-2 px-10 rounded-pill bg-pink-50 text-pink-600 mt-4">English
                                        : {{ ucfirst($application->certificate->result) }}</span>
                                @endif
                            @endif
                        </td>
                        <td>

                            @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
                                @if ($application->status == 1)
                                    <a href="{{ route('application.reject', $application->id) }}"
                                        class="btn btn-danger btn-sm"><i class="ph ph-x"></i></a>
                                @else
                                    <a href="{{ route('application.approve', $application->id) }}"
                                        class="btn btn-success btn-sm"><i class="ph ph-check"></i></a>
                                @endif
                            @endif

                            <a href="javascript:void(0)" class="btn btn-warning btn-sm view-enquiry"
                                data-id="{{ $application->id }}">
                                <i class="ph ph-eye"></i>
                            </a>
                            <a href=" {{ route('user.settings.application', $application->user_id) }}"
                                class="btn btn-info btn-sm">
                                <i class="ph ph-arrow-right"></i>
                            </a>





                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Image</th>

                    <th>Name & Email</th>
                    <th>Country & Phone</th>

                    <th>Agent & Applied Position</th>

                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>


    </div>

</div>
<!-- Modal -->






@endsection

@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.uikit.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "order": [
                [0, "desc"]
            ],
            columnDefs: [{
                    width: "4%",
                    targets: 0
                }, {
                    width: "8%",
                    targets: 1
                }, // Sets the width for the first column
                {
                    width: "20%",
                    targets: 2
                }, // Second column
                {
                    width: "13%",
                    targets: 3
                }, // Third column
                {
                    width: "25%",
                    targets: 4
                }, // Fourth column
                {
                    width: "10%",
                    targets: 5
                }, // Fifth column
                {
                    width: "20%",
                    targets: 6
                }, // Sixth column

            ],
            autoWidth: false // Disable automatic column width calculation
        });
    });
</script>

<script>
    $(document).on('click', '.view-enquiry', function() {
        var applicationId = $(this).data('id');

        // Send AJAX request to fetch application data
        $.ajax({
            url: "/applications/" + applicationId, // Adjust URL as needed
            method: "GET",
            success: function(response) {
                // Trigger SweetAlert with the application details
                Swal.fire({
                    title: 'Application Details',
                    html: `
                    <hr>
                        <div style="text-align: left;">
                            <p><strong>Name:</strong> ${response.name}</p>
                            <p><strong>Country:</strong> ${response.country || 'N/A'}</p>
                            <p><strong>Phone:</strong> ${response.phone || 'N/A'}</p>
                            <p><strong>Email:</strong> ${response.email}</p>
                            <p><strong>Address:</strong> ${response.address || 'N/A'}</p>
                            <p><strong>Date of Birth:</strong> ${response.dob || 'N/A'}</p>
                            <p><strong>Passport:</strong> ${response.passport || 'N/A'}</p>
                            <p><strong>Agent ID:</strong> ${response.agent_id || 'N/A'}</p>
                            <p><strong>Status:</strong> ${response.status ? 'Approved' : 'Pending'}</p>
                            <p><strong>English Proficiency:</strong> ${response.english ? 'Yes' : 'No'}</p>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Close'
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error fetching application details.',
                });
            }
        });
    });
</script>
@endpush
