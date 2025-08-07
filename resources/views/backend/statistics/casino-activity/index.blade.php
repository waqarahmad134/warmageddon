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
                            <li class="breadcrumb-item active">Casino Activity</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start start_date -->
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start date : </label>

                            <div class="col-md-8">
                                <input id="start_date" type="text" class="form-control datepicker {{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End start_date -->

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
                                <button type="submit" class="btn btn-primary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">YTD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Transaction Statistics</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <button type="button" class="btn btn-secondary mr-3 btn-block mb-3 mt-3">Casino Activity</button>
                        <div class="col-md-6">
                            Total Gameplays: 103
                            <br>
                            Total Games Won: 54
                        </div>
                        <div class="col-md-6">
                            Total Games Lost: 49
                        </div>
                    </div>

                    <div class="row">
                        <button type="button" class="btn btn-secondary mr-3 btn-block mb-3 mt-3">Bet & Wins Data</button>
                        <div class="col-md-6">
                            Total Bet: 169,455.00$
                            <br>
                            Total Net Profit: -584,538,20$
                        </div>
                        <div class="col-md-6">
                            Total Win: 2169,455.00$
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-secondary mr-3 btn-block mb-3 mt-3">Deposits & Withdrawals</button>
                        <div class="col-md-6">
                            Total Deposits: 72
                            <br>
                            Total Deposits Amount : 24,069.20$
                            <br>
                            Total Bonus Amount Given : 24,069.20$
                            <br>
                            Total Reward Coupons Amount Used : 0.00$
                            <br>
                            Total Taxes From User To User Transfers : 0.00$
                        </div>
                        <div class="col-md-6">
                            Total Withdrawals: 8
                            <br>
                            Total Withdrawal Amount 24,733.00$
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-secondary mr-3 btn-block mb-3 mt-3">Mobile vs Desktop</button>
                        <div class="col-md-6">
                            Total mobile logins: 10
                            <br>
                            Total gameplays from mobile: 26
                            <br>
                            Total bets from mobile: 6,046.00$
                        </div>
                        <div class="col-md-6">
                            Total desktop logins: 13506
                            <br>
                            Total gameplays from mobile: 77
                            <br>
                            Total bets from desktop: 163,409.00$
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-secondary mr-3 btn-block mb-3 mt-3">User Account Balances (not affected by date filter)</button>
                        <div class="col-md-6">
                            Total mobile logins: 10
                            <br>
                            Total gameplays from mobile: 26
                            <br>
                            Total bets from mobile: 6,046.00$
                        </div>
                        <div class="col-md-6">
                            Total desktop logins: 13506
                            <br>
                            Total gameplays from mobile: 77
                            <br>
                            Total bets from desktop: 163,409.00$
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection