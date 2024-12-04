@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .fc-event {
            color: #FFFFFF !important;
            /* White text color */
        }

        .fc-event {
            background-color: #3788d8 !important;
        }

        .fc-daygrid-dot-event .fc-event-title {
            font-weight: 400;
        }

        .fc .fc-col-header-cell-cushion {
            font-weight: 400;
        }

        .br-3 {
            border-radius: 3px !important;
        }

        .user-search .ts-control {
            padding: 13px 16px !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Calander')
    @include('backend.components.breadcrumb')

    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">

        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-plus"></i></span>
            <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">Create
                Appointment</button>
        </div>
    </div>
    <!-- Breadcrumb Right End -->
</div>


@include('backend.components.alert')


<!-- Recommended Start -->
<div class="card mt-24">
    <div class="card-body p-16">

        <div id='wrap'>
            <div id="calendar" style="width: 100%"></div>
            {{-- <div id='calendar' class="position-relative">
                <button type="button"
                    class="add-event btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="ph ph-plus me-4"></i>
                    Add Event
                </button>
            </div> --}}
            <div style='clear:both'></div>
        </div>
    </div>
</div>
<!-- Recommended End -->






<!-- Modal Add Event -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Appointment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('calander.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Client Name
                            </label>
                            <select id="user-search" class="user-search" name="customer"
                                placeholder="Search for a user..." style="width: 100%;"></select>
                        </div>


                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Service Name
                            </label>
                            <select name="service" class="form-control br-3 mb-10">
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="startDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start
                                Date</label>
                            <div class=" position-relative">
                                <input class="form-control br-3" name="start_date" id="start-date-picker"
                                    type="date">
                                <span
                                    class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-20">
                            <label for="startTime" class="form-label fw-semibold text-primary-light text-sm mb-8">Start
                                Time </label>
                            <div class=" position-relative">
                                <input class="form-control br-3 timepicker" name="start_time" type="time">
                                <span
                                    class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-20">
                            <label for="endTime" class="form-label fw-semibold text-primary-light text-sm mb-8">End
                                Time </label>
                            <div class=" position-relative">
                                <input class="form-control br-3 timepicker" name="end_time" type="time">
                                <span
                                    class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>


                        <div class="col-12 mb-20">
                            <label for="desc"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                            <textarea name="description" id="messageInput" class="form-control w-100" style="width: 100%" rows="10"></textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                            <button type="button" aria-label="Close" data-bs-dismiss="modal"
                                class="btn bg-danger-600 hover-bg-danger-800 border-danger-600 hover-border-danger-800 text-md px-24 py-12 radius-8">
                                Cancel
                            </button>
                            <button type="submit"
                                class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#start-date-picker", {
            dateFormat: "Y-m-d", // Format: YYYY-MM-DD
            minDate: "today", // Disable past dates
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.timepicker').timeDropper({
            format: 'HH:mm', // 24-hour format (use 'hh:mm' for 12-hour)
            autoswitch: true, // Automatically switch to the next input field
            setCurrentTime: true, // Set the current time as default
            meridians: false, // Hide AM/PM (set true for 12-hour format)
            primaryColor: "#3498db", // Customize the primary color
            borderColor: "#2980b9", // Customize the border color
        });
    });
</script>

<script src="https://cdn.tiny.cloud/1/mc59edcciy0vssoo3ojx1vwpo2jbsemez61eo60xxi6p5wse/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea#messageInput', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table'
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
            fetch(`/search-users-calander?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => callback(data))
                .catch(() => callback());
        },
        render: {
            option: function(item, escape) {
                return `
                  <div>
                      <strong>${escape(item.name)}</strong><br>
                      <small style="color: gray;">${escape(item.country)}</small><br>
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            events: function(info, successCallback, failureCallback) {
                fetch('/admin/calander/data')
                    .then(response => response.json())
                    .then(data => {
                        // Modify events with colors based on the status
                        const updatedEvents = data.map(event => {
                            if (event.status === 'pending') {
                                event.backgroundColor = '#FFA500'; // Orange background
                                event.borderColor = '#FFA500'; // Orange border
                                event.textColor = '#FFFFFF'; // White text
                            } else if (event.status === 'complete') {
                                event.backgroundColor = '#32CD32'; // Green background
                                event.borderColor = '#32CD32'; // Green border
                                event.textColor = '#FFFFFF'; // White text
                            }
                            return event;
                        });

                        successCallback(updatedEvents); // Pass updated events to FullCalendar
                    })
                    .catch(error => {
                        console.error('Error fetching events:', error);
                        failureCallback(error);
                    });
            },
            editable: true,
            selectable: true,
            firstDay: 1, // 1 (Monday)

            // Add eventClick to handle clicks on events
            eventClick: function(info) {
                const eventId = info.event.id; // Assuming each event has a unique ID
                if (eventId) {
                    // Redirect to the event page
                    window.location.href = `/admin/calander/events/${eventId}`;
                } else {
                    console.error('Event ID is missing!');
                }
            }
        });

        calendar.render();
    });
</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC', // Ensures consistent time handling
            initialView: 'dayGridMonth', // Default view is Month
            headerToolbar: {
                left: 'prev,next today', // Navigation buttons
                center: 'title', // Calendar title in the center
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth' // View options
            },
            weekNumbers: true, // Displays week numbers
            dayMaxEvents: true, // Limits maximum events per day and shows "+X more"
            events: function(info, successCallback, failureCallback) {
                // Fetch events from the server
                fetch('/admin/calander/data')
                    .then(response => response.json())
                    .then(data => {
                        console.log("Fetched Event Data:", data); // Log the response
                        data.forEach(event => {
                            event.color = '#34e009'; // Red text
                        });
                        successCallback(data); // Pass modified events to the calendar
                    })
                    .catch(error => {
                        console.error('Error fetching events:', error);
                    });
            },
            editable: true, // Allows event drag-and-drop editing
            selectable: true, // Allows selecting time slots
            firstDay: 1, // Start the week on Monday
        });
        calendar.render(); // Renders the calendar on the page
    });
</script> --}}



{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Default view
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay', // Add week and day views
            },
            events: {
                url: '/admin/calander/data', // Fetch events
                extraParams: {}, // Add extra parameters if needed
                failure: function () {
                    alert('Failed to fetch events!');
                },
                success: function (events) {
                    console.log(events); // Log events for debugging
                }
            },
            eventDataTransform: function (event) {
                // Map fields from the backend to FullCalendar's expected fields
                return {
                    id: event.id,
                    title: event.title,
                    start: event.start_date, // Map start_date to start
                    end: event.end_date,     // Map end_date to end
                    description: event.description,
                };
            },
            editable: true, // Enable drag-and-drop
            selectable: true, // Enable selection
            eventClick: function (info) {
                // Show event details in a SweetAlert
                Swal.fire({
                    title: info.event.title,
                    html: `
                        <strong>Start:</strong> ${info.event.start.toLocaleString()}<br>
                        <strong>End:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'N/A'}<br>
                        <strong>Description:</strong> ${info.event.extendedProps.description || 'No description'}
                    `,
                    icon: 'info',
                    confirmButtonText: 'Close',
                });
            },
        });

        calendar.render();
    });
</script> --}}


{{-- <script>
    $(document).ready(function() {
        var calendar = $("#calendar").fullCalendar({
            header: {
                left: "title",
                center: "agendaDay,agendaWeek,month",
                right: "prev,next today",
            },
            editable: true,
            firstDay: 1, // 1 (Monday)
            selectable: true,
            defaultView: "month",
            events: '/admin/calander/data', // Fetch events from the backend
            eventDataTransform: function (event) {
                console.log(event);
                // Map fields from the backend to FullCalendar's expected fields
                return {
                    id: event.id,
                    title: event.title,
                    start: event.start_date, // Map start_date to start
                    end: event.end_date,     // Map end_date to end
                    description: event.description,
                };
            },

            eventClick: function (info) {
    // Log the event object to see its structure
    console.log(info.event);

    Swal.fire({
        title: info.event.title,
        html: `
            <strong>Start:</strong> ${info.event.start.toLocaleString()}<br>
            <strong>End:</strong> ${info.event.end ? info.event.end.toLocaleString() : 'N/A'}<br>
            <strong>Description:</strong> ${info.event.extendedProps.description || 'No description provided'}<br>
        `,
        icon: 'info',
        confirmButtonText: 'Close'
    });
}
        });
    });
</script> --}}



{{-- <script>
    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        /* Initialize the calendar */
        var calendar = $("#calendar").fullCalendar({
            header: {
                left: "title",
                center: "agendaDay,agendaWeek,month",
                right: "prev,next today",
            },
            editable: true,
            firstDay: 1, // 1(Monday)
            selectable: true,
            defaultView: "month",
            events: '/admin/calander/data', // Fetch events from the backend

            // Handle event click to show tooltip
            eventClick: function(info) {
                const startDate = new Date(info.event.extendedProps.start_date).toLocaleString();
                const endDate = info.event.extendedProps.end_date ?
                    new Date(info.event.extendedProps.end_date).toLocaleString() :
                    "N/A";

                    console.log(endDate);
                // Use SweetAlert2 to show appointment details
                Swal.fire({
                    title: `${event.title}`,
                    html: `

                    <strong>Start:</strong> ${new Date(event.start_date).toLocaleString()}<br>
                    <strong>End:</strong> ${new Date(event.end_date).toLocaleString()}<br>
                    <strong>Description:</strong> ${event.description || 'No description provided'}<br>
                `,
                    icon: 'info',
                    confirmButtonText: 'Close'
                });
            },
        });
    });
</script> --}}
@endpush
