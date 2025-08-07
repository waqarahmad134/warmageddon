@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Sports Book</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sports Book</a></li>
                            <li class="breadcrumb-item active">Re-evaluate tickets</li>
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
                    <h4>Sportsbook</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start min_bet_ticket -->
                        <div class="form-group row">
                            <label for="min_bet_ticket" class="col-md-4 col-form-label text-md-right">Sportsbook Min Bet per ticket : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="min_bet_ticket" type="text" class="form-control {{ $errors->has('min_bet_ticket') ? ' is-invalid' : '' }}" name="min_bet_ticket" value="{{ old('min_bet_ticket') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                @if ($errors->has('min_bet_ticket'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_bet_ticket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End min_bet_ticket -->

                        <!-- Start max_bet_ticket -->
                        <div class="form-group row">
                            <label for="max_bet_ticket" class="col-md-4 col-form-label text-md-right">Sportsbook Max Bet per ticket : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="max_bet_ticket" type="text" class="form-control {{ $errors->has('max_bet_ticket') ? ' is-invalid' : '' }}" name="max_bet_ticket" value="{{ old('max_bet_ticket') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                @if ($errors->has('max_bet_ticket'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_bet_ticket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End max_bet_ticket -->

                        <!-- Start total_min_odds -->
                        <div class="form-group row">
                            <label for="total_min_odds" class="col-md-4 col-form-label text-md-right">Sportsbook Total Min Odds per ticket : </label>

                            <div class="col-md-8">
                                <input id="total_min_odds" type="text" class="form-control {{ $errors->has('total_min_odds') ? ' is-invalid' : '' }}" name="total_min_odds" value="{{ old('total_min_odds') }}" required>
                                <p class="input-tips">EG: If this is set to 2.00, then a ticket will be validated if the total odds are over this value. We recommend this value to be minimum 2.00, to avoid players betting large amount of money on low events to clear their rollover requirements.</p>
                                @if ($errors->has('total_min_odds'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_min_odds') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End total_min_odds -->

                        <!-- Start total_max_ticket -->
                        <div class="form-group row">
                            <label for="total_max_ticket" class="col-md-4 col-form-label text-md-right">Sportsbook Total Max Odds per ticket : </label>

                            <div class="col-md-8">
                                <input id="total_max_ticket" type="text" class="form-control {{ $errors->has('total_max_ticket') ? ' is-invalid' : '' }}" name="total_max_ticket" value="{{ old('total_max_ticket') }}" required>
                                <p class="input-tips">EG: If this is set to 1000.00 then the total odds on a ticket will cap at the value of 10000.00. even if the total odds would theoretically exceed this value.</p>
                                @if ($errors->has('total_max_ticket'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_max_ticket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End total_max_ticket -->

                        <!-- Start max_event_ticket -->
                        <div class="form-group row">
                            <label for="max_event_ticket" class="col-md-4 col-form-label text-md-right">Sportsbook Max number of Events per ticket : </label>

                            <div class="col-md-8">
                                <input id="max_event_ticket" type="text" class="form-control {{ $errors->has('max_event_ticket') ? ' is-invalid' : '' }}" name="max_event_ticket" value="{{ old('max_event_ticket') }}" required>
                                @if ($errors->has('max_event_ticket'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_event_ticket') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End max_event_ticket -->

                        <!-- Start profit_margin -->
                        <div class="form-group row">
                            <label for="profit_margin" class="col-md-4 col-form-label text-md-right">Profit Margin : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="profit_margin" type="text" class="form-control {{ $errors->has('profit_margin') ? ' is-invalid' : '' }}" name="profit_margin" value="{{ old('profit_margin') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                <p>*It will lower every odd imported into the system by x%</p>
                                @if ($errors->has('profit_margin'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profit_margin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End profit_margin -->
                        
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
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