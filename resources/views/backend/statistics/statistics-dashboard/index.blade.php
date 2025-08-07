@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Statistics</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Statistics</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5>GEOGRAPHY</h5>
                            </div>
                            <div class="card-body">
                                <div id="world_map" style="height:350px;"></div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function(event) {
                                    $('#world_map').vectorMap({
                                        map: "world_mill",
                                        normalizeFunction: "polynomial",
                                        hoverOpacity: .7,
                                        hoverColor: false,
                                        regionStyle: {
                                            initial: {
                                                fill: "#e3eaef"
                                            }
                                        },
                                        markerStyle: {
                                            initial: {
                                                "r": 9,
                                                "fill": "#2979ff",
                                                "fill-opacity": .9,
                                                "stroke": "#fff",
                                                "stroke-width": 7,
                                                "stroke-opacity": .4
                                            },
                                            hover: {
                                                "stroke": "#fff",
                                                "fill-opacity": 1,
                                                "stroke-width": 1.5
                                            }
                                        },
                                        backgroundColor: "transparent",
                                        markers: [{
                                            latLng: [31.230391, 121.473701],
                                            name: "Shanghai"
                                        },
                                            {
                                                latLng: [39.904202, 116.407394],
                                                name: "Beijing"
                                            },
                                            {
                                                latLng: [28.704060, 77.102493],
                                                name: "Delhi"
                                            },
                                            {
                                                latLng: [6.524379, 3.379206],
                                                name: "Lagos"
                                            },
                                            {
                                                latLng: [39.343357, 117.361649],
                                                name: "Tianjin"
                                            },
                                            {
                                                latLng: [24.860735, 67.001137],
                                                name: "Karachi"
                                            },
                                            {
                                                latLng: [41.008240, 28.978359],
                                                name: "Istanbul"
                                            },
                                            {
                                                latLng: [35.689487, 139.691711],
                                                name: "Tokyo"
                                            },
                                            {
                                                latLng: [23.129110, 113.264381],
                                                name: "Guangzhou"
                                            },
                                            {
                                                latLng: [19.075983, 72.877655],
                                                name: "Mumbai"
                                            },
                                            {
                                                latLng: [40.7127837, -74.0059413],
                                                name: "New York"
                                            },
                                            {
                                                latLng: [34.052235, -118.243683],
                                                name: "Los Angeles"
                                            },
                                            {
                                                latLng: [41.878113, -87.629799],
                                                name: "Chicago"
                                            },
                                            {
                                                latLng: [29.760427, -95.369804],
                                                name: "Houston"
                                            },
                                            {
                                                latLng: [33.448376, -112.074036],
                                                name: "Phoenix"
                                            },
                                            {
                                                latLng: [51.507351, -0.127758],
                                                name: "London"
                                            },
                                            {
                                                latLng: [48.856613, 2.352222],
                                                name: "Paris"
                                            },
                                            {
                                                latLng: [55.755825, 37.617298],
                                                name: "Moscow"
                                            },
                                            {
                                                latLng: [40.416775, -3.703790],
                                                name: "Madrid"
                                            }
                                        ]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Monthly Deposits/Withdrawals Chart</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="apexcharts-mixed"></div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    // Mixed chart
                    var options = {
                        chart: {
                            height: 350,
                            type: 'line',
                            stacked: false,
                        },
                        stroke: {
                            width: [0, 2, 5],
                            curve: 'smooth'
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%'
                            }
                        },
                        series: [{
                            name: 'TEAM A',
                            type: 'column',
                            data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
                        }, {
                            name: 'TEAM B',
                            type: 'area',
                            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
                        }, {
                            name: 'TEAM C',
                            type: 'line',
                            data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
                        }],
                        fill: {
                            opacity: [0.85, 0.25, 1],
                            gradient: {
                                inverseColors: false,
                                shade: 'light',
                                type: "vertical",
                                opacityFrom: 0.85,
                                opacityTo: 0.55,
                                stops: [0, 100, 100, 100]
                            }
                        },
                        labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003', '08/01/2003', '09/01/2003',
                            '10/01/2003', '11/01/2003'
                        ],
                        markers: {
                            size: 0
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        yaxis: {
                            title: {
                                text: 'Points',
                            },
                            min: 0
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            y: {
                                formatter: function(y) {
                                    if (typeof y !== "undefined") {
                                        return y.toFixed(0) + " points";
                                    }
                                    return y;
                                }
                            }
                        }
                    }
                    var chart = new ApexCharts(
                        document.querySelector("#apexcharts-mixed"),
                        options
                    );
                    chart.render();
                });
            </script>
        </div>
    </div>
@endsection