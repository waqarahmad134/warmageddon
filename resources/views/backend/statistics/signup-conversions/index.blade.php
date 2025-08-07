@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('style')
    <style>
        .t-heigh {
            min-height: 277px;
        }
    </style>
@endsection
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
                            <li class="breadcrumb-item active">Chart - Signup Conversion</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <div class="row">
        <div class="col-3 col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    <p>Age of new users</p>
                </div>
                <div class="card-body">
                    <div class="t-heigh">
                        <table class="table table-striped">
                            <thead>
                            <th>Age</th>
                            <th>Signup</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>18-24</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>25-34</td>
                                <td>437</td>
                            </tr>
                            <tr>
                                <td>35-44</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>45-54</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>55-100</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie"></canvas>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    // Pie chart
                    new Chart(document.getElementById("chartjs-pie"), {
                        type: 'pie',
                        data: {
                            labels: ["Social", "Search Engines", "Direct", "Other"],
                            datasets: [{
                                data: [260, 125, 54, 146],
                                backgroundColor: ["#2979ff", "#ff9100", "#00c853", "#E8EAED"],
                                borderColor: "transparent"
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    });
                });
            </script>
        </div>

        <div class="col-3 col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    <p>Deposit Conversion</p>
                </div>
                <div class="card-body">
                    <div class="t-heigh">
                        <table class="table table-striped">
                            <thead>
                            <th>#of deposits</th>
                            <th>Signup</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No deposits</td>
                                <td>442</td>
                            </tr>
                            <tr>
                                <td>One or more</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie2"></canvas>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    // Pie chart
                    new Chart(document.getElementById("chartjs-pie2"), {
                        type: 'pie',
                        data: {
                            labels: ["Social", "Search Engines", "Direct", "Other"],
                            datasets: [{
                                data: [260, 125, 54, 146],
                                backgroundColor: ["#2979ff", "#ff9100", "#00c853", "#E8EAED"],
                                borderColor: "transparent"
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    });
                });
            </script>
        </div>

        <div class="col-3 col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    <p>Gameplay Conversion</p>
                </div>
                <div class="card-body">
                    <div class="t-heigh">
                        <table class="table table-striped">
                            <thead>
                            <th>#of gameplays</th>
                            <th>Signup</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No gameplays</td>
                                <td>442</td>
                            </tr>
                            <tr>
                                <td>One or more</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie3"></canvas>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    // Pie chart
                    new Chart(document.getElementById("chartjs-pie3"), {
                        type: 'pie',
                        data: {
                            labels: ["Social", "Search Engines", "Direct", "Other"],
                            datasets: [{
                                data: [260, 125, 54, 146],
                                backgroundColor: ["#2979ff", "#ff9100", "#00c853", "#E8EAED"],
                                borderColor: "transparent"
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    });
                });
            </script>
        </div>

        <div class="col-3 col-lg-3">
            <div class="card">
                <div class="card-header text-center">
                    <p>Time of the day</p>
                </div>
                <div class="card-body">
                    <div class="t-heigh">
                        <table class="table table-striped">
                            <thead>
                            <th>Time</th>
                            <th>Signup</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>00-06 AM</td>
                                <td>118</td>
                            </tr>
                            <tr>
                                <td>06-12 AM</td>
                                <td>87</td>
                            </tr>
                            <tr>
                                <td>00-06 AM</td>
                                <td>118</td>
                            </tr>
                            <tr>
                                <td>06-12 AM</td>
                                <td>87</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie4"></canvas>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    // Pie chart
                    new Chart(document.getElementById("chartjs-pie4"), {
                        type: 'pie',
                        data: {
                            labels: ["Social", "Search Engines", "Direct", "Other"],
                            datasets: [{
                                data: [260, 125, 54, 146],
                                backgroundColor: ["#2979ff", "#ff9100", "#00c853", "#E8EAED"],
                                borderColor: "transparent"
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection