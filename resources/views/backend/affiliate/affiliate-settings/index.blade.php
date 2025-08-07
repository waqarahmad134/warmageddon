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
                            <li class="breadcrumb-item active">Affiliate Settings</li>
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
                    <h4>Affiliate Settings</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="mrp_players" class="col-md-3 col-form-label text-md-right">MRP Players : </label>

                            <div class="col-md-8">
                                <input id="mrp_players" type="text" class="form-control {{ $errors->has('mrp_players') ? ' is-invalid' : '' }}" name="mrp_players" value="{{ old('mrp_players') }}" required autofocus>
                                <p class="input-tips">Minimum number of active players that the affiliate must have to be eligible for payment Active players are players that deposited a certain amount over a certain time .</p>
                                @if ($errors->has('mrp_players'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mrp_players') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mrp_month" class="col-md-3 col-form-label text-md-right">MRP Month : </label>

                            <div class="col-md-8">
                                <input id="mrp_month" type="text" class="form-control {{ $errors->has('mrp_month') ? ' is-invalid' : '' }}" name="mrp_month" value="{{ old('mrp_month') }}" required>
                                <p class="input-tips">How many from the last months are taken in consideration when deciding if a player was active.</p>
                                @if ($errors->has('mrp_month'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mrp_month') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mrp_deposit" class="col-md-3 col-form-label text-md-right">MRP Deposit : </label>

                            <div class="col-md-8">
                                <input id="mrp_deposit" type="text" class="form-control {{ $errors->has('mrp_deposit') ? ' is-invalid' : '' }}" name="mrp_deposit" value="{{ old('mrp_deposit') }}" required>
                                <p class="input-tips">Minimum total amount that each player must have deposited to be considered as active player.</p>
                                @if ($errors->has('mrp_deposit'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mrp_deposit') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="affiliate_revenue" class="col-md-3 col-form-label text-md-right">Affiliate Revenue : </label>

                            <div class="col-md-8">
                                <input id="affiliate_revenue" type="text" class="form-control {{ $errors->has('affiliate_revenue') ? ' is-invalid' : '' }}" name="affiliate_revenue" value="{{ old('affiliate_revenue') }}" required>
                                <p class="input-tips">The revenue that the affiliate will receive from (won-bet) of his referred players.</p>
                                @if ($errors->has('affiliate_revenue'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('affiliate_revenue') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="affiliate_player_bonus" class="col-md-3 col-form-label text-md-right">Affiliate Player Bonus : </label>

                            <div class="col-md-8">
                                <input id="affiliate_player_bonus" type="text" class="form-control {{ $errors->has('affiliate_player_bonus') ? ' is-invalid' : '' }}" name="affiliate_player_bonus" value="{{ old('affiliate_player_bonus') }}" required>
                                <p class="input-tips">The rollover limit of the above described bonus.</p>
                                @if ($errors->has('affiliate_player_bonus'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('affiliate_player_bonus') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="affiliate_player_bonus_rollover" class="col-md-3 col-form-label text-md-right">Affiliate Player Bonus Rollover : </label>

                            <div class="col-md-8">
                                <input id="affiliate_player_bonus_rollover" type="text" class="form-control {{ $errors->has('affiliate_player_bonus_rollover') ? ' is-invalid' : '' }}" name="affiliate_player_bonus_rollover" value="{{ old('affiliate_player_bonus_rollover') }}" required>
                                <p class="input-tips">The rollover limit of the above described bonus.</p>
                                @if ($errors->has('affiliate_player_bonus_rollover'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('affiliate_player_bonus_rollover') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">NCO : </label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="is_filterable" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Negative Carry Over</span>
                                </label>
                                <br>
                                <p class="input-tips">If this is disabled. the affiliate statistics will be reset at the start of each month.</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">High Roller Protection : </label>
                            <div class="col-sm-9">
                                <p style="color: #0361FF;">If you want to remove a high roller player from an affiliate account. simply edit the account of the high roller and delete his affiliate ID.</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-9">
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