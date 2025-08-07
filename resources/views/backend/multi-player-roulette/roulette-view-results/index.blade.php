@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Player Roulette</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Roulette</a></li>
                            <li class="breadcrumb-item active">View Results</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!--  Section START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">

                        <!-- Start rooms -->
                        <div class="form-group row">
                            <label for="rooms" class="col-md-3 col-form-label text-md-right">Rooms : </label>
                            <div class="col-md-8">
                                <select id="rooms" type="text" class="form-control {{ $errors->has('rooms') ? ' is-invalid' : '' }}" name="rooms" required>
                                    <option>3.EU Roulette small bets 1min</option>
                                    <option>4.EU Roulette medium bets 5min</option>
                                    <option>5.EU Roulette large 10 mins</option>
                                    <option>6.AM Roulette default 1min</option>
                                    <option>7.AM Roulette Large bets 5min</option>
                                </select>
                                @if ($errors->has('rooms'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rooms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End rooms -->

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  Section End -->

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

                        <!-- Start spin_id -->
                        <div class="form-group row">
                            <label for="spin_id" class="col-md-3 col-form-label text-md-right">Spin ID : </label>

                            <div class="col-md-8">
                                <input id="spin_id" type="text" class="form-control {{ $errors->has('spin_id') ? ' is-invalid' : '' }}" name="spin_id" value="{{ old('spin_id') }}" required>
                                @if ($errors->has('spin_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('spin_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End spin_id -->

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

                        <!-- Start total_bet -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="total_bet" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">TOTAL BET > 0</span>
                                </label>
                            </div>
                        </div>
                        <!-- End total_bet -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
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
                    <h3>View Results - EU</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Spin ID</th>
                                <th>Room ID</th>
                                <th>Winning Drawn Number</th>
                                <th>Date</th>
                                <th>Total Bet</th>
                                <th>Total paid</th>
                                <th>Casino Profit per round</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 1; $x <= 80; $x++)
                                <tr>
                                    <td>50590</td>
                                    <td>33432</td>
                                    <td>3</td>
                                    <td>32</td>
                                    <td>2019-03-03 16:18:05</td>
                                    <td>0.00$</td>
                                    <td>0.00$</td>
                                    <td>0.00$</td>
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