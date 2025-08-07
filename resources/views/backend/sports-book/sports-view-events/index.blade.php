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
                    <p>Sports Book</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sports Book</a></li>
                            <li class="breadcrumb-item active">List SportsBook soccer events</li>
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
                            <label for="games_available" class="col-md-3 col-form-label text-md-right" style="margin-top: 40px;">Sports available : </label>

                            <div class="col-md-8 game-available">
                                <label>
                                    <input type="radio" name="test" value="small" checked>
                                    <img src="{{ asset('images/football.png') }}" alt="">
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
                        <!-- Start event_id -->
                        <div class="form-group row">
                            <label for="event_id" class="col-md-3 col-form-label text-md-right">Event ID : </label>

                            <div class="col-md-8">
                                <input id="event_id" type="text" class="form-control {{ $errors->has('event_id') ? ' is-invalid' : '' }}" name="event_id" value="{{ old('event_id') }}" required>
                                @if ($errors->has('event_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('event_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End event_id -->

                        <!-- Start team_name -->
                        <div class="form-group row">
                            <label for="team_name" class="col-md-3 col-form-label text-md-right">Team Name : </label>

                            <div class="col-md-8">
                                <input id="team_name" type="text" class="form-control {{ $errors->has('team_name') ? ' is-invalid' : '' }}" name="team_name" value="{{ old('team_name') }}" required>
                                @if ($errors->has('team_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('team_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End team_name -->

                        <!-- Start country -->
                        <div class="form-group row">
                            <label for="country" class="col-md-3 col-form-label text-md-right">Country/League : </label>
                            <div class="col-md-8">
                                <select id="country" type="text" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" required>
                                    <option>All leagues</option>
                                    <option>first leagues</option>
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End country -->

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

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">YTD</button>
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
                    <h3>List SportsBook soccer events</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Event ID</th>
                                <th>Featured</th>
                                <th>Country/League</th>
                                <th>Home Team</th>
                                <th>Away Team</th>
                                <th>Score</th>
                                <th>Event Start/End Date</th>
                                <th>Odds 1</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>10{{ $x }}</td>
                                    <td>Group Stage</td>
                                    <td>Barcelona U19</td>
                                    <td>Bayer Leverkusen U19</td>
                                    <td>2015-01-01 00:00:00</td>
                                    <td>1.35</td>
                                    <td>4.41</td>
                                    <td>8.55</td>
                                    <td>Completed</td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This">Edit</a>
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
