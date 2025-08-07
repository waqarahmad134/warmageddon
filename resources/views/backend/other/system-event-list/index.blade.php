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
                            <li class="breadcrumb-item active">System events - List</li>
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

                        <!-- Start time_duration -->
                        <div class="form-group row">
                            <label for="time_duration" class="col-md-3 col-form-label text-md-right">Time Duration : </label>
                            <div class="col-md-8">
                                <select id="time_duration" type="text" class="form-control {{ $errors->has('time_duration') ? ' is-invalid' : '' }}" name="time_duration" required>
                                    <option>0 hours or more</option>
                                    <option>1 hours</option>
                                </select>
                                @if ($errors->has('time_duration'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('time_duration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End time_duration -->

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

                        <!-- Start staff_id -->
                        <div class="form-group row">
                            <label for="staff_id" class="col-md-3 col-form-label text-md-right">Staff ID : </label>

                            <div class="col-md-8">
                                <input id="staff_id" type="text" class="form-control {{ $errors->has('staff_id') ? ' is-invalid' : '' }}" name="staff_id" value="{{ old('staff_id') }}" required>
                                @if ($errors->has('staff_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('staff_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End staff_id -->

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
                    <h3>System events - List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Staff that recorded the event</th>
                                <th>Staff that marked event as ended</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Time Duration</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Type</th>
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