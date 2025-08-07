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
                            <li class="breadcrumb-item active">List Lottery Tickets</li>
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
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start lotto_game -->
                        <div class="form-group row">
                            <label for="lotto_game" class="col-md-3 col-form-label text-md-right">Lotto game : </label>
                            <div class="col-md-8">
                                <select id="lotto_game" type="text" class="form-control {{ $errors->has('lotto_game') ? ' is-invalid' : '' }}" name="lotto_game" required>
                                    <option>All</option>
                                    <option>Number1</option>
                                </select>
                                @if ($errors->has('lotto_game'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lotto_game') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End lotto_game -->

                        <!-- Start round_id -->
                        <div class="form-group row">
                            <label for="round_id" class="col-md-3 col-form-label text-md-right">Round ID : </label>

                            <div class="col-md-8">
                                <input id="round_id" type="text" class="form-control {{ $errors->has('round_id') ? ' is-invalid' : '' }}" name="round_id" value="{{ old('round_id') }}" required>
                                @if ($errors->has('round_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('round_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End round_id -->

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


                        <!-- Start winning_tickets -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="winning_tickets" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Winning tickets</span>
                                </label>
                            </div>
                        </div>
                        <!-- End winning_tickets -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">This week</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>List Lottery Tickets</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Lottery</th>
                                <th>Round ID</th>
                                <th>Bet</th>
                                <th>Win</th>
                                <th>Profit</th>
                                <th>Date</th>
                                <th>Results</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>Raffle - Hourly (Lottery ID=#1)</td>
                                    <td>26</td>
                                    <td>50.00$</td>
                                    <td>25.00%</td>
                                    <td>-25.00%</td>
                                    <td>2019-02-04 22:00:06</td>
                                    <td>
                                        148
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
