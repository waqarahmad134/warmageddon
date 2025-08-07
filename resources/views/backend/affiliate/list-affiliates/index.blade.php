@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>List Affiliates</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate Panel</a></li>
                            <li class="breadcrumb-item active">List Affiliates</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start user_id -->
                        <div class="form-group row">
                            <label for="user_id" class="col-md-3 col-form-label text-md-right">User ID : </label>

                            <div class="col-md-8">
                                <input id="user_id" type="text" class="form-control {{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ old('user_id') }}" required>
                                @if ($errors->has('user_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End user_id -->

                        <!-- Start user_name -->
                        <div class="form-group row">
                            <label for="user_name" class="col-md-3 col-form-label text-md-right">User Name : </label>

                            <div class="col-md-8">
                                <input id="user_name" type="text" class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required>
                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End user_name -->

                        <!-- Start email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email : </label>

                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End email -->

                        <!-- Start start_date -->
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start Date : </label>

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
                            <label for="end_date" class="col-md-3 col-form-label text-md-right">End Date : </label>

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

                        <!-- Start search_by_tag -->
                        <div class="form-group row">
                            <label for="search_by_tag" class="col-md-3 col-form-label text-md-right">Search By Tag : </label>

                            <div class="col-md-8">
                                <textarea name="search_by_tag" id="search_by_tag" cols="30" rows="5" class="form-control {{ $errors->has('search_by_tag') ? ' is-invalid' : '' }}" required>{{ old('search_by_tag') }}</textarea>
                                @if ($errors->has('search_by_tag'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('search_by_tag') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End search_by_tag -->

                        <!-- Start player_under_affiliate -->
                        <div class="form-group row">
                            <label for="player_under_affiliate" class="col-md-3 col-form-label text-md-right">Player Under Affiliate # : </label>

                            <div class="col-md-8">
                                <input id="player_under_affiliate" type="text" class="form-control {{ $errors->has('player_under_affiliate') ? ' is-invalid' : '' }}" name="player_under_affiliate" value="{{ old('player_under_affiliate') }}" required>
                                @if ($errors->has('player_under_affiliate'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('player_under_affiliate') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_under_affiliate -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign : </label>

                            <div class="col-md-8">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>= (Equal to)</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('comparisson_sign'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comparisson_sign') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End comparisson_sign -->

                        <!-- Start balance -->
                        <div class="form-group row">
                            <label for="balance" class="col-md-3 col-form-label text-md-right">Balance : </label>

                            <div class="col-md-8">
                                <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}" required>
                                @if ($errors->has('balance'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('balance') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End balance -->

                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Active</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

                        <!-- Start user_with_affiliated_players -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="user_with_affiliated_players" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Users with affiliated players</span>
                                </label>
                            </div>
                        </div>
                        <!-- End user_with_affiliated_players -->

                        <!-- Start show_loggedin_user -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="show_loggedin_user" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show only Logged in users</span>
                                </label>
                            </div>
                        </div>
                        <!-- End show_loggedin_user -->

                        <!-- Start users_with_identity_unverified -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="users_with_identity_unverified" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Users with identity not verified</span>
                                </label>
                            </div>
                        </div>
                        <!-- End users_with_identity_unverified -->

                        <!-- Start referral_domain -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="referral_domain" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Display referral domain</span>
                                </label>
                            </div>
                        </div>
                        <!-- End referral_domain -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3 p-0">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YID</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->

    <!-- FUNDS TRANSFER SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h3>Transfer Funds to User from your Balance of 824,633,198.00$</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start player_user_name -->
                        <div class="form-group row">
                            <label for="player_user_name" class="col-md-3 col-form-label text-md-right">Player User Name : </label>

                            <div class="col-md-8">
                                <select id="player_user_name" type="text" class="form-control {{ $errors->has('player_user_name') ? ' is-invalid' : '' }}" name="player_user_name" required>
                                    
                                    @foreach ($listaffiliate as $item)                                        
                                    <option>{{$item->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('player_user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_user_name -->

                        <!-- Start amount_to_transfer -->
                        <div class="form-group row">
                            <label for="amount_to_transfer" class="col-md-3 col-form-label text-md-right"> Amount to transfer : </label>

                            <div class="col-md-8">
                                <input id="amount_to_transfer" type="text" class="form-control {{ $errors->has('amount_to_transfer') ? ' is-invalid' : '' }}" name="amount_to_transfer" value="{{ old('amount_to_transfer') }}" required>
                                @if ($errors->has('amount_to_transfer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount_to_transfer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount_to_transfer -->

                        <!-- Start cash_in -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="cash_in" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">CASH IN</span>
                                </label>
                            </div>
                        </div>
                        <!-- End cash_in -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Transfer</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FUNDS TRANSFER SECTION START -->
@endsection
