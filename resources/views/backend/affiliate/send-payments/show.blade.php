@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Affiliate Panel</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('send-payments.index') }}">Send Payments</a></li>
                            <li class="breadcrumb-item active">Send Payments</li>
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
                    <h3>Active Affiliates</h3>
                    <p style="color: red;">NOTE: This page allows you to verify the revenue of each affiliate and decide wheter to pay them or not. By marking the checkbox for each affiliate and clicking on "Pay all affiliates marked above" from bottom right of this page. you agree to send to each affiliate the listed amount of credit with no-wagering requirement. The affiliates ca the decide to request a withdrawal or to gamble the credit received</p>
                </div>
                <div class="card-body">
                    <div class="col-8">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $x = 1;
                                @endphp
                                <tr class="payment-show">
                                    <td>User Name:</td>
                                    <td>thetest</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Name/Email:</td>
                                    <td>test@test.com</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Status:</td>
                                    <td>Enable</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Duplicate account:</td>
                                    <td>Alert: Duplicate</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Register Date:</td>
                                    <td>2/15/19 18:00:14</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Last log in IP/Date:</td>
                                    <td>622.759.213.53 <br> 2/15/19 18:00:14</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Current Balance:</td>
                                    <td>1</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Affiliates No.:</td>
                                    <td>1/15</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Active affiliates:</td>
                                    <td>0.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Affiliates Revenue:</td>
                                    <td>1,000.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>All Payment Receive:</td>
                                    <td>500.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Last Month Revenue:</td>
                                    <td>00.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Last Payment dates:</td>
                                    <td>2/15/19 18:00:14</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Remaining amount:</td>
                                    <td>00.00$</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection