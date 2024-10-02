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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $contact)
                    <tr>
                        <td>{{ $contact->first_name }}</td>
                        <td>{{ $contact->last_name }}</td>

                        <td>{{ $contact->subject }}</td>
                        <td>
                            @if ($contact->status == 1)
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    Read
                                </span>
                            @else
                                <span
                                    class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                    Unread
                                </span>
                            @endif
                        </td>
                        <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                        <td>


                            @if ($contact->status == 1)
                                <a href="{{ route('contact.unread', $contact->id) }}" class="btn btn-danger btn-sm"><i class="ph ph-envelope-simple"></i></a>
                            @else
                                <a href="{{ route('contact.read', $contact->id) }}" class="btn btn-success btn-sm"><i class="ph ph-envelope-open"></i></a>
                            @endif

                            <a href="javascript:void(0)" class="btn btn-warning btn-sm view-enquiry" data-id="{{ $contact->id }}"><i class="ph ph-eye"></i></a>

                            <!-- Delete Button -->
                            <button class="btn btn-dark btn-sm" onclick="confirmDelete({{ $contact->id }})">
                                <i class="ph ph-trash"></i>
                            </button>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $contact->id }}"
                                action="{{ route('contact.destroy', $contact->id) }}" method="POST"
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Subject</th>
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
    $(document).on('click', '.view-enquiry', function () {
        var enquiryId = $(this).data('id');

        // Send AJAX request to fetch enquiry data
        $.ajax({
            url: "/enquiries/" + enquiryId,
            method: "GET",
            success: function (response) {
                // Trigger SweetAlert with the enquiry details
                Swal.fire({
                    title: 'Enquiry Details',
                    html:
                        `<p><strong>First Name:</strong> ${response.first_name}</p>` +
                        `<p><strong>Last Name:</strong> ${response.last_name}</p>` +
                        `<p><strong>Email:</strong> ${response.email}</p>` +
                        `<p><strong>Phone:</strong> ${response.phone}</p>` +
                        `<p><strong>Subject:</strong> ${response.subject}</p>` +
                        `<p><strong>Country:</strong> ${response.country}</p>` +
                        `<p><strong>Message:</strong> ${response.message}</p>`,
                    icon: 'info',
                    confirmButtonText: 'Close'
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error fetching enquiry details.',
                });
            }
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
</script>
@endpush
