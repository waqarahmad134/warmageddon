@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Slot Tournaments</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Slot Tournaments</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('list-tournaments.index') }}">List Tournaments</a></li>
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
                    <h3>Tournaments</h3>
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
                                    <td>Name:</td>
                                    <td>
                                        The Golden Charms Tournament
                                        <br>
                                        The Golden Charms Mobile and PC
                                    </td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Entry fee:</td>
                                    <td>1.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Initial play credit:</td>
                                    <td>50000 CREDIT</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Starting prize:</td>
                                    <td>25.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Current prize pool</td>
                                    <td>1.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Prize % contribution:</td>
                                    <td>10.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Announce Date:</td>
                                    <td>2019-02-01 00:00:00</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Start Date:</td>
                                    <td>2019-02-01 00:00:00</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>End Date:</td>
                                    <td>2019-02-01 00:00:00</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Total players registered :</td>
                                    <td>
                                        1 Player(s) Registered
                                        <br>
                                        REQUIRED TO START: 1
                                    </td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Top 10 prizes and players:</td>
                                    <td>
                                        <a href="#">Click here to view podium</a>
                                    </td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Status:</td>
                                    <td>Active</td>
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