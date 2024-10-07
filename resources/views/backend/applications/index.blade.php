@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">

    <style>
        a:hover {
            text-decoration: none !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'User Application Management')
    @include('backend.components.breadcrumb')

</div>


@include('backend.components.alert')
<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Routeone User Application Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->country }}</td>

                        <td>{{ $application->phone }}</td>
                        <td>{{ $application->email }}</td>
                        <td>
                            @if ($application->status == 1)
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    Approved
                                </span>
                            @else
                                <span
                                    class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td>{{ $application->created_at->format('Y-m-d') }}</td>
                        <td>


                            @if ($application->status == 1)
                                <a href="{{ route('application.reject', $application->id) }}" class="btn btn-danger btn-sm"><i class="ph ph-x"></i></a>
                            @else
                                <a href="{{ route('application.approve', $application->id) }}" class="btn btn-success btn-sm"><i class="ph ph-check"></i></a>
                            @endif

                            <a href="javascript:void(0)" class="btn btn-warning btn-sm view-enquiry" data-id="{{ $application->id }}">
                                <i class="ph ph-eye"></i>
                            </a>
                            <a href=" {{ route('user.settings.application', $application->user_id) }}" class="btn btn-info btn-sm">
                                <i class="ph ph-arrow-right"></i>
                            </a>





                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
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
    new DataTable('#example');
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
                            <p><strong>Agent ID:</strong> ${response.agent || 'N/A'}</p>
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