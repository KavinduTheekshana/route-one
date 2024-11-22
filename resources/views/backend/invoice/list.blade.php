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
                    <th>IN / Date</th>
                    <th>Agent & Services</th>
                    <th>Customer Details</th>
                    <th>Values</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>#{{ $invoice->invoice_number }} <br>
                            {{ $invoice->date }}

                        </td>

                        <td>
                            <small class="text-primary">Agent : {{ $invoice->user->name }}</small>
                            <ul>
                                @foreach ($invoice->services as $service)
                                    <li>
                                        <strong></strong> {{ $service->service_name }}<br>
                                        <strong>Quantity:</strong> {{ $service->qty }} | <strong>Price:</strong>
                                        ${{ $service->price }}
                                        | <strong>Total:</strong> ${{ $service->total }} <br>
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                        <td>{{ $invoice->customer->name ?? 'N/A' }} <br> <span
                                class="text-secondary">{{ $invoice->customer->email ?? 'N/A' }}</span><br> <span
                                class="text-secondary">{{ $invoice->customer->address ?? 'N/A' }}</span></td>

                        <td><small>Subtotal : £ {{ $invoice->subtotal }} </small> <br>
                            <small>Tax : £ {{ $invoice->tax }} </small> <br>
                            <b> Total : £ {{ $invoice->total_fee }} </b> <br>
                            @if ($invoice->status == 1)
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    &nbsp;&nbsp;   PAID &nbsp;&nbsp;
                                </span>
                            @else
                                <span
                                    class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                    &nbsp;&nbsp;  UNPAID &nbsp;&nbsp;
                                </span>
                            @endif
                        </td>





                        <td>

                            <form action="{{ route('admin.invoice.toggleStatus', $invoice->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('PATCH')

                                @if ($invoice->status == 1)
                                    <button type="submit" class="btn btn-danger btn-sm" title="Mark as Unpaid">
                                        <i class="ph ph-x"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm" title="Mark as Paid">
                                        <i class="ph ph-check"></i>
                                    </button>
                                @endif
                            </form>

                            <a href="{{ route('admin.invoice.view', $invoice->id) }}" title="View Invoice" class="btn btn-warning btn-sm"><i
                                    class="ph ph-eye"></i></a>
                            <!-- Delete Button -->
                            <button class="btn btn-dark btn-sm" title="Delete" onclick="confirmDelete({{ $invoice->id }})">
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
                    <th>IN / Date</th>
                    <th>Services</th>
                    <th>Customer Details</th>
                    <th>Values</th>
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
