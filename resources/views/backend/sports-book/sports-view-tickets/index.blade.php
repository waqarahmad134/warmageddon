@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

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
                            <li class="breadcrumb-item active">View tickets</li>
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
                        <!-- Start ticket_id -->
                        <div class="form-group row">
                            <label for="ticket_id" class="col-md-3 col-form-label text-md-right">Ticket ID : </label>

                            <div class="col-md-8">
                                <input id="ticket_id" type="text" class="form-control {{ $errors->has('ticket_id') ? ' is-invalid' : '' }}" name="ticket_id" value="{{ old('ticket_id') }}" required>
                                @if ($errors->has('ticket_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ticket_id -->

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
                                <th>Ticket ID</th>
                                <th>Username</th>
                                <th>Events on ticket</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Stake(Bet)</th>
                                <th>Total odds</th>
                                <th>Won</th>
                                <th>Profit</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>cas_vqgl</td>
                                    <td>1 <br> <a href="#">(click to view)</a></td>
                                    <td>2015-01-01 00:00:00</td>
                                    <td>Ticket lost</td>
                                    <td>900.00$</td>
                                    <td>4.41</td>
                                    <td>0.00$</td>
                                    <td>-900.00$</td>
                                    <td style="min-width: 160px;">
                                        <a href="#" class="btn btn-danger mb-2" data-toggle="tooltip" data-placement="top" title="Remove Funds">Remove won funds</a>
                                        <a href="#" class="btn btn-danger mb-2" data-toggle="tooltip" data-placement="top" title="Fefund Bet">Refund bet and win</a>
                                        <a href="#" class="btn btn-danger mb-2" data-toggle="tooltip" data-placement="top" title="Evaluated">Not-evaluated</a>
                                        <br>
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
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
