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
                            <li class="breadcrumb-item"><a href="#">Other</a></li>
                            <li class="breadcrumb-item active">List Support Tickets</li>
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

                        <!-- Start priority -->
                        <div class="form-group row">
                            <label for="priority" class="col-md-3 col-form-label text-md-right">Priority : </label>
                            <div class="col-md-8">
                                <select id="priority" type="text" class="form-control {{ $errors->has('priority') ? ' is-invalid' : '' }}" name="priority" required>
                                    <option>Any priority</option>
                                    <option>Single priority</option>
                                </select>
                                @if ($errors->has('priority'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End priority -->

                        <!-- Start game_name -->
                        <div class="form-group row">
                            <label for="game_name" class="col-md-3 col-form-label text-md-right">Game Name : </label>
                            <div class="col-md-8">
                                <select id="game_name" type="text" class="form-control {{ $errors->has('game_name') ? ' is-invalid' : '' }}" name="game_name" required>
                                    <option>All games</option>
                                    <option>Single gmaes</option>
                                </select>
                                @if ($errors->has('game_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_name -->

                        <!-- Start unsolved_tickets -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="unsolved_tickets" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show only unsolved support tickets</span>
                                </label>
                            </div>
                        </div>
                        <!-- End unsolved_tickets -->

                        <!-- Start only_disputes -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="only_disputes" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show only disputes</span>
                                </label>
                            </div>
                        </div>
                        <!-- End only_disputes -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset filters</button>
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
                    <h3>List Support Tickets</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Opened by User</th>
                                <th>Game Name</th>
                                <th>Email</th>
                                <th>Date Started</th>
                                <th>Date Solved</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>IP</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)

                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection