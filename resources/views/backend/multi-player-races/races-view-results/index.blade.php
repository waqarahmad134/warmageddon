@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('style')
    <style>
        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
            width: 120px;
            height: 115px;
            padding: 10px;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }
        .game-available label{
            width: 130px;
        }
    </style>
@endsection

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Player Races</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Races</a></li>
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
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">

                        <!-- Start games_available -->
                        <div class="form-group row">
                            <label for="games_available" class="col-md-3 col-form-label text-md-right" style="margin-top: 40px;">Games available : </label>

                            <div class="col-md-8 game-available">
                                <label>
                                    <input type="radio" name="test" value="small" checked>
                                    <img src="{{ asset('images/race-1.png') }}" alt="">
                                </label>

                                <label>
                                    <input type="radio" name="test" value="big">
                                    <img src="{{ asset('images/race-2.png') }}" alt="">
                                </label>

                                <label>
                                    <input type="radio" name="test" value="big">
                                    <img src="{{ asset('images/race-3.png') }}" alt="">
                                </label>

                                <label>
                                    <input type="radio" name="test" value="big">
                                    <img src="{{ asset('images/race-4.png') }}" alt="">
                                </label>
                            </div>
                        </div>
                        <!-- End games_available -->

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
                        <!-- Start race_id -->
                        <div class="form-group row">
                            <label for="race_id" class="col-md-3 col-form-label text-md-right">Race ID : </label>

                            <div class="col-md-8">
                                <input id="race_id" type="text" class="form-control {{ $errors->has('race_id') ? ' is-invalid' : '' }}" name="race_id" value="{{ old('race_id') }}" required>
                                @if ($errors->has('race_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('race_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End race_id -->

                        <!-- Start total_bet -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="total_bet" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">TOTAL BET</span>
                                </label>
                            </div>
                        </div>
                        <!-- End total_bet -->


                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search game</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset filters</button>
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
                    <h3>View all Results</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Race ID.</th>
                                <th>1st Place</th>
                                <th>2nd Place</th>
                                <th>3rd Place</th>
                                <th>Date</th>
                                <th>Total Jackpot Given</th>
                                <th>Ticket Jackpot Winner</th>
                                <th>Total bet</th>
                                <th>Total paid</th>
                                <th>Casino Profit per round</th>
                                <th>Bank before payout</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 1; $x <= 80; $x++)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>
                                        <img src="{{ asset('images/car1.png') }}" alt="" style="width: 80px;">
                                    </td>
                                    <td>
                                        <img src="{{ asset('images/car2.png') }}" alt="" style="width: 80px;">
                                    </td>
                                    <td>
                                        <img src="{{ asset('images/car3.png') }}" alt="" style="width: 80px;">
                                    </td>
                                    <td>2019-03-03 16:18:01</td>
                                    <td>0.00$</td>
                                    <td>NO</td>
                                    <td>0.00$</td>
                                    <td>0.00$</td>
                                    <td>0.00$</td>
                                    <td>N/A</td>
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