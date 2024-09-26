@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/calander.css') }}">
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
        @include('frontend.auth.dashboard.components.calander')
        <div class="col-xl-8">

            @include('backend.components.alert')
            <div class="card mb-4">
                <div class="card-header">Application Form</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.application.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if (isset($application) && $application->status)
                            <div class="alert alert-info" role="alert">
                                Your application was approved, you can't change your application.
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Full Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter your full name"
                                value="{{ $application->name ?? '' }}" required
                                {{ isset($application) && $application->status ? 'disabled' : '' }}>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputCountry">Country</label>
                                <input class="form-control" name="country" type="text"
                                    placeholder="Enter your country" value="{{ $application->country ?? '' }}"
                                    {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone Number</label>
                                <input class="form-control" name="phone" type="text"
                                    placeholder="Enter your phone number" value="{{ $application->phone ?? '' }}"
                                    {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" name="email" type="email"
                                placeholder="Enter your email address" value="{{ $application->email ?? '' }}" required
                                {{ isset($application) && $application->status ? 'disabled' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1">Address</label>
                            <input class="form-control" name="address" type="text" placeholder="Enter your address"
                                value="{{ $application->address ?? '' }}"
                                {{ isset($application) && $application->status ? 'disabled' : '' }}>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Date of Birth</label>
                                <input class="form-control" name="dob" type="date"
                                    value="{{ $application->dob ?? '' }}"
                                    {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1">Passport Number</label>
                                <input class="form-control" name="passport" type="text"
                                    placeholder="Enter your passport number" value="{{ $application->passport ?? '' }}"
                                    {{ isset($application) && $application->status ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1">Agent</label>
                            <select name="agent" class="form-control"
                                {{ isset($application) && $application->status ? 'disabled' : '' }}>
                                <option value="">-- Select Agent --</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ isset($application) && $application->agent == $agent->id ? 'selected' : '' }}>
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
<script src="{{ asset('frontend/js/calander.js') }}"></script>
@endpush
