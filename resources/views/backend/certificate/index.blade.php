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
    @section('page_name', 'User Certificate Management')
    @include('backend.components.breadcrumb')

</div>


@include('backend.components.alert')
<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>User Certificate Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Applicant Name</th>
                    <th>DOB</th>
                    <th>Result</th>
                    <th>Assessment Date</th>
                    <th>Confirmation Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificates as $certificate)
                    <tr>
                        <td>{{ $certificate->id }}</td>
                        <td>{{ $certificate->applicant_name }}</td>
                        <td>{{ $certificate->dob }}</td>
                        <td>
                            @if ($certificate->result == 'pass')
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    Pass
                                </span>
                            @else
                                <span
                                    class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                    Fail
                                </span>
                            @endif
                        </td>
                        <td>{{ $certificate->assessment_date }}</td>
                        <td>{{ $certificate->confirmation_code }}</td>
                        <td>
                            <a href=" {{ route('user.settings.application', $certificate->user_id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="ph ph-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Applicant Name</th>
                    <th>DOB</th>
                    <th>Result</th>
                    <th>Assessment Date</th>
                    <th>Confirmation Code</th>
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
            autoWidth: true // Disable automatic column width calculation
        });
    });
</script>
@endpush
