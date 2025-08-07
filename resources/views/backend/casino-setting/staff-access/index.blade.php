@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Casino Settings</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Casino Settings</a></li>
                            <li class="breadcrumb-item active">Staff Access Levels</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Staff Access Levels</h3>
                    <p style="color: red;">Permission</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>User Name</th>
                                <th>Name/Email</th>
                                <th>Status</th>
                                <th>Duplicate account</th>
                                <th>Register Date</th>
                                <th class="hide">Last log in IP/Date</th>
                                <th class="hide">Current Balance</th>
                                <th class="hide">Affiliates No.</th>
                                <th class="hide">Active affiliates</th>
                                <th class="hide">Affiliates Revenue</th>
                                <th class="hide">All Payment Receive</th>
                                <th class="hide">Last Month Revenue</th>
                                <th class="hide">Last Payment dates</th>
                                <th>Remaining amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>10{{$x}}</td>
                                    <td>thetest</td>
                                    <td>test@test.com</td>
                                    <td style="color: green;">Enable</td>
                                    <td style="color: red;">Alert: Duplicate</td>
                                    <td>2/15/19 18:00:14</td>
                                    <td class="hide">622.759.213.53 <br> 2/15/19 18:00:14</td>
                                    <td class="hide">1</td>
                                    <td class="hide">1/15</td>
                                    <td class="hide" style="color: green;">0.00$</td>
                                    <td class="hide" style="color: green;">1,000.00$</td>
                                    <td class="hide" style="color: green;">500.00$</td>
                                    <td class="hide" style="color: green;">00.00$</td>
                                    <td class="hide" style="color: red;">2/15/19 18:00:14</td>
                                    <td style="color: red;">00.00$</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection