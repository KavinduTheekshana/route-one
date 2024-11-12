@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/invoice.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


    <style>
        .invoice-icon {
            font-size: 18px;
            margin-right: 8px;
        }

        .service-description {
            line-height: 1;
            font-size: 11px;
            max-width: 80%;
            color: gray;
        }

        .cs-invoice.cs-style1 .cs-invoice_head.cs-type1 {
            align-items: center !important;
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
        <div id="content-to-print" style="width: 210mm; height: 297mm;">
            <div class="cs-invoice cs-style1">

                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                <div class="cs-invoice_in" id="download_section">
                    <div class="cs-invoice_head cs-type1 cs-mb25">
                        <div class="cs-invoice_left">
                            <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b
                                    class="cs-primary_color">Invoice
                                    No:</b> #{{ $invoice->invoice_number }}
                            </p>
                            <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date:
                                </b>{{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') }}

                            </p>
                        </div>
                        <div class="cs-invoice_right cs-text_right">
                            <div class="cs-logo cs-mb5"><img src="{{ asset('backend/images/logo/routeone_logo.png') }}"
                                    style="width: 300px;" alt="Logo"></div>
                        </div>
                    </div>
                    <div class="cs-invoice_head cs-mb10">
                        <div class="cs-invoice_left w-100">
                            <b class="cs-primary_color">Invoice To:</b>
                            <p class="cs-invoice_date cs-primary_color cs-m0" style="max-width: 280px">
                                {{ $invoice->customer->name }} <br>
                                {{ $invoice->customer->address }}
                            </p>

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

                                            <th class="cs-width_6 cs-semi_bold cs-primary_color cs-focus_bg">
                                                Description
                                            </th>
                                            <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Qty
                                            </th>
                                            <th
                                                class="cs-width_2 price-display cs-semi_bold cs-primary_color cs-focus_bg">
                                                Price</th>
                                            <th
                                                class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($invoice->services as $service)
                                            <tr>
                                                <td class="cs-width_6"> {{ $service->service_name }} <br> <span
                                                        class="service-description">{{ $service->description }}</span>
                                                </td>
                                                <td class="cs-width_1">{{ $service->qty }}</td>
                                                <td class="cs-width_2">£{{ $service->price }}</td>
                                                <td class="cs-width_2 text-end">£{{ $service->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

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
                                                    <p>£{{ $invoice->subtotal }}</p>
                                                </td>
                                            </tr>
                                            <tr class="cs-border_left">
                                                <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Tax
                                                    ({{ $invoice->tax_rate }}%)
                                                </td>
                                                <td
                                                    class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                    £{{ $invoice->tax }}
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
                                                £{{ $invoice->total_fee }}
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
                                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" />
                            </svg>
                        </div>
                        <div class="cs-note_right w-100">
                            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                            <p class="cs-m0"> {{ $invoice->note ?? 'N/A' }}</p>

                        </div>
                    </div><!-- .cs-note -->
                </div>





            </div>
        </div>
    </div>

    <div class="cs-container col-md-3" style="margin: 0; z-index: 0; max-width: 100%;">
        <div class="card overflow-hidden p-16 text-center">
            <button id="download-pdf" type="button"
                class="btn btn-main justify-content-center text-sm btn-sm text-center w-100 py-12 d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="ph ph-download invoice-icon"></i>
                <span>Download Invoice</span>
            </button>


            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas"
                class="mt-18 btn btn-outline-main justify-content-center text-sm btn-sm text-center w-100 py-12 d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="ph ph-paper-plane-tilt invoice-icon"></i>
                <span>Email Invoice</span>
            </button>


        </div>

        <div id="response-message" class="alert alert-success alert-dismissible mt-12" style="display: none;" role="alert">


            <p class="mb-0" id="response-message-text">

            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


        {{-- <div class="cs-invoice_btns cs-hide_print">
            <button id="download-pdf"
                class="cs-invoice_btn cs-color1">
                <i class="ph ph-paper-plane-tilt invoice-icon"></i>
                <span>Download PDF</span>
            </button>

            <button id="send-email" class="cs-invoice_btn cs-color2">
                <i class="ph ph-paper-plane-tilt invoice-icon"></i>
                <span>Email</span>
            </button>
        </div> --}}
    </div>



    <!-- Offcanvas -->
    <!-- Send Invoice Sidebar -->
    <div style="width: 500px" class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
        <div class="offcanvas-header mb-3">
            <h5 class="offcanvas-title">Send Invoice</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form>


                <div class="form-floating form-floating-outline mb-12">
                    <input type="text" class="form-control" value="info@routeonerecruitment.com"
                        placeholder="info@routeonerecruitment.com" readonly />
                    <label>From</label>
                </div>


                <div class="form-floating form-floating-outline mb-12">
                    <input type="text" class="form-control" id="invoice-to"
                        value="{{ $invoice->customer->email }}" />
                    <label>To</label>
                </div>

                <div class="form-floating form-floating-outline mb-12">
                    <input type="text" class="form-control" id="email-subject"
                        value="Invoice from Routeone Recruitment" placeholder="Invoice regarding goods" />
                    <label for="invoice-subject">Subject</label>
                </div>




                <div class="form-floating form-floating-outline mb-4">
                    <textarea class="form-control" id="invoice-message" style="height: 190px">Please find the attached PDF invoice.</textarea>
                    <label>Message</label>
                </div>
                <div class="mb-12">
                    <span
                        class="text-13 py-2 px-8 bg-green-50 text-green-600 d-inline-flex align-items-center gap-8 rounded-pill">
                        <i class="ph ph-paperclip"></i> Invoice Attached
                    </span>
                    {{-- <span class="badge bg-label-primary rounded-pill">
                            <i class="mdi mdi-link-variant mdi-14px me-1"></i>
                            <span class="align-middle"></span>
                        </span> --}}
                </div>
                <div class="mb-3 d-flex flex-wrap">
                    <button id="send-email" type="button" class="btn btn-primary me-3"
                        data-bs-dismiss="offcanvas">Email Invoice</button>
                    <button type="button"
                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600  py-9"
                        data-bs-dismiss="offcanvas">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Send Invoice Sidebar -->


    <!-- /Offcanvas -->



</div>








@endsection

@push('scripts')
<script>
    // ---------- Download Invoice ----------
    document.getElementById('download-pdf').addEventListener('click', function() {
        // Options for html2canvas. Increasing scale can improve quality.
        const canvasOptions = {
            scale: 3, // Adjust scale factor as needed for quality vs. performance
            useCORS: true // This is important if you have images that are hosted on other domains
        };

        // Convert the div to canvas using html2canvas with the specified options
        html2canvas(document.getElementById('content-to-print'), canvasOptions).then(canvas => {
            // Create a new jsPDF instance
            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            // Convert the canvas to an image using PNG format for lossless compression
            const imgData = canvas.toDataURL('image/jpeg', 0.85);


            // Calculate the number of pages
            const imgWidth = 210; // A4 width in mm
            const imgHeight = canvas.height * imgWidth / canvas.width;
            const pageHeight = 297; // A4 height in mm
            let heightLeft = imgHeight;

            // Add the image to the PDF, possibly across multiple pages if it's long
            let position = 0;
            while (heightLeft >= 0) {
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            const now = new Date();
            const dateStr = now.toISOString().replace(/:/g, '-').replace(/\..+/, '').replace('T', '_');
            const fileName = `Invoice_${dateStr}.pdf`;
            // Save the PDF
            pdf.save(fileName);
        });

    });




    // -------------- Mail Invoice ---------------
    // -------------- Mail Invoice ---------------
    document.getElementById('send-email').addEventListener('click', function() {
        const canvasOptions = {
            scale: 3, // Adjust scale factor as needed for quality vs. performance
            useCORS: true // This is important if you have images that are hosted on other domains
        };
        html2canvas(document.getElementById('content-to-print'), canvasOptions).then(canvas => {
            const pdf = new window.jspdf.jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });
            const imgData = canvas.toDataURL('image/jpeg', 0.85);
            const imgWidth = 210; // A4 width in mm
            const pageHeight = 297; // A4 height in mm
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;

            pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;

                pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Convert the PDF to a base64 string
            const pdfBase64String = pdf.output('datauristring');
            const base64Data = pdfBase64String.split(';base64,')[1];

            const emailSubject = document.getElementById('email-subject').value;
            const emailReciever = document.getElementById('invoice-to').value;
            const emailMessage = document.getElementById('invoice-message').value;



            fetch('/sendpdf', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        pdf: base64Data,
                        subject: emailSubject,
                        receiver: emailReciever,
                        message: emailMessage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    displayMessag(data.message);
                })
                .catch((error) => {
                    displayMessag('Error: ' + error.message);
                });
        });
    });

    function displayMessag(message) {
        const messageDiv = document.getElementById('response-message');
        messageDiv.style.display = 'block';
        var messageParagraph = document.getElementById('response-message-text');
        messageParagraph.textContent = message;
    }
</script>
@endpush
