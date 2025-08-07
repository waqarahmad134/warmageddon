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
                    <p>Multi Player Bingo Live</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Bingo Live</a></li>
                            <li class="breadcrumb-item active">View all Results</li>
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

                        <!-- Start games_available -->
                        <div class="form-group row">
                            <label for="games_available" class="col-md-3 col-form-label text-md-right" style="margin-top: 40px;">Games available : </label>

                            <div class="col-md-8 game-available">
                                <label>
                                    <input type="radio" name="test" value="small" checked>
                                    <img src="{{ asset('images/bingo-70.png') }}" alt="">
                                </label>

                                <label>
                                    <input type="radio" name="test" value="big">
                                    <img src="{{ asset('images/bingo-90.png') }}" alt="">
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

                        <!-- Start draw_id -->
                        <div class="form-group row">
                            <label for="draw_id" class="col-md-3 col-form-label text-md-right">Draw ID : </label>

                            <div class="col-md-8">
                                <input id="draw_id" type="text" class="form-control {{ $errors->has('draw_id') ? ' is-invalid' : '' }}" name="draw_id" value="{{ old('draw_id') }}" required>
                                @if ($errors->has('draw_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('draw_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End draw_id -->

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
                    <h3>View all Results</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Draw ID.</th>
                                <th>Extracted numbers</th>
                                <th>Total balls extracted</th>
                                <th>Total Bets Amount</th>
                                <th>Total Wins Amount</th>
                                <th>Casino Profit per round</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 1; $x <= 80; $x++)
                                <tr>
                                    <td>121245</td>
                                    <td>
                                        34,24,54,87,45,21,54,55,77,29,54,34,24,54,87,45,21,54,55,77,29,54
                                        4,55,77,29,54,34,24,54,87,45,21,54,54,87,45,21,54,55,77,29,54
                                        ,87,45,21,54,55,77,29,54,34,24,54,87,45,21,5
                                    </td>
                                    <td>75</td>
                                    <td>0.00$</td>
                                    <td>0.00$</td>
                                    <td>0.00$</td>
                                    <td>2019-03-03 07:50:01</td>
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