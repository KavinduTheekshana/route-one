@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/invoice.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    @if (Auth::user()->user_type === 'superadmin')
        <style>
            .service-row:hover .total {
                display: none !important;
                /* Hide the total amount on hover */
            }
        </style>
    @endif

    <style>
        .input-custom {
            border-radius: 2px;
            font-size: 13px;
            padding: 8px;
            border-bottom-color: rgb(208, 208, 208);
            border-left-color: rgb(208, 208, 208);
            border-right-color: rgb(208, 208, 208);
            border-top-color: rgb(208, 208, 208);
        }

        .input-custom div {
            text-align: left !important;
        }

        .ts-dropdown {
            position: relative;
        }

        .service-row {
            transition: background-color 0.3s ease;
            /* Smooth transition for background color */
        }

        .service-row:hover {
            background-color: #f0f0f0;
            /* Highlight the row on hover */
        }


        /* .service-row:hover .total {
                display: none !important;
            } */

        .service-row:hover .edit-icon,
        .service-row:hover .delete-icon {
            display: inline !important;
            /* Show icons on hover */
        }

        .icon {
            margin-right: 10px;
            /* Space between icons */
            cursor: pointer;
            /* Change cursor to pointer for better UX */
            /* color: #333; */
            font-size: 24px;
            /* Default icon color */
            transition: color 0.3s ease;
            /* Smooth transition for color change */
        }

        /* Change color of icons on hover */
        .edit-icon:hover,
        .delete-icon:hover {
            color: #007bff;
            /* Change to blue (or any color you prefer) */
        }

        div[contenteditable="plaintext-only"] {
            text-align: left;
            /* Align text to the left */
            padding: 0;
            /* Remove any padding */
            margin: 0;
            /* Remove any margin */
            box-shadow: none;
            /* Remove any shadow */
        }

        .invoice-icon {
            font-size: 18px;
            margin-right: 8px;
        }

        .save-btn {
            border-radius: 5px !important;
            width: 250px !important;
            justify-content: center !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Invoice')
    @include('backend.components.breadcrumb')
</div>


@include('backend.components.alert')


<div class="row">
    <div class="cs-container col-md-8" style="margin: 0; z-index: 0; max-width: 100%;">
        <div class="cs-invoice cs-style1">
            <form action="{{ route('admin.invoice.store') }}" method="POST">
                @csrf
                <div class="cs-invoice_in" id="download_section">
                    <div class="cs-invoice_head cs-type1 cs-mb25">
                        <div class="cs-invoice_left">
                            <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b
                                    class="cs-primary_color">Invoice
                                    No:</b>
                                <input type="text" name="invoice_number" required readonly
                                    value="{{ $formattedInvoiceNumber }}"
                                    class="text-counter placeholder-13 form-control py-11 pe-76 input-custom">
                            </p>
                            <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date:
                                </b>
                                <input type="date" name="date" value="{{ $currentDate }}"
                                    class="text-counter placeholder-13 form-control py-11 pe-76 input-custom">
                                {{-- <span id="current-date">05.01.2022</span> --}}
                            </p>
                        </div>
                        <div class="cs-invoice_right cs-text_right">
                            <div class="cs-logo cs-mb5"><img src="{{ asset('backend/images/logo/routeone_logo.svg') }}"
                                    style="width: 300px;" alt="Logo"></div>
                        </div>
                    </div>
                    <div class="cs-invoice_head cs-mb10">
                        <div class="cs-invoice_left w-100">
                            <b class="cs-primary_color">Invoice To:</b>
                            <select id="user-search" name="customer_id" placeholder="Search for a user..."
                                style="width: 100%;"></select>

                        </div>
                        <div class="cs-invoice_right cs-text_right">
                            <b class="cs-primary_color">Pay To:</b>
                            <p>
                                Route One Recruitment Services Ltd, <br>
                                24 Colston Rise, Ampthill, <br>
                                Bedford, MK45 2GN <br> United Kingdom
                            </p>
                        </div>
                    </div>
                    <div class="cs-table cs-style1">
                        <div class="cs-round_border">
                            <div class="cs-table_responsive">
                                <table id="servicesTable">
                                    <thead>
                                        <tr>

                                            <th class="cs-width_6 cs-semi_bold cs-primary_color cs-focus_bg">Description
                                            </th>
                                            <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">Qty</th>
                                            <th
                                                class="cs-width_1 price-display cs-semi_bold cs-primary_color cs-focus_bg">
                                                Price</th>
                                            <th
                                                class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tr>
                                        <td colspan="4">
                                            <select id="serviceSelect" style="width: 100%;">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        data-icon="ph ph-apple-podcasts-logo"
                                                        data-description="{{ $service->description }}"
                                                        data-service_name="{{ $service->service_name }}"
                                                        data-price="{{ $service->price }}">
                                                        {{ $service->service_name }}

                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="cs-invoice_footer cs-border_top">
                                <div class="cs-left_footer cs-mobile_hide">
                                    <p class="cs-mb0"><b class="cs-primary_color">Additional Information:</b></p>
                                    <p class="cs-m0">
                                    <ul>
                                        <li>Email: info@routeonerecruitment.com</li>
                                        <li>Phone: 020 31378313</li>
                                    </ul>
                                    </p>
                                </div>
                                <div class="cs-right_footer">
                                    <table>
                                        <tbody>
                                            <tr class="cs-border_left">
                                                <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg"
                                                    style="padding-top: 13px; padding-bottom: 13px;">Subtoal</td>
                                                <td
                                                    class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                    <input id="subtotal" name="subtotal" readonly
                                                        class="text-counter placeholder-13 form-control py-11 pe-76 input-custom"
                                                        type="text" value="0.00">
                                                </td>
                                            </tr>
                                            <tr class="cs-border_left">
                                                <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Tax
                                                    <select class="tax-percentage-dropdown" name="tax_rate">
                                                        <option value="0">0%</option>
                                                        <option value="5">5%</option>
                                                        <option value="10">10%</option>
                                                        <option value="15">15%</option>
                                                        <option value="20">20%</option>
                                                    </select>
                                                </td>
                                                <td
                                                    class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                    <input id="tax" name="tax" readonly
                                                        class="text-counter placeholder-13 form-control py-11 pe-76 input-custom"
                                                        type="text" value="0.00">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                        <div class="cs-invoice_footer">
                            <div class="cs-left_footer cs-mobile_hide" style="color: #777777 !important">
                                <p class="cs-mb0"><b>Bank Details:</b> (International)</p>
                                <p class="cs-m0">ROUTE ONE RECRUITMENT SERVICES LTD</p>
                                <p class="cs-m0">IBAN: GB68CLRB04060524161040</p>
                                <p class="cs-m0">SWIFT code: CLRBGB22</p>

                                <p class="cs-mb0 mt-30"><b>Bank Details:</b> (United Kingdom)</p>
                                <p class="cs-m0">ROUTE ONE RECRUITMENT SERVICES LTD</p>
                                <p class="cs-m0">Sort Code: 04-06-05</p>
                                <p class="cs-m0">Account Number: 24161040</p>
                            </div>
                            <div class="cs-right_footer">
                                <table>
                                    <tbody>
                                        <tr class="cs-border_none">
                                            <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">
                                                Total
                                                Amount
                                            </td>
                                            <td
                                                class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                                <input id="total" name="total_fee" readonly
                                                    class="text-counter placeholder-13 form-control py-11 pe-76 input-custom"
                                                    type="text" value="0.00">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cs-note">
                        <div class="cs-note_left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path
                                    d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                                    fill="none" stroke="currentColor" stroke-linejoin="round"
                                    stroke-width="32" />
                                <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg>
                        </div>
                        <div class="cs-note_right w-100">
                            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                            <textarea name="note" id="note" class="w-100" rows="2"></textarea>

                        </div>
                    </div><!-- .cs-note -->
                </div>

                <div class="cs-invoice_btns cs-hide_print">
                    {{-- <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                        <i class="ph ph-paper-plane-tilt invoice-icon"></i>
                        <span>Save & Email</span>
                    </a> --}}



                    <button type="submit" id="download_btn" class="cs-invoice_btn save-btn cs-color2">
                        <i class="ph ph-floppy-disk invoice-icon"></i>
                        <span>Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>





</div>



<!-- Modal -->
<!-- Modal -->
<div id="editModal"
    style="display: none; position: fixed; z-index: 1000; background-color: rgba(0,0,0,0.5); width: 100%; height: 100%; top: 0; left: 0; justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 8px; width: 500px;">
        <h3>Edit Service</h3>
        <label for="serviceName">Service Name:</label>
        <input class="text-counter placeholder-13 form-control py-11 pe-11 input-custom mb-10" type="text"
            id="serviceName">

        <label for="quantity">Quantity:</label>
        <input class="text-counter placeholder-13 form-control py-11 pe-11 input-custom mb-10" type="number"
            value="1" id="quantity">

        <label for="price">Price:</label>
        <input class="text-counter placeholder-13 form-control py-11 pe-11 input-custom mb-10" type="number"
            id="price">

        <label for="description">Description:</label>
        <textarea name="note" id="description" class="w-100 form-control py-11 pe-11 mb-10" rows="6"></textarea>


        <button id="closeButton" type="button" class="btn btn-dark">Close</button>
        <button id="saveButton" type="button" class="btn btn-success">Update</button>
    </div>
</div>




@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const serviceSelect = new TomSelect("#serviceSelect", {
            placeholder: "Select a service...",
            render: {
                option: function(data, escape) {
                    return `<div style="display: flex; align-items: flex-start; flex-direction: column; font-size: 1.1em;">
                            <div style="display: flex; align-items: center;">
                                <i class="${escape(data.icon)}" style="margin-right: 8px; font-size: 1.5em;"></i>
                                <span style="font-weight: bold;">${escape(data.service_name)}</span>
                            </div>
                            <div style="font-size: 0.9em; color: #666; padding-left: 28px;">
                                ${escape(data.description)}
                            </div>
                        </div>`;
                }
            }
        });

        let currentRow; // Variable to keep track of the row being edited
        let subtotal = 0; // Initialize subtotal

        function calculateTotal(price, quantity) {
            return (price * quantity).toFixed(2); // Calculate total and format to 2 decimal places
        }

        function updateSubtotal() {
            document.getElementById('subtotal').value = `${subtotal.toFixed(2)}`;
            updateTaxAndTotal(); // Update tax and total after subtotal changes
        }

        function updateTaxAndTotal() {
            const taxPercentage = parseFloat(document.querySelector('.tax-percentage-dropdown').value);
            const tax = (subtotal * taxPercentage / 100).toFixed(2); // Calculate tax
            const total = (subtotal + parseFloat(tax)).toFixed(2); // Calculate total

            document.getElementById('tax').value = `${tax}`;
            document.getElementById('total').value = `${total}`;
        }

        // Add event listener to the tax percentage dropdown
        document.querySelector('.tax-percentage-dropdown').addEventListener('change', function() {
            updateTaxAndTotal(); // Recalculate total and tax when the dropdown value changes
        });

        serviceSelect.on('change', function(value) {
            const selectedOption = this.options[value];
            const serviceName = selectedOption.service_name;
            const description = selectedOption.description.trim().replace(/\s+/g, ' ');
            const quantity = 1; // Default quantity
            const price = parseFloat(selectedOption.price);

            // Create a new row in the table
            const newRow = document.createElement('tr');
            newRow.className = "service-row";
            newRow.innerHTML = `
            <td class="cs-width_6">
                <input readonly name="service_name[]" class="text-counter form-control py-11 mb-1 input-custom"
                       type="text" value="${serviceName}">
                <textarea readonly name="description[]" id="note" class="w-100" style="font-size: 0.8em; line-height: 1.5; color: #666; padding: 8px;">${description}</textarea>
            </td>
            <td class="cs-width_2 quantity"><input readonly name="quantity[]" class="text-counter form-control py-11 mb-1 input-custom"
                       type="text" value="${quantity}"></td>
            <td class="cs-width_2 price-display price"><input readonly name="price[]" class="text-counter form-control py-11 mb-1 input-custom"
                       type="text" value="${price.toFixed(2)}"></td>
            <td class="cs-width_2 cs-text_right actions">

                @auth
                @if (Auth::user()->user_type === 'superadmin')
                <span class="icon edit-icon d-none" title="Edit">
                    <i class="ph ph-pencil"></i>
                </span>
                <span class="icon delete-icon d-none" title="Delete">
                    <i class="ph ph-trash"></i>
                </span>
                    @endif
                    @endauth

                <span class="total"><input readonly name="total[]" class="text-counter form-control py-11 mb-1 input-custom"
                           type="text" value="${calculateTotal(price, quantity)}"></span>
            </td>
        `;

            document.querySelector('#servicesTable tbody').appendChild(newRow);

            // Event listener for delete icon
            newRow.querySelector('.delete-icon').addEventListener('click', function() {
                const rowPrice = parseFloat(newRow.querySelector('.price input').value);
                const rowQuantity = parseInt(newRow.querySelector('.quantity input').value);
                subtotal -= rowPrice * rowQuantity; // Subtract row total from subtotal
                newRow.remove();
                updateSubtotal();
            });

            // Event listener for edit icon
            newRow.querySelector('.edit-icon').addEventListener('click', function() {
                const serviceName = newRow.querySelector('input[name="service_name[]"]').value
                    .trim();
                const description = newRow.querySelector('textarea[name="description[]"]').value
                    .trim();
                const quantity = newRow.querySelector('.quantity input').value.trim();
                const price = newRow.querySelector('.price-display input').value.trim();

                document.getElementById('serviceName').value = serviceName;
                document.getElementById('quantity').value = quantity;
                document.getElementById('price').value = price;
                document.getElementById('description').value = description;

                document.getElementById('editModal').style.display = 'flex';
                currentRow = newRow;
            });

            subtotal += price * quantity; // Add new service price to subtotal
            updateSubtotal();
            serviceSelect.clear();
        });

        // Save button functionality
        document.getElementById('saveButton').addEventListener('click', function() {
            if (currentRow) {
                const newServiceName = document.getElementById('serviceName').value;
                const newQuantity = parseInt(document.getElementById('quantity').value);
                const newPrice = parseFloat(document.getElementById('price').value);
                const newDescription = document.getElementById('description').value;

                const oldQuantity = parseInt(currentRow.querySelector('.quantity input').value);
                const oldPrice = parseFloat(currentRow.querySelector('.price-display input').value);

                // Update row details
                currentRow.querySelector('.cs-width_6').innerHTML =
                    `
                <input readonly name="service_name[]" class="text-counter form-control py-11 mb-1 input-custom"
                       type="text" value="${newServiceName}">
                <textarea readonly name="description[]" id="note" class="w-100" style="font-size: 0.8em; line-height: 1.5; color: #666; padding: 8px;">${newDescription}</textarea>`;

                currentRow.querySelector('.cs-width_2.quantity').innerHTML = `
                <input readonly name="quantity[]" class="text-counter form-control py-11 mb-1 input-custom"
                       type="text" value="${newQuantity}">`;

                currentRow.querySelector('.cs-width_2.price-display.price').innerHTML = `
                <input readonly name="price[]" class="text-counter form-control py-11 mb-1 input-custom"
                       type="text" value="${newPrice.toFixed(2)}">`;

                const newTotal = calculateTotal(newPrice, newQuantity);
                currentRow.querySelector('.total input').value = `${newTotal}`;

                // Update subtotal based on the old and new values
                subtotal = subtotal - (oldPrice * oldQuantity) + (newPrice * newQuantity);
                updateSubtotal();

                document.getElementById('editModal').style.display = 'none';
            }
        });

        // Close button functionality
        document.getElementById('closeButton').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'none';
        });
    });
</script>



<script>
    new TomSelect('#user-search', {
        valueField: 'user_id',
        labelField: 'name',
        searchField: 'name',
        placeholder: 'Search for a user...',
        load: function(query, callback) {
            if (!query.length) return callback();

            // Fetch user data with AJAX
            fetch(`/search-users-invoice?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => callback(data))
                .catch(() => callback());
        },
        render: {
            option: function(item, escape) {
                return `
                  <div>
                      <strong>${escape(item.name)}</strong><br>
                      <small style="color: gray;">${escape(item.address)}</small><br>
                      <small style="color: gray;">${escape(item.email)}</small>
                  </div>
              `;
            },
            item: function(item, escape) {
                // Show both name and email in the selected item
                return `<div>${escape(item.name)}<br><small style="color: gray;">${escape(item.email)}</small></div>`;
            }
        },
        onChange: function(value) {
            console.log(value); // Log the selected value
            const selectedItem = this.options[value];
            console.log(selectedItem); // Log the selected item to inspect its properties

            if (selectedItem) {
                document.getElementById('user-email-input').value = selectedItem.email;
            }
        }

    });
</script>
@endpush
