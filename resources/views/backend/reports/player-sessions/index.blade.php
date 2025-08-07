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
                            <li class="breadcrumb-item active">Player Session Report</li>
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

                        <!-- Start session_id -->
                        <div class="form-group row">
                            <label for="session_id" class="col-md-3 col-form-label text-md-right">Session ID : </label>

                            <div class="col-md-8">
                                <input id="session_id" type="text" class="form-control {{ $errors->has('session_id') ? ' is-invalid' : '' }}" name="session_id" value="{{ old('session_id') }}" required>
                                @if ($errors->has('session_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('session_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End session_id -->

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

                        <!-- Start ip -->
                        <div class="form-group row">
                            <label for="ip" class="col-md-3 col-form-label text-md-right">IP : </label>

                            <div class="col-md-8">
                                <input id="ip" type="text" class="form-control {{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ old('ip') }}" required>
                                @if ($errors->has('ip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ip -->

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

                        <!-- Start device -->
                        <div class="form-group row">
                            <label for="device" class="col-md-3 col-form-label text-md-right">Device : </label>
                            <div class="col-md-8">
                                <select id="device" type="text" class="form-control {{ $errors->has('device') ? ' is-invalid' : '' }}" name="device" required>
                                    <option>All</option>
                                    <option>Single</option>
                                </select>
                                @if ($errors->has('device'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('device') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End device -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Player Session Report</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Player ID</th>
                                <th>Player name</th>
                                <th>Username</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>IP/Location</th>
                                <th>Wager Amount</th>
                                <th>Won</th>
                                <th>Promo credit received</th>
                                <th>Promo credit wagered</th>
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