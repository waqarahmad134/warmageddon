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
                            <li class="breadcrumb-item active">Settings</li>
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
                    <h4>Settings </h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start lotto_game -->
                        <div class="form-group row">
                            <label for="lotto_game" class="col-md-3 col-form-label text-md-right">Lotto game : </label>
                            <div class="col-md-8">
                                <select id="lotto_game" type="text" class="form-control {{ $errors->has('lotto_game') ? ' is-invalid' : '' }}" name="lotto_game" required>
                                    <option>Raffle - Hourly</option>
                                    <option>Raffle - minite</option>
                                </select>
                                @if ($errors->has('lotto_game'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lotto_game') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End lotto_game -->

                        <!-- Start payout_percentage -->
                        <div class="form-group row">
                            <label for="payout_percentage" class="col-md-3 col-form-label text-md-right">Payout Percentage : </label>

                            <div class="col-md-8">
                                <input id="payout_percentage" type="text" class="form-control {{ $errors->has('payout_percentage') ? ' is-invalid' : '' }}" name="payout_percentage" value="{{ old('payout_percentage') }}" required>
                                @if ($errors->has('payout_percentage'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payout_percentage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End payout_percentage -->

                        <!-- Start ticket_price -->
                        <div class="form-group row">
                            <label for="ticket_price" class="col-md-3 col-form-label text-md-right">Ticket Price : </label>

                            <div class="col-md-8">
                                <input id="ticket_price" type="text" class="form-control {{ $errors->has('ticket_price') ? ' is-invalid' : '' }}" name="ticket_price" value="{{ old('ticket_price') }}" required>
                                @if ($errors->has('ticket_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ticket_price -->

                        <!-- Start draw_time_interval -->
                        <div class="form-group row">
                            <label for="draw_time_interval" class="col-md-3 col-form-label text-md-right">Draw/pick time interval : </label>
                            <div class="col-md-8">
                                <select id="draw_time_interval" type="text" class="form-control {{ $errors->has('draw_time_interval') ? ' is-invalid' : '' }}" name="draw_time_interval" required>
                                    <option>every 1hour at HH:59:59</option>
                                    <option>every day midnight at 23:59:59</option>
                                    <option>every sunday midnight at 23:59:59</option>
                                    <option>Raffle - Hourly</option>
                                    <option>Raffle - Daily</option>
                                    <option>Raffle - Sunday</option>
                                    <option>Pick3 - Hourly</option>
                                    <option>Pick3 - Daily</option>
                                    <option>Pick3 - Sunday</option>
                                    <option>Pick4 - Hourly</option>
                                    <option>Pick4 - Daily</option>
                                    <option>Pick4 - Sunday</option>
                                </select>
                                @if ($errors->has('draw_time_interval'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('draw_time_interval') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End draw_time_interval -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection