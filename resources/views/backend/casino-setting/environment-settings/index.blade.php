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
                            <li class="breadcrumb-item active">Casino Environment Settings</li>
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
                    <h4>Casino Environment Settings</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start geoloc_countries -->
                        <div class="form-group row">
                            <label for="geoloc_countries" class="col-md-4 col-form-label text-md-right">geoloc_countries : </label>

                            <div class="col-md-8">
                                <input id="geoloc_countries" type="text" class="form-control {{ $errors->has('geoloc_countries') ? ' is-invalid' : '' }}" name="geoloc_countries" value="{{ old('geoloc_countries') }}" required>
                                <p class="input-tips">Vallue should contain a list of comma separate values, representing the filtered countries . Each country must be typed in A2 ISO format - two letter ISO country code.</p>
                                @if ($errors->has('geoloc_countries'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('geoloc_countries') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End geoloc_countries -->

                        <!-- Start filter_geoloc -->
                        <div class="form-group row">
                            <label for="filter_geoloc" class="col-md-4 col-form-label text-md-right">filter_geoloc : </label>

                            <div class="col-md-8">
                                <input id="filter_geoloc" type="text" class="form-control {{ $errors->has('filter_geoloc') ? ' is-invalid' : '' }}" name="filter_geoloc" value="{{ old('filter_geoloc') }}" required>
                                <p class="input-tips">Set to DENY or ALLOW or 0. to disable geolocation filter. If set to ALLOW, it will allow access only to players from countries on the list. If set to DENY, it will deny access only to players from countries on the list.</p>
                                @if ($errors->has('filter_geoloc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('filter_geoloc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End filter_geoloc -->

                        <!-- Start transfers_p2p -->
                        <div class="form-group row">
                            <label for="transfers_p2p" class="col-md-4 col-form-label text-md-right">transfers_p2p : </label>

                            <div class="col-md-8">
                                <input id="transfers_p2p" type="text" class="form-control {{ $errors->has('transfers_p2p') ? ' is-invalid' : '' }}" name="transfers_p2p" value="{{ old('transfers_p2p') }}" required>
                                <p class="input-tips">Set to 1 to enable player to player transfers. Set to 0. to disable this feature.</p>
                                @if ($errors->has('transfers_p2p'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transfers_p2p') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End transfers_p2p -->

                        <!-- Start encryption_key -->
                        <div class="form-group row">
                            <label for="encryption_key" class="col-md-4 col-form-label text-md-right">encryption_key : </label>

                            <div class="col-md-8">
                                <input id="encryption_key" type="text" class="form-control {{ $errors->has('encryption_key') ? ' is-invalid' : '' }}" name="encryption_key" value="{{ old('encryption_key') }}" required>
                                <p class="input-tips">unique encryption key which will be used to encrypt email tokens and email links</p>
                                @if ($errors->has('encryption_key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('encryption_key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End encryption_key -->


                        <!-- Start login_timeout -->
                        <div class="form-group row">
                            <label for="login_timeout" class="col-md-4 col-form-label text-md-right">login_timeout : </label>

                            <div class="col-md-8">
                                <input id="login_timeout" type="text" class="form-control {{ $errors->has('login_timeout') ? ' is-invalid' : '' }}" name="login_timeout" value="{{ old('login_timeout') }}" required>
                                <p class="input-tips">timeout of 'no user actibity' required to mark the session of the user as being inactive, measured in minutes</p>
                                @if ($errors->has('login_timeout'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login_timeout') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End login_timeout -->

                        <!-- Start track_login -->
                        <div class="form-group row">
                            <label for="track_login" class="col-md-4 col-form-label text-md-right">track_login : </label>

                            <div class="col-md-8">
                                <input id="track_login" type="text" class="form-control {{ $errors->has('track_login') ? ' is-invalid' : '' }}" name="track_login" value="{{ old('track_login') }}" required>
                                <p class="input-tips">if this is enabled, then each user login will be recorded and verified against multiaccount attempts</p>
                                @if ($errors->has('track_login'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('track_login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End track_login -->

                        <!-- Start track_geo -->
                        <div class="form-group row">
                            <label for="track_geo" class="col-md-4 col-form-label text-md-right">track_geo : </label>

                            <div class="col-md-8">
                                <input id="track_geo" type="text" class="form-control {{ $errors->has('track_geo') ? ' is-invalid' : '' }}" name="track_geo" value="{{ old('track_geo') }}" required>
                                <p class="input-tips">if this is enabled every IP will be verified using geoIP database to retrieve its CITY, COUNTRY, LONGITUTE and LATITUDE</p>
                                @if ($errors->has('track_geo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('track_geo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End track_geo -->

                        <!-- Start taxation -->
                        <div class="form-group row">
                            <label for="taxation" class="col-md-4 col-form-label text-md-right">taxation : </label>

                            <div class="col-md-8">
                                <input id="taxation" type="text" class="form-control {{ $errors->has('taxation') ? ' is-invalid' : '' }}" name="taxation" value="{{ old('taxation') }}" required>
                                <p class="input-tips">in some jurisdiction it is required that the casino deducts a tax amount from each player win. if the win exceeds a certain amount. If this is enabled, taxation will be applied and displayed in both backend and fronted.</p>
                                @if ($errors->has('taxation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('taxation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End taxation -->

                        <!-- Start tax_value -->
                        <div class="form-group row">
                            <label for="tax_value" class="col-md-4 col-form-label text-md-right">tax_value : </label>

                            <div class="col-md-8">
                                <input id="tax_value" type="text" class="form-control {{ $errors->has('tax_value') ? ' is-invalid' : '' }}" name="tax_value" value="{{ old('tax_value') }}" required>
                                <p class="input-tips">percentage from win value to be taxed, if it exceeds tax_win_limit</p>
                                @if ($errors->has('tax_value'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tax_value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End tax_value -->

                        <!-- Start tax_win_limit -->
                        <div class="form-group row">
                            <label for="tax_win_limit" class="col-md-4 col-form-label text-md-right">tax_win_limit : </label>

                            <div class="col-md-8">
                                <input id="tax_win_limit" type="text" class="form-control {{ $errors->has('tax_win_limit') ? ' is-invalid' : '' }}" name="tax_win_limit" value="{{ old('tax_win_limit') }}" required>
                                <p class="input-tips">limit after which a win is taxed</p>
                                @if ($errors->has('tax_win_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tax_win_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End tax_win_limit -->

                        <!-- Start globaljp -->
                        <div class="form-group row">
                            <label for="globaljp" class="col-md-4 col-form-label text-md-right">globaljp : </label>

                            <div class="col-md-8">
                                <input id="globaljp" type="text" class="form-control {{ $errors->has('globaljp') ? ' is-invalid' : '' }}" name="globaljp" value="{{ old('globaljp') }}" required>
                                <p class="input-tips">set this to 0 so that each game has its own jackpot pool; set it to 1. so that all games share same 1 jackpot pool through all games; set it to 2 so that all games use the custom jackpot pools based on group id.</p>
                                @if ($errors->has('globaljp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('globaljp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End globaljp -->

                        <!-- Start email_confirm -->
                        <div class="form-group row">
                            <label for="email_confirm" class="col-md-4 col-form-label text-md-right">email_confirm : </label>

                            <div class="col-md-8">
                                <input id="email_confirm" type="text" class="form-control {{ $errors->has('email_confirm') ? ' is-invalid' : '' }}" name="email_confirm" value="{{ old('email_confirm') }}" required>
                                <p class="input-tips">request email confirmation for each registered account</p>
                                @if ($errors->has('email_confirm'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End email_confirm -->

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