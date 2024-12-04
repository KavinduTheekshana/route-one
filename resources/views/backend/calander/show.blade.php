@push('styles')
    <style>
        figure {
            /* margin: 20px auto; */
            width: 100px;
            height: 100px;
            background-color: #ffffff;
            border-radius: 10px;
            border: #bbbbbb 1px solid;
            position: relative;

            &:before {
                content: '';
                display: block;
                width: 100px;
                height: 50px;
                border-radius: 10px 10px 0 0;
            }

            header {
                width: 100px;
                height: 25px;

                position: absolute;
                top: -1px;

                background-color: #fa565a;
                border-radius: 10px 10px 0 0;
                border-bottom: 3px solid #e5e5e5;

                font: 400 12px/20px Arial, Helvetica, Geneva, sans-serif;
                letter-spacing: 0.5px;
                color: #fff;

                text-align: center;
            }

            section {
                width: 100px;
                height: 50px;

                position: absolute;
                top: 34px;

                font: 400 46px/50px "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
                letter-spacing: -2px;
                color: #4c566b;

                text-align: center;

                z-index: 10;

                &:before {
                    content: '';
                    display: block;

                    position: absolute;
                    top: 50px;

                    width: 3px;
                    height: 10px;
                }

                &:after {
                    content: '';
                    display: block;

                    position: absolute;
                    top: 50px;
                    right: 0;

                    width: 3px;
                    height: 10px;

                }

            }
        }

        .fw-300 {
            font-weight: 300;
            margin: 0;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Calander')
    @include('backend.components.breadcrumb')

</div>


<div class="dashboard-body">

    <div class="row gy-4">
        <div class="col-xxl-8">
            <!-- Progress Bar Start -->
            <div class="card h-100">
                <div class="card-header border-bottom border-gray-100 flex-between flex-wrap gap-8">
                    <h5 class="mb-0">Appointment Details</h5>

                </div>
                <div class="card-body text-left">
                    <div class="row">
                        <div class="col-2">
                            <figure>
                                <header>
                                    {{ $startMonth }}
                                </header>
                                <section>
                                    {{ $eventDate }}
                                </section>
                            </figure>
                        </div>
                        <div class="col">
                            <h6 class="fw-300">{{ $event->service->service_name ?? 'Not Assigned' }}</h6>
                            <h3>{{ $eventDateTime }} - {{ $eventEndTime }}</h3>



                            <div class="flex-between flex-wrap gap-8 mb-16">
                                <div class="flex-align gap-16">
                                    <span class="w-30 h-30 rounded-8 flex-center text-xl bg-primary-600 text-white"><i
                                            class="ph ph-clock-user"></i></span>
                                    <h5 class="fw-300">{{ ucfirst($event->status) }}</h5>
                                </div>
                            </div>


                            <div class="flex-between flex-wrap gap-8 mb-16">
                                <div class="flex-align gap-16">
                                    <span class="w-30 h-30 rounded-8 flex-center text-xl bg-danger-600 text-white"><i
                                            class="ph ph-user"></i></span>
                                    <h5 class="fw-300"><a
                                            href="{{ route('user.settings', $event->user_id) }}">{{ $event->title }}</a>
                                    </h5>
                                </div>

                            </div>

                            <div class="flex-between flex-wrap gap-8 mb-16">
                                <div class="flex-align gap-16">
                                    <span class="w-30 h-30 rounded-8 flex-center text-xl bg-info-600 text-white"><i
                                            class="ph ph-envelope-open"></i></span>
                                    <h5 class="fw-300">{{ $user->email }}</h5>
                                </div>

                            </div>

                            <div class="flex-between flex-wrap gap-8 mb-16">
                                <div class="flex-align gap-16">
                                    <span class="w-30 h-30 rounded-8 flex-center text-xl bg-warning-600 text-white"><i
                                            class="ph ph-phone"></i></span>
                                    <h5 class="fw-300">{{ $user->country ?? 'Not Assigned' }}</h5>
                                </div>

                            </div>

                        </div>
                    </div>



                </div>
            </div>
            <!-- Progress bar end -->
        </div>

        <div class="col-xxl-4">
            <div class="card">
                <div class="card-body">
                    <div class="calendar">
                        <div class="calendar__header">
                            <button type="button" class="calendar__arrow left"><i
                                    class="ph ph-caret-left"></i></button>
                            <p class="display h6 mb-0">""</p>
                            <button type="button" class="calendar__arrow right"><i
                                    class="ph ph-caret-right"></i></button>
                        </div>

                        <div class="calendar__week week">
                            <div class="calendar__week-text">Su</div>
                            <div class="calendar__week-text">Mo</div>
                            <div class="calendar__week-text">Tu</div>
                            <div class="calendar__week-text">We</div>
                            <div class="calendar__week-text">Th</div>
                            <div class="calendar__week-text">Fr</div>
                            <div class="calendar__week-text">Sa</div>
                        </div>
                        <div class="days"></div>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <div class="mt-24">
        <div class="row gy-4">

            <div class="col-xxl-12">
                <!-- Top Course Start -->
                <div class="card h-100">
                    <div class="card-header border-bottom border-gray-100 flex-between flex-wrap gap-8">
                        <h5 class="mb-0">Appointment Description</h5>

                    </div>
                    <div class="card-body">

                       <p> {!! $event->description !!} </p>
                    </div>
                </div>
                <!-- Top Course End -->
            </div>



        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush
