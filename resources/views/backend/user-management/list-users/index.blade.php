@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>User Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">List Users</li>
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

                        <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">Username : </label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End username -->

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
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start date : </label>

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

                        <!-- Start owner -->
                        <div class="form-group row">
                            <label for="owner" class="col-md-3 col-form-label text-md-right">Owner : </label>

                            <div class="col-md-8">
                                <input id="owner" type="text" class="form-control {{ $errors->has('owner') ? ' is-invalid' : '' }}" name="owner" value="{{ old('owner') }}" required>
                                @if ($errors->has('owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End owner -->

                        <!-- Start search_tag -->
                        <div class="form-group row">
                            <label for="search_tag" class="col-md-3 col-form-label text-md-right">Search by tags : </label>

                            <div class="col-md-8">
                                <textarea id="search_tag" type="text" class="form-control {{ $errors->has('search_tag') ? ' is-invalid' : '' }}" name="search_tag">{{ old('search_tag') }}</textarea>
                                @if ($errors->has('search_tag'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_tag') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End search_tag -->

                        <!-- Start players_affiliate -->
                        <div class="form-group row">
                            <label for="players_affiliate" class="col-md-3 col-form-label text-md-right">Players under Affiliate : </label>

                            <div class="col-md-8">
                                <input id="players_affiliate" type="text" class="form-control {{ $errors->has('players_affiliate') ? ' is-invalid' : '' }}" name="players_affiliate" value="{{ old('players_affiliate') }}" required>
                                @if ($errors->has('players_affiliate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('players_affiliate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End players_affiliate -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign (?) : </label>
                            <div class="col-md-8">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>= (Equal to)</option>
                                    <option>single</option>
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
                                <div class="input-group">
                                    <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
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
                                    <option>Any status</option>
                                    <option>Single status</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

                        <!-- Start affiliated_players -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="affiliated_players" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Users with affiliated players</span>
                                </label>
                            </div>
                        </div>
                        <!-- End affiliated_players -->

                        <!-- Start show_logged_user -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="show_logged_user" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show only Logged in users</span>
                                </label>
                            </div>
                        </div>
                        <!-- End show_logged_user -->

                        <!-- Start users_identity_unve -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="users_identity_unve" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Users with identity not verified</span>
                                </label>
                            </div>
                        </div>
                        <!-- End users_identity_unve -->

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
                            <div class="col-sm-10 offset-sm-2">
                                <P class="input-tips">The search will show the earnings between the dates you will choose. If no data is selected for dates, then all earnings will be showed</P>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-secondary float-left mr-3">List duplicate registration IP</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">List duplicate login IP</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Transfer Funds to Agent from your Balance of 824,633,198.00</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start agent_username -->
                        <div class="form-group row">
                            <label for="agent_username" class="col-md-3 col-form-label text-md-right">Player Username : </label>
                            <div class="col-md-8">
                                <select id="agent_username" type="text" class="form-control {{ $errors->has('agent_username') ? ' is-invalid' : '' }}" name="agent_username" required>
                                    <option>admin</option>
                                    <option>member</option>
                                </select>
                                @if ($errors->has('agent_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End agent_username -->

                        <!-- Start amount_transfer -->
                        <div class="form-group row">
                            <label for="amount_transfer" class="col-md-3 col-form-label text-md-right">Amount to transfer : </label>

                            <div class="col-md-8">
                                <input id="amount_transfer" type="text" class="form-control {{ $errors->has('amount_transfer') ? ' is-invalid' : '' }}" name="amount_transfer" value="{{ old('amount_transfer') }}" required>
                                @if ($errors->has('amount_transfer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount_transfer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount_transfer -->

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

                        <!-- Start cash_out -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="cash_out" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">CASH OUT</span>
                                </label>
                            </div>
                        </div>
                        <!-- End cash_out -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Transfer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->

@endsection