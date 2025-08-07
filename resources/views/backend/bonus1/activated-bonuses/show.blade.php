@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Bonuses And Codes</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses And Codes</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('activated-bonuses.index') }}">Activated Bonuses</a></li>
                            <li class="breadcrumb-item active">Show</li>
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
                                    <td>Type:</td>
                                    <td>reg_bonus</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Bonus Mode:</td>
                                    <td>Instant</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>User:</td>
                                    <td>cas_vggllgahwbzzb</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Deposit Value:</td>
                                    <td>0.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Bonus Value:</td>
                                    <td>100.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Rollover:</td>
                                    <td>X 10</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Amount needed to wager to withdraw:</td>
                                    <td>1,000.00 $</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Total player bet:</td>
                                    <td>0.00 $</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Completed(%):</td>
                                    <td>0.00 $</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Date Triggered:</td>
                                    <td>2019-03-03 15:52:21</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Date Unlocked/Cleared:</td>
                                    <td>2019-03-03 15:52:21</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Last Month Revenue:</td>
                                    <td>0000-00-00 00:00:00</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Status:</td>
                                    <td>Active</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Confirmation Status:</td>
                                    <td>Pending</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>End Reason</td>
                                    <td>N/A</td>
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