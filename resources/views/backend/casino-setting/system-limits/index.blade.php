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
                            <li class="breadcrumb-item active">System Limit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>System Limit</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start daily_limits -->
                        <div class="form-group row">
                            <label for="daily_limits" class="col-md-4 col-form-label text-md-right">Responsible Gaming Reallity check Text : </label>

                            <div class="col-md-4">
                                <input id="daily_limits_deposit" type="text" class="form-control {{ $errors->has('daily_limits_deposit') ? ' is-invalid' : '' }}" name="daily_limits_deposit" value="{{ old('daily_limits_deposit') }}" required>
                                <p class="input-tips">Max Daily Deposit</p>
                                @if ($errors->has('daily_limits_deposit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('daily_limits_deposit') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="daily_limits_withdraw" type="text" class="form-control {{ $errors->has('daily_limits_withdraw') ? ' is-invalid' : '' }}" name="daily_limits_withdraw" value="{{ old('daily_limits_withdraw') }}" required>
                                <p class="input-tips">Max Daily Withdrawal</p>
                                @if ($errors->has('daily_limits_withdraw'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('daily_limits_withdraw') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End daily_limits -->

                        <!-- Start daily_limits -->
                        <div class="form-group row">
                            <label for="daily_limits" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-4">
                                <input id="wager_limit" type="text" class="form-control {{ $errors->has('wager_limit') ? ' is-invalid' : '' }}" name="wager_limit" value="{{ old('wager_limit') }}" required>
                                <p class="input-tips">Wager Limit</p>
                                @if ($errors->has('wager_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wager_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="loss_limit" type="text" class="form-control {{ $errors->has('loss_limit') ? ' is-invalid' : '' }}" name="loss_limit" value="{{ old('loss_limit') }}" required>
                                <p class="input-tips">Loss Limit</p>
                                @if ($errors->has('loss_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('loss_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End daily_limits -->

                        <!-- Start daily_limits -->
                        <div class="form-group row">
                            <label for="daily_limits" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-4">
                                <input id="session_limit" type="text" class="form-control {{ $errors->has('session_limit') ? ' is-invalid' : '' }}" name="session_limit" value="{{ old('session_limit') }}" required>
                                <p class="input-tips">Session Limit</p>
                                @if ($errors->has('session_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('session_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End daily_limits -->


                        <!-- Start daily_limits -->
                        <div class="form-group row">
                            <label for="transaction_limit" class="col-md-4 col-form-label text-md-right">Per transaction Deposit limits : </label>

                            <div class="col-md-4">
                                <input id="transaction_limit" type="text" class="form-control {{ $errors->has('transaction_limit') ? ' is-invalid' : '' }}" name="transaction_limit" value="{{ old('transaction_limit') }}" required>
                                <p class="input-tips">Min Deposit</p>
                                @if ($errors->has('transaction_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="daily_limits_withdraw" type="text" class="form-control {{ $errors->has('daily_limits_withdraw') ? ' is-invalid' : '' }}" name="daily_limits_withdraw" value="{{ old('daily_limits_withdraw') }}" required>
                                <p class="input-tips">Max Deposit</p>
                                @if ($errors->has('daily_limits_withdraw'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('daily_limits_withdraw') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End daily_limits -->

                        <!-- Start daily_limits -->
                        <div class="form-group row">
                            <label for="transaction_limit" class="col-md-4 col-form-label text-md-right">Per transaction Withdrawal limits : </label>

                            <div class="col-md-4">
                                <input id="transaction_limit" type="text" class="form-control {{ $errors->has('transaction_limit') ? ' is-invalid' : '' }}" name="transaction_limit" value="{{ old('transaction_limit') }}" required>
                                <p class="input-tips">Min withdrawal</p>
                                @if ($errors->has('transaction_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="daily_limits_withdraw" type="text" class="form-control {{ $errors->has('daily_limits_withdraw') ? ' is-invalid' : '' }}" name="daily_limits_withdraw" value="{{ old('daily_limits_withdraw') }}" required>
                                <p class="input-tips">Max withdrawal</p>
                                @if ($errors->has('daily_limits_withdraw'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('daily_limits_withdraw') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End daily_limits -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-4">
                                <button type="submit" class="btn btn-primary float-left mr-3">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection