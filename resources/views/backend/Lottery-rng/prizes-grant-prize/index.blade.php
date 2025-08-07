@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Lottery Rng</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Lottery Rng</a></li>
                            <li class="breadcrumb-item active">Prizes Grant Prize</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Instuctions : </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9 offset-md-3">
                            <p class="input-tips">1. Choose date interval</p>
                            <p class="input-tips">2. Click on "Pick lucky active player" button or enter the player username.</p>
                            <p class="input-tips">3. Enter the prize amount.</p>
                            <p class="input-tips">4. Choose the prize type.</p>
                            <p class="input-tips">5. Click on "Award prize".</p>
                            <p class="input-tips">*Pick active player = an active player is a player that placed at least 1 bet during the selected date interval</p>
                            <p>*Pick any player = choose any player that is registered at the casino. Date interval does not count</p>
                            <p style="color: red;">***Calculate total bet x 1% = this will return the total bet of all gameplays during the date interval, multiplied by * 1%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Award prize </h4>
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
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">This week</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Last week</button>
                            </div>
                        </div>

                        <!-- Start player_username -->
                        <div class="form-group row">
                            <label for="player_username" class="col-md-3 col-form-label text-md-right">Player Username : </label>
                            <div class="col-md-8">
                                <select id="player_username" type="text" class="form-control {{ $errors->has('player_username') ? ' is-invalid' : '' }}" name="player_username" required>
                                    <option>First Player</option>
                                    <option>Second Player</option>
                                </select>
                                @if ($errors->has('player_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_username -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="button" class="btn btn-secondary float-left mr-3">**Pick any player</button>
                            </div>
                        </div>

                        <!-- Start prize_amount -->
                        <div class="form-group row">
                            <label for="prize_amount" class="col-md-3 col-form-label text-md-right">Prize Amount(currency:$ )</label>

                            <div class="col-md-8">
                                <input id="prize_amount" type="text" class="form-control {{ $errors->has('prize_amount') ? ' is-invalid' : '' }}" name="prize_amount" value="{{ old('prize_amount') }}" required>
                                <p class="input-tips">***Calculate total bet x 1%</p>
                                @if ($errors->has('prize_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prize_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End prize_amount -->

                        <!-- Start prize_type -->
                        <div class="form-group row">
                            <label for="prize_type" class="col-md-3 col-form-label text-md-right">Prize type : </label>
                            <div class="col-md-8">
                                <select id="prize_type" type="text" class="form-control {{ $errors->has('prize_type') ? ' is-invalid' : '' }}" name="prize_type" required>
                                    <option>Grand Jackpot</option>
                                    <option>Low Jackpot</option>
                                </select>
                                @if ($errors->has('prize_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prize_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End prize_type -->

                        <!-- Start message -->
                        <div class="form-group row">
                            <label for="message" class="col-md-3 col-form-label text-md-right">Message : </label>

                            <div class="col-md-8">
                                <input id="message" type="text" class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" value="{{ old('message') }}" required>
                                <p class="input-tips">(max 30 characters)</p>
                                @if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End message -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-warning float-left mr-3">Award prize</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">List all prizes awarded</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection