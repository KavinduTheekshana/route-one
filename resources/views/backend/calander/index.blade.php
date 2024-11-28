@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Calander')
    @include('backend.components.breadcrumb')
</div>


@include('backend.components.alert')


<!-- Recommended Start -->
<div class="card mt-24 bg-transparent">
    <div class="card-body p-0">
        <div id='wrap'>
            {{-- <div id="calendar"></div> --}}
            <div id='calendar' class="position-relative">
                <button type="button"
                    class="add-event btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="ph ph-plus me-4"></i>
                    Add Event
                </button>
            </div>
            <div style='clear:both'></div>
        </div>
    </div>
</div>
<!-- Recommended End -->


<!-- Modal Add Event -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form action="#">
                    <div class="row">
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Event Title :
                            </label>
                            <input type="text" class="form-control radius-8" placeholder="Enter Event Title ">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label for="startDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start
                                Date</label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" id="startDate" type="date">
                                <span
                                    class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-20">
                            <label for="startTime" class="form-label fw-semibold text-primary-light text-sm mb-8">Start
                                Time </label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" id="startTime" type="time">
                                <span
                                    class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-20">
                            <label for="endTime" class="form-label fw-semibold text-primary-light text-sm mb-8">End
                                Time </label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" id="endTime" type="time">
                                <span
                                    class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col-12 mb-20">
                            <label for="endDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Color
                            </label>
                            <div class="d-flex align-items-center flex-wrap gap-28">
                                <div class="form-check form-radio d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="label" id="Personal">
                                    <label
                                        class="form-check-label min-width-max-content line-height-1 fw-medium text-primary text-sm d-flex align-items-center gap-1 ps-4"
                                        for="Personal">
                                        <span class="w-8-px h-8-px bg-success-600 rounded-circle"></span>
                                        Primary
                                    </label>
                                </div>
                                <div class="form-check form-radio d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="label" id="Business">
                                    <label
                                        class="form-check-label min-width-max-content line-height-1 fw-medium text-secondary text-sm d-flex align-items-center gap-1 ps-4"
                                        for="Business">
                                        <span class="w-8-px h-8-px bg-primary-600 rounded-circle"></span>
                                        Secondary
                                    </label>
                                </div>
                                <div class="form-check form-radio d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="label" id="Family">
                                    <label
                                        class="form-check-label min-width-max-content line-height-1 fw-medium text-success text-sm d-flex align-items-center gap-1 ps-4"
                                        for="Family">
                                        <span class="w-8-px h-8-px bg-warning-600 rounded-circle"></span>
                                        Success
                                    </label>
                                </div>
                                <div class="form-check form-radio d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="label" id="Important">
                                    <label
                                        class="form-check-label min-width-max-content line-height-1 fw-medium text-danger text-sm d-flex align-items-center gap-1 ps-4"
                                        for="Important">
                                        <span class="w-8-px h-8-px bg-lilac-600 rounded-circle"></span>
                                        Danger
                                    </label>
                                </div>
                                <div class="form-check form-radio d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="label" id="Holiday">
                                    <label
                                        class="form-check-label min-width-max-content line-height-1 fw-medium text-secondary-light text-sm d-flex align-items-center gap-1 ps-4"
                                        for="Holiday">
                                        <span class="w-8-px h-8-px bg-danger-600 rounded-circle"></span>
                                        Dark
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-20">
                            <label for="desc"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                            <textarea class="form-control" id="desc" rows="4" cols="50" placeholder="Write some text"></textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                            <button type="reset"
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
</div> --}}




@endsection

@push('scripts')


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


<script>
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
</script>



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
