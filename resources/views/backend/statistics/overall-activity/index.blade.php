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
                            <li class="breadcrumb-item active">Chart - Overall activity</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start end_date -->
                        <div class="form-group row">
                            <label for="end_date" class="col-md-3 col-form-label text-md-right">End date : </label>

                            <div class="col-md-8">
                                <input id="end_date" type="text" class="form-control datepicker {{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End end_date -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset filters</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Last week</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Last Month</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->



    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Monthly Casino NET Profit Chart</h3>
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


    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Monthly Bets/Wins Chart</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="apexcharts-mixedss"></div>
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
                        document.querySelector("#apexcharts-mixedss"),
                        options
                    );
                    chart.render();
                });
            </script>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Monthly Casino RTP Chart</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="apexcharts-mixeds"></div>
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
                        document.querySelector("#apexcharts-mixeds"),
                        options
                    );
                    chart.render();
                });
            </script>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Monthly Casino Average Bet Chart</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="apexcharts-mixedsss"></div>
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
                        document.querySelector("#apexcharts-mixedsss"),
                        options
                    );
                    chart.render();
                });
            </script>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Monthly Biggest Single Win Chart</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="apexcharts-mixedvs"></div>
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
                        document.querySelector("#apexcharts-mixedvs"),
                        options
                    );
                    chart.render();
                });
            </script>
        </div>
    </div>
@endsection