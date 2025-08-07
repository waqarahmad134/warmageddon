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
                            <li class="breadcrumb-item active">Casino Payout Percentages</li>
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
                    <h4>Casino Payout Percentages</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start jackpot_increase_persent -->
                        <div class="form-group row">
                            <label for="jackpot_increase_persent" class="col-md-4 col-form-label text-md-right">Jackpot Increase Persent : </label>

                            <div class="col-md-7">
                                <input id="jackpot_increase_persent" type="text" class="form-control {{ $errors->has('jackpot_increase_persent') ? ' is-invalid' : '' }}" name="jackpot_increase_persent" value="{{ old('jackpot_increase_persent') }}" required>
                                <p class="input-tips">Cannot be edited after casino is live</p>
                                @if ($errors->has('jackpot_increase_persent'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jackpot_increase_persent') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End jackpot_increase_persent -->

                        <!-- Start jackpot_backup_persent -->
                        <div class="form-group row">
                            <label for="jackpot_backup_persent" class="col-md-4 col-form-label text-md-right">Jackpot Backup Persent : </label>

                            <div class="col-md-7">
                                <input id="jackpot_backup_persent" type="text" class="form-control {{ $errors->has('jackpot_backup_persent') ? ' is-invalid' : '' }}" name="jackpot_backup_persent" value="{{ old('jackpot_backup_persent') }}" required>
                                <p class="input-tips">Cannot be edited after casino is live</p>
                                @if ($errors->has('jackpot_backup_persent'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jackpot_backup_persent') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End jackpot_backup_persent -->

                        <!-- Start custom_jackpot_win -->
                        <div class="form-group row">
                            <label for="custom_jackpot_win" class="col-md-4 col-form-label text-md-right">Custom Jackpot WIN odds : </label>

                            <div class="col-md-7">
                                <input id="custom_jackpot_win" type="text" class="form-control {{ $errors->has('custom_jackpot_win') ? ' is-invalid' : '' }}" name="custom_jackpot_win" value="{{ old('custom_jackpot_win') }}" required>
                                <p class="input-tips">Current value = 10000</p>
                                <p class="input-tips">Pending value = 10000</p>
                                @if ($errors->has('custom_jackpot_win'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('custom_jackpot_win') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End custom_jackpot_win -->

                        <!-- Start progressive_limit -->
                        <div class="form-group row">
                            <label for="progressive_limit" class="col-md-4 col-form-label text-md-right">Progressive Jackpot Limit : </label>

                            <div class="col-md-7">
                                <input id="progressive_limit" type="text" class="form-control {{ $errors->has('progressive_limit') ? ' is-invalid' : '' }}" name="progressive_limit" value="{{ old('progressive_limit') }}" required>
                                @if ($errors->has('progressive_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('progressive_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End progressive_limit -->


                        <!-- Start player_to_player_money_transfer_fee -->
                        <div class="form-group row">
                            <label for="player_to_player_money_transfer_fee" class="col-md-4 col-form-label text-md-right">Player to player money transfer fee : </label>

                            <div class="col-md-7">
                                <input id="player_to_player_money_transfer_fee" type="text" class="form-control {{ $errors->has('player_to_player_money_transfer_fee') ? ' is-invalid' : '' }}" name="player_to_player_money_transfer_fee" value="{{ old('player_to_player_money_transfer_fee') }}" required>
                                @if ($errors->has('player_to_player_money_transfer_fee'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_to_player_money_transfer_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_to_player_money_transfer_fee -->

                        <!-- Start casino_profit -->
                        <div class="form-group row">
                            <label for="casino_profit" class="col-md-4 col-form-label text-md-right">Casino Profit based on all transactions : </label>

                            <div class="col-md-7">
                                <input id="casino_profit" type="text" class="form-control {{ $errors->has('casino_profit') ? ' is-invalid' : '' }}" name="casino_profit" value="{{ old('casino_profit') }}" required>
                                <br>
                                <button class="btn btn-warning">Profit details</button>
                                @if ($errors->has('casino_profit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('casino_profit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End casino_profit -->

                        <!-- Start rtp_payout_game -->
                        <div class="form-group row">
                            <label for="rtp_payout_game" class="col-md-4 col-form-label text-md-right">Average RTP/Payout of all games (maths) : </label>

                            <div class="col-md-7">
                                <input id="rtp_payout_game" type="text" class="form-control {{ $errors->has('rtp_payout_game') ? ' is-invalid' : '' }}" name="rtp_payout_game" value="{{ old('rtp_payout_game') }}" required>

                                @if ($errors->has('rtp_payout_game'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rtp_payout_game') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End rtp_payout_game -->

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