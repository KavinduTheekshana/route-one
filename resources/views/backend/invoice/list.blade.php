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
    @section('page_name', 'Invoice Management')
    @include('backend.components.breadcrumb')

    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">

        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-plus"></i></span>
            <a href="{{ route('admin.invoice.create') }}"
                class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">CREATE INVOICE</a>
        </div>
    </div>
    <!-- Breadcrumb Right End -->
</div>


@include('backend.components.alert')

<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Routeone Invoice Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Services</th>
                    <th>Customer Details</th>
                    <th>Subtotal</th>
                    <th>Tax</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>#{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>
                            <ul>
                                @foreach ($invoice->services as $service)
                                    <li>
                                        <strong></strong> {{ $service->service_name }}<br>
                                        <strong>Quantity:</strong> {{ $service->qty }} | <strong>Price:</strong>
                                        ${{ $service->price }}
                                        | <strong>Total:</strong> ${{ $service->total }} <br><br>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $invoice->customer->name ?? 'N/A' }} <br> <span
                                class="text-danger">{{ $invoice->customer->email ?? 'N/A' }}</span><br> <span
                                class="text-primary">{{ $invoice->customer->address ?? 'N/A' }}</span></td>
                        <td>£ {{ $invoice->subtotal }}</td>
                        <td>£ {{ $invoice->tax }}</td>
                        <td>£ {{ $invoice->total_fee }}</td>




                        <td>

                            {{-- @if ($vacancy->status == 1)
                                <a href="{{ route('vacancies.block', $vacancy->id) }}" class="btn btn-danger btn-sm"><i class="ph ph-lock"></i></a>
                            @else
                                <a href="{{ route('vacancies.unblock', $vacancy->id) }}" class="btn btn-success btn-sm"><i class="ph ph-lock-open"></i></a>
                            @endif --}}

                            <a href="{{ route('admin.invoice.view', $invoice->id) }}" class="btn btn-warning btn-sm"><i
                                    class="ph ph-eye"></i></a>
                            <!-- Delete Button -->
                            <button class="btn btn-dark btn-sm" onclick="confirmDelete({{ $invoice->id }})">
                                <i class="ph ph-trash"></i>
                            </button>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $invoice->id }}"
                                action="{{ route('invoice.destroy', $invoice->id) }}" method="POST"
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
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Services</th>
                    <th>Customer Details</th>
                    <th>Subtotal</th>
                    <th>Tax</th>
                    <th>Total Amount</th>
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
    new DataTable('#example', {
        order: [
            [0, 'desc']
        ],
        columnDefs: [{
                width: "6%",
                targets: 0
            }, // Sets the width for the first column
            {
                width: "10%",
                targets: 1
            }, // Second column
            {
                width: "23%",
                targets: 2
            }, // Third column
            {
                width: "23%",
                targets: 3
            }, // Fourth column
            {
                width: "10%",
                targets: 4
            }, // Fifth column
            {
                width: "8%",
                targets: 5
            }, // Sixth column
            {
                width: "10%",
                targets: 6
            }, // Sixth column
            {
                width: "10%",
                targets: 7
            }, // Sixth column
        ],
        autoWidth: false // Disable automatic column width calculation// Set the first column (index 0) to order by descending
    });
</script>



<script>
    function confirmDelete(invoiceID) {
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
                document.getElementById('delete-form-' + invoiceID).submit();
            }
        });
    }
</script>
@endpush
