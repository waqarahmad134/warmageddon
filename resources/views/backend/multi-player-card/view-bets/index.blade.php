@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Player Card</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Card</a></li>
                            <li class="breadcrumb-item active">View Bets</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start gameplay_code -->
                        <div class="form-group row">
                            <label for="gameplay_code" class="col-md-3 col-form-label text-md-right">Gameplay CODE : </label>

                            <div class="col-md-8">
                                <input id="gameplay_code" type="text" class="form-control {{ $errors->has('gameplay_code') ? ' is-invalid' : '' }}" name="gameplay_code" value="{{ old('gameplay_code') }}" required>
                                <p class="input-tips">encrypted gameplay</p>
                                @if ($errors->has('gameplay_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gameplay_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End gameplay_code -->

                        <!-- Start gameplay_id -->
                        <div class="form-group row">
                            <label for="gameplay_id" class="col-md-3 col-form-label text-md-right">Gameplay ID : </label>

                            <div class="col-md-8">
                                <input id="gameplay_id" type="text" class="form-control {{ $errors->has('gameplay_id') ? ' is-invalid' : '' }}" name="gameplay_id" value="{{ old('gameplay_id') }}" required>
                                <p class="input-tips">non-encrypted gameplay</p>
                                @if ($errors->has('gameplay_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gameplay_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End gameplay_id -->

                        <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">Username : </label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                                <p class="input-tips">Minimum number of active players that the affiliate must have to be eligible for payment Active players are players that deposited a certain amount over a certain time .</p>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End username -->

                        <!-- Start start_date -->
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start Date : </label>

                            <div class="col-md-8">
                                <input id="start_date" type="text" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required>
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
                                <input id="end_date" type="text" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End end_date -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign (?) : </label>
                            <div class="col-md-8">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>= (Equal to)</option>
                                </select>
                                @if ($errors->has('comparisson_sign'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comparisson_sign') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End comparisson_sign -->

                        <!-- Start bet_amount -->
                        <div class="form-group row">
                            <label for="bet_amount" class="col-md-3 col-form-label text-md-right">Bet Amount : </label>

                            <div class="col-md-8">
                                <input id="bet_amount" type="text" class="form-control {{ $errors->has('bet_amount') ? ' is-invalid' : '' }}" name="bet_amount" value="{{ old('bet_amount') }}" required>
                                @if ($errors->has('bet_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bet_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bet_amount -->

                        <!-- Start fun_mode -->
                        <div class="form-group row">
                            <label for="fun_mode" class="col-md-3 col-form-label text-md-right">Real/Fun Mode : </label>
                            <div class="col-md-8">
                                <select id="fun_mode" type="text" class="form-control {{ $errors->has('fun_mode') ? ' is-invalid' : '' }}" name="fun_mode" required>
                                    <option>Real+Fun</option>
                                </select>
                                @if ($errors->has('fun_mode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fun_mode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End fun_mode -->

                        <!-- Start game_name -->
                        <div class="form-group row">
                            <label for="game_name" class="col-md-3 col-form-label text-md-right">Game Name : </label>
                            <div class="col-md-8">
                                <select id="game_name" type="text" class="form-control {{ $errors->has('game_name') ? ' is-invalid' : '' }}" name="game_name" required>
                                    <option>English</option>
                                    <option>Bangla</option>
                                </select>
                                @if ($errors->has('game_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_name -->

                        <!-- Start exceeding_wins -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="exceeding_wins" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Exceeding wins (over 5000.0000$)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End exceeding_wins -->

                        <!-- Start play_tablet -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="play_tablet" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Played from Tablet/Smartphone</span>
                                </label>
                            </div>
                        </div>
                        <!-- End play_tablet -->

                        <!-- Start gamble_mode -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="gamble_mode" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Gamble Mode</span>
                                </label>
                            </div>
                        </div>
                        <!-- End gamble_mode -->

                        <!-- Start free_spins -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="free_spins" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Free Spins</span>
                                </label>
                            </div>
                        </div>
                        <!-- End free_spins -->

                        <!-- Start bonus_mode -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="bonus_mode" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Bonus Mode</span>
                                </label>
                            </div>
                        </div>
                        <!-- End bonus_mode -->

                        <!-- Start expired_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="expired_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Expired gameplays</span>
                                </label>
                            </div>
                        </div>
                        <!-- End expired_gameplays -->

                        <!-- Start winning_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="winning_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Winning gameplays (player win>0)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End winning_gameplays -->

                        <!-- Start refunded_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="refunded_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Refunded gameplays</span>
                                </label>
                            </div>
                        </div>
                        <!-- End refunded_gameplays -->

                        <!-- Start voided_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="voided_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Voided gameplays</span>
                                </label>
                            </div>
                        </div>
                        <!-- End voided_gameplays -->

                        <!-- Start incomplete_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="incomplete_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Incomplete gameplays</span>
                                </label>
                            </div>
                        </div>
                        <!-- End incomplete_gameplays -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Reset filters</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">MTD</button>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary float-left mr-3">YTD</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Clear all gameplay records !</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>View Bets List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>total ber amount</th>
                                <th>total won amount</th>
                                <th>Pending prizes</th>
                                <th>Payout/RTP</th>
                                <th>net profit</th>
                                <th>Tickets total</th>
                                <th>*Conversion rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>86.00$</td>
                                    <td>43.00$</td>
                                    <td>0.00$</td>
                                    <td>50%</td>
                                    <td>43.00$</td>
                                    <td>86</td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection