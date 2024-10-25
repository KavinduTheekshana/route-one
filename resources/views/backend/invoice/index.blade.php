@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/invoice.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>



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
            <div class="cs-invoice_in" id="download_section">
                <div class="cs-invoice_head cs-type1 cs-mb25">
                    <div class="cs-invoice_left">
                        <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">Invoice
                                No:</b>
                            <input type="text" name="invoice_number" required readonly
                                class="text-counter placeholder-13 form-control py-11 pe-76 input-custom">
                        </p>
                        <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date:
                            </b>
                            <input type="date" name="date" required
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
                        <select id="user-search" placeholder="Search for a user..." style="width: 100%;"></select>

                    </div>
                    <div class="cs-invoice_right cs-text_right">
                        <b class="cs-primary_color">Pay To:</b>
                        <p>
                            Route One Recruitment, <br>
                            24 Colston Rise, Ampthill, <br>
                            Bedford, MK45 2GN <br> United Kingdom
                        </p>
                    </div>
                </div>
                <div class="cs-table cs-style1">
                    <div class="cs-round_border">
                        <div class="cs-table_responsive">
                            <table>
                                <thead>
                                    <tr>

                                        <th class="cs-width_4 cs-semi_bold cs-primary_color cs-focus_bg">Description
                                        </th>
                                        <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">Qty</th>
                                        <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Price</th>
                                        <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td class="cs-width_4">Mobile & Ios Application Development</td>
                                        <td class="cs-width_2">2</td>
                                        <td class="cs-width_1">$460</td>
                                        <td class="cs-width_2 cs-text_right">$920</td>
                                    </tr>
                                    <tr>

                                        <td class="cs-width_4">Mobile & Ios Mobile App Design, Product Design</td>
                                        <td class="cs-width_2">1</td>
                                        <td class="cs-width_1">$220</td>
                                        <td class="cs-width_2 cs-text_right">$220</td>
                                    </tr>
                                    <tr>

                                        <td class="cs-width_4">Web Design & Development</td>
                                        <td class="cs-width_2">2</td>
                                        <td class="cs-width_1">$120</td>
                                        <td class="cs-width_2 cs-text_right">#240</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cs-invoice_footer cs-border_top">
                            <div class="cs-left_footer cs-mobile_hide">
                                <p class="cs-mb0"><b class="cs-primary_color">Additional Information:</b></p>
                                <p class="cs-m0">At check in you may need to present the credit <br>card used for
                                    payment
                                    of this ticket.</p>
                            </div>
                            <div class="cs-right_footer">
                                <table>
                                    <tbody>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg"
                                                style="padding-top: 13px; padding-bottom: 13px;">Subtoal</td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                $1140</td>
                                        </tr>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Tax</td>
                                            <td
                                                class="cs-width_3 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                -$20</td>
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
                                        <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">Total
                                            Amount
                                        </td>
                                        <td
                                            class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                            $1160</td>
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
                    <div class="cs-note_right">
                        <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
                        <p class="cs-m0">Here we can write a additional notes for the client to get a better
                            understanding
                            of this invoice.</p>
                    </div>
                </div><!-- .cs-note -->
            </div>
            <div class="cs-invoice_btns cs-hide_print">
                <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path
                            d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                            stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <circle cx="392" cy="184" r="24" />
                    </svg>
                    <span>Print</span>
                </a>
                <button id="download_btn" class="cs-invoice_btn cs-color2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <title>Download</title>
                        <path
                            d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" />
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="32" d="M176 272l80 80 80-80M256 48v288" />
                    </svg>
                    <span>Download</span>
                </button>
            </div>
        </div>
    </div>



    {{-- <div class="cs-container col-4" style="margin: 0; z-index: 0;">
        <div class="cs-style1">
            <div class="card">
                <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                    <h5 class="mb-0">Invoice Details</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="form-content pt-4">
                        @csrf
                        <div class="row gy-20">

                            <div class="col-xxl-12 col-md-12 col-sm-12">
                                <div class="row g-20">
                                    <div class="col-12">
                                        <label for="courseTitle" class="h6 mb-8 fw-semibold font-heading">Date
                                        </label>
                                        <div class="position-relative">
                                            <input type="date" name="date" required
                                                class="text-counter placeholder-13 form-control py-11 pe-76 input-custom">

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="courseTitle" class="h6 mb-8 fw-semibold font-heading">Applicant
                                            Details </label>
                                        <div class="position-relative">
                                            <input type="text" name="name" required class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Applicant Name & Address">
                                            <select id="user-search" placeholder="Search for a user..."
                                                style="width: 100%;"></select>
                                        </div>
                                    </div>












                                </div>
                            </div>
                            <div class="flex-align justify-content-end gap-8">
                                <button type="button" class="btn btn-outline-main rounded-pill py-9"
                                    id="cancelBtn">Cancel</button>
                                <button type="submit" class="btn btn-main rounded-pill py-9">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div> --}}

</div>





@endsection

@push('scripts')
<script>
  new TomSelect('#user-search', {
      valueField: 'id',
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
                      <small style="color: gray;">${escape(item.address)}</small>
                  </div>
              `;
          },
          item: function(item, escape) {
              // Show both name and address in the selected item
              return `<div>${escape(item.name)}<br><small style="color: gray;">${escape(item.address)}</small></div>`;
          }
      }
  });
  </script>
@endpush
