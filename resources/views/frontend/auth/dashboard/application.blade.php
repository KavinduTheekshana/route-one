@push('styles')
    <style>
        .calendar-container {
            background: #fff;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .calendar-container header {
            display: flex;
            align-items: center;
            padding: 25px 30px 10px;
            justify-content: space-between;
        }

        header .calendar-navigation {
            display: flex;
        }

        header .calendar-navigation span {
            height: 38px;
            width: 38px;
            margin: 0 1px;
            cursor: pointer;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
            user-select: none;
            color: #aeabab;
            font-size: 1.9rem;
        }

        .calendar-navigation span:last-child {
            margin-right: -10px;
        }

        header .calendar-navigation span:hover {
            background: #f2f2f2;
        }

        header .calendar-current-date {
            font-weight: 500;
            font-size: 1.45rem;
        }

        .calendar-body {
            padding: 20px;
        }

        .calendar-body ul {
            list-style: none;
            flex-wrap: wrap;
            display: flex;
            text-align: center;
        }

        .calendar-body .calendar-dates {
            margin-bottom: 20px;
        }

        .calendar-body li {
            width: calc(100% / 7);
            font-size: 1.07rem;
            color: #414141;
        }

        .calendar-body .calendar-weekdays li {
            cursor: default;
            font-weight: 500;
        }

        .calendar-body .calendar-dates li {
            margin-top: 30px;
            position: relative;
            z-index: 1;
            cursor: pointer;
        }

        .calendar-dates li.inactive {
            color: #aaa;
        }

        .calendar-dates li.active {
            color: #fff;
        }

        .calendar-dates li::before {
            position: absolute;
            content: "";
            z-index: -1;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .calendar-dates li.active::before {
            background: #6332c5;
        }

        .calendar-dates li:not(.active):hover::before {
            background: #e4e1e1;
        }
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
@endpush

@extends('layouts.frontend')
@section('content')
@section('page_name', 'My Account')
@include('frontend.components.hero')
<div class="container-xl px-4 mt-4">

    @include('frontend.auth.dashboard.components.nav')
    <div class="row">
        <div class="col-xl-4">

            <div class="card mb-4 mb-xl-0">
                <div class="calendar-container">
                    <header class="calendar-header">
                        <p class="calendar-current-date"></p>
                        <div class="calendar-navigation">
                            <span id="calendar-prev" class="material-symbols-rounded">
                                chevron_left
                            </span>
                            <span id="calendar-next" class="material-symbols-rounded">
                                chevron_right
                            </span>
                        </div>
                    </header>

                    <div class="calendar-body">
                        <ul class="calendar-weekdays">
                            <li>Sun</li>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                        </ul>
                        <ul class="calendar-dates"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">

            @include('backend.components.alert')
            <div class="card mb-4">
                <div class="card-header">Application Form</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.application.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if(isset($application) && $application->status)
                            <div class="alert alert-info" role="alert">
                                Your application was approved, you can't change your application.
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Full Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter your full name"
                                value="{{ $application->name ?? '' }}" required {{ isset($application) && $application->status ? 'disabled' : '' }}>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputCountry">Country</label>
                                <input class="form-control" name="country" type="text" placeholder="Enter your country"
                                    value="{{ $application->country ?? '' }}" {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control" name="phone" type="text" placeholder="Enter your phone number"
                                    value="{{ $application->phone ?? '' }}" {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" name="email" type="email" placeholder="Enter your email address"
                                value="{{ $application->email ?? '' }}" required {{ isset($application) && $application->status ? 'disabled' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1">Address</label>
                            <input class="form-control" name="address" type="text" placeholder="Enter your address"
                                value="{{ $application->address ?? '' }}" {{ isset($application) && $application->status ? 'disabled' : '' }}>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Date of Birth</label>
                                <input class="form-control" name="dob" type="date"
                                    value="{{ $application->dob ?? '' }}" {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Passport Number</label>
                                <input class="form-control" name="passport" type="text" placeholder="Enter your passport number"
                                    value="{{ $application->passport ?? '' }}" {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1">Agent</label>
                            <select name="agent" class="form-control" {{ isset($application) && $application->status ? 'disabled' : '' }}>
                                <option value="">-- Select Agent --</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ (isset($application) && $application->agent == $agent->id) ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary" type="submit"
                                {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            Save Application
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="space30"></div>


@endsection

@push('scripts')
<script>
    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth();

    const day = document.querySelector(".calendar-dates");

    const currdate = document
        .querySelector(".calendar-current-date");

    const prenexIcons = document
        .querySelectorAll(".calendar-navigation span");

    // Array of month names
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    // Function to generate the calendar
    const manipulate = () => {

        // Get the first day of the month
        let dayone = new Date(year, month, 1).getDay();

        // Get the last date of the month
        let lastdate = new Date(year, month + 1, 0).getDate();

        // Get the day of the last date of the month
        let dayend = new Date(year, month, lastdate).getDay();

        // Get the last date of the previous month
        let monthlastdate = new Date(year, month, 0).getDate();

        // Variable to store the generated calendar HTML
        let lit = "";

        // Loop to add the last dates of the previous month
        for (let i = dayone; i > 0; i--) {
            lit +=
                `<li class="inactive">${monthlastdate - i + 1}</li>`;
        }

        // Loop to add the dates of the current month
        for (let i = 1; i <= lastdate; i++) {

            // Check if the current date is today
            let isToday = i === date.getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear() ?
                "active" :
                "";
            lit += `<li class="${isToday}">${i}</li>`;
        }

        // Loop to add the first dates of the next month
        for (let i = dayend; i < 6; i++) {
            lit += `<li class="inactive">${i - dayend + 1}</li>`
        }

        // Update the text of the current date element
        // with the formatted current month and year
        currdate.innerText = `${months[month]} ${year}`;

        // update the HTML of the dates element
        // with the generated calendar
        day.innerHTML = lit;
    }

    manipulate();

    // Attach a click event listener to each icon
    prenexIcons.forEach(icon => {

        // When an icon is clicked
        icon.addEventListener("click", () => {

            // Check if the icon is "calendar-prev"
            // or "calendar-next"
            month = icon.id === "calendar-prev" ? month - 1 : month + 1;

            // Check if the month is out of range
            if (month < 0 || month > 11) {

                // Set the date to the first day of the
                // month with the new year
                date = new Date(year, month, new Date().getDate());

                // Set the year to the new year
                year = date.getFullYear();

                // Set the month to the new month
                month = date.getMonth();
            } else {

                // Set the date to the current date
                date = new Date();
            }

            // Call the manipulate function to
            // update the calendar display
            manipulate();
        });
    });
</script>
@endpush
