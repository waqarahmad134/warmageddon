@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Reports</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item active">Gaming Performance Payout</li>
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
                    <!-- Start agent_username -->
                        <div class="form-group row">
                            <label for="agent_username" class="col-md-3 col-form-label text-md-right">Operator/Agent Username : </label>

                            <div class="col-md-8">
                                <input id="agent_username" type="text" class="form-control {{ $errors->has('agent_username') ? ' is-invalid' : '' }}" name="agent_username" value="{{ old('agent_username') }}" required>
                                @if ($errors->has('agent_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End agent_username -->

                        <!-- Start game_name -->
                        <div class="form-group row">
                            <label for="game_name" class="col-md-3 col-form-label text-md-right">Game Name : </label>

                            <div class="col-md-8">
                                <input id="game_name" type="text" class="form-control {{ $errors->has('game_name') ? ' is-invalid' : '' }}" name="game_name" value="{{ old('game_name') }}" required>
                                @if ($errors->has('game_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_name -->

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

                        <!-- Start exclude_jackpot_wins -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="exclude_jackpot_wins" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Exclude Jackpot Wins</span>
                                </label>
                            </div>
                        </div>
                        <!-- End exclude_jackpot_wins -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
                                <br>
                                <br>
                                <p class="input-tips">The search will show the earnings between the dates you will choose. If no data is selected fo rdates, then all earnings will be showed</p>
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
                    <h3>Gaming Performance Payout</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Game ID</th>
                                <th>Game Name</th>
                                <th>Total Real Gameplays</th>
                                <th>Average BET</th>
                                <th>Total Bet Amount</th>
                                <th>Total Win Amount</th>
                                <th>NET PROFIT</th>
                                <th>How often players win (HIT %)</th>
                                <th>Total minutes played</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                {{--<tr>--}}
                                {{--<td>{{ $x }}</td>--}}
                                {{--<td>68</td>--}}
                                {{--<td>46</td>--}}
                                {{--<td>2019-02-22 12:20:27</td>--}}
                                {{--<td>jostest</td>--}}
                                {{--<td>1.00$</td>--}}
                                {{--<td>PAID</td>--}}
                                {{--<td>12.00</td>--}}
                                {{--<td>Played</td>--}}
                                {{--<td>--}}
                                {{--<a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="View">Cancel</a>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
