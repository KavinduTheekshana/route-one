@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">
@endpush
@extends('layouts.backend')

@section('content')
    <div class="dashboard-body">

        <div class="row gy-4">
            <div class="col-lg-9">
                <!-- Widgets Start -->
                <div class="row gy-4">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="flex-between gap-8 mt-16">
                                    <div>
                                        <h4 class="mb-2">{{ $userCount }}+</h4>
                                        <span class="text-gray-600">Registerd Users</span>
                                    </div>

                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl"><i
                                            class="ph-fill ph-users-three"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="flex-between gap-8 mt-16">
                                    <div>
                                        <h4 class="mb-2">{{ $agentCount }}+</h4>
                                        <span class="text-gray-600">Registerd Agents</span>
                                    </div>

                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl"><i
                                            class="ph ph-user-gear"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="flex-between gap-8 mt-16">
                                    <div>
                                        <h4 class="mb-2">{{ $activeVacancies }}+</h4>
                                        <span class="text-gray-600">Active Vacancies</span>
                                    </div>

                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-purple-600 text-white text-2xl"><i
                                            class="ph ph-user-gear"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="flex-between gap-8 mt-16">
                                    <div>
                                        <h4 class="mb-2">{{ $approvedApplications }}+</h4>
                                        <span class="text-gray-600">Total Applications</span>
                                    </div>

                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i
                                            class="ph ph-user-gear"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Widgets End -->

                <!-- Top Course Start -->
                <div class="card mt-24">
                    <div class="card-body">
                        <div class="mb-20 flex-between flex-wrap gap-8">
                            <h4 class="mb-0">Registration Statistics</h4>
                            <div class="flex-align gap-16 flex-wrap">
                                <div class="flex-align flex-wrap gap-16">
                                    <div class="flex-align flex-wrap gap-8">
                                        <span class="w-8 h-8 rounded-circle bg-main-600"></span>
                                        <span class="text-13 text-gray-600">Study</span>
                                    </div>
                                    <div class="flex-align flex-wrap gap-8">
                                        <span class="w-8 h-8 rounded-circle bg-main-two-600"></span>
                                        <span class="text-13 text-gray-600">Test</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="doubleLineChart" class="tooltip-style y-value-left"></div>

                    </div>
                </div>


            </div>

            <div class="col-lg-3">
                <!-- Calendar Start -->
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
                <!-- Calendar End -->

            </div>

        </div>



        <div class="row gy-4">
            <div class="col-lg-6">


                <!-- Top Course Start -->
                <div class="card mt-24">
                    <div class="card-body">
                        <div class="mb-20 flex-between flex-wrap gap-8">
                            <h4 class="mb-0">Users Registered in the Last 7 Days</h4>

                        </div>
                        <table id="recentuser" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Join date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                                                alt="Profile Image" width="50px" class="rounded-circle round-profile"
                                                height="50px"></td>
                                        <td>{{ $user->name }}</td>

                                        <td>{{ $user->country ?? 'N/A' }}</td>

                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td>



                                            <a href="{{ route('user.settings', $user->id) }}"
                                                class="btn btn-warning btn-sm"><i class="ph ph-eye"></i></a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Join date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>


            </div>



        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.uikit.js"></script>
    <script>
        $(document).ready(function() {
            $('#recentuser').DataTable({
                // Sixth column
                autoWidth: true // Disable automatic column width calculation
            });
        });
    </script>
    <script>
        // =========================== Double Line Chart Start ===============================
        // function createLineChart(chartId, chartColor) {
        //     var options = {
        //         series: [{
        //                 name: 'Registrations',
        //                 data: [8, 15, 9, 20, 10, 33, 13, 22, 8, 17, 10, 15],
        //             },
        //             {
        //                 name: 'Test',
        //                 data: [8, 24, 18, 40, 18, 48, 22, 38, 18, 30, 20, 28],
        //             },
        //         ],
        //         chart: {
        //             type: 'area',
        //             width: '100%',
        //             height: 300,
        //             sparkline: {
        //                 enabled: false // Remove whitespace
        //             },
        //             toolbar: {
        //                 show: false
        //             },
        //             padding: {
        //                 left: 0,
        //                 right: 0,
        //                 top: 0,
        //                 bottom: 0
        //             }
        //         },
        //         colors: ['#3D7FF9', chartColor], // Set the color of the series
        //         dataLabels: {
        //             enabled: false,
        //         },
        //         stroke: {
        //             curve: 'smooth',
        //             width: 1,
        //             colors: ["#3D7FF9", chartColor],
        //             lineCap: 'round',
        //         },
        //         fill: {
        //             type: 'gradient',
        //             gradient: {
        //                 shadeIntensity: 1,
        //                 opacityFrom: 0.9, // Decrease this value to reduce opacity
        //                 opacityTo: 0.2, // Decrease this value to reduce opacity
        //                 stops: [0, 100]
        //             }
        //         },
        //         grid: {
        //             show: true,
        //             borderColor: '#E6E6E6',
        //             strokeDashArray: 3,
        //             position: 'back',
        //             xaxis: {
        //                 lines: {
        //                     show: false
        //                 }
        //             },
        //             yaxis: {
        //                 lines: {
        //                     show: true
        //                 }
        //             },
        //             row: {
        //                 colors: undefined,
        //                 opacity: 0.5
        //             },
        //             column: {
        //                 colors: undefined,
        //                 opacity: 0.5
        //             },
        //             padding: {
        //                 top: 0,
        //                 right: 0,
        //                 bottom: 0,
        //                 left: 0
        //             },
        //         },
        //         // Customize the circle marker color on hover
        //         markers: {
        //             colors: ["#3D7FF9", chartColor],
        //             strokeWidth: 3,
        //             size: 0,
        //             hover: {
        //                 size: 8
        //             }
        //         },
        //         xaxis: {
        //             labels: {
        //                 show: false
        //             },
        //             categories: [`Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`],
        //             tooltip: {
        //                 enabled: false,
        //             },
        //             labels: {
        //                 formatter: function(value) {
        //                     return value;
        //                 },
        //                 style: {
        //                     fontSize: "14px"
        //                 }
        //             },
        //         },
        //         yaxis: {
        //             labels: {
        //                 style: {
        //                     fontSize: "14px"
        //                 }
        //             },
        //         },
        //         tooltip: {
        //             x: {
        //                 format: 'dd/MM/yy HH:mm'
        //             },
        //         },
        //         legend: {
        //             show: false,
        //             position: 'top',
        //             horizontalAlign: 'right',
        //             offsetX: -10,
        //             offsetY: -0
        //         }
        //     };

        //     var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
        //     chart.render();
        // }

        async function createLineChart(chartId, chartColor) {
            // Fetch the monthly data from the server
            const response = await fetch('/admin/monthly-data');
            const data = await response.json();

            // Define chart options with dynamic data from the backend
            var options = {
                series: [{
                        name: 'Registrations',
                        data: data.registrations, // Data for registered users
                    },
                    {
                        name: 'Applications',
                        data: data.applications, // Data for applications
                    },
                ],
                chart: {
                    type: 'area',
                    width: '100%',
                    height: 300,
                    sparkline: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                colors: ['#3D7FF9', chartColor],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 1,
                    colors: ["#3D7FF9", chartColor],
                    lineCap: 'round'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.9,
                        opacityTo: 0.2,
                        stops: [0, 100]
                    }
                },
                grid: {
                    show: true,
                    borderColor: '#E6E6E6',
                    strokeDashArray: 3,
                    position: 'back',
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                },
                markers: {
                    colors: ["#3D7FF9", chartColor],
                    strokeWidth: 3,
                    size: 0,
                    hover: {
                        size: 8
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    labels: {
                        style: {
                            fontSize: "14px"
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: "14px"
                        }
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    }
                },
                legend: {
                    show: false,
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetX: -10,
                    offsetY: -0
                }
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }



        createLineChart('doubleLineChart', '#27CFA7');
        // =========================== Double Line Chart End ===============================
    </script>
@endpush
