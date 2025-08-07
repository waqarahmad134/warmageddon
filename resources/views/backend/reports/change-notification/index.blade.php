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
                            <li class="breadcrumb-item active">Change Notification Report</li>
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
                    <!-- Start id_of_change -->
                        <div class="form-group row">
                            <label for="id_of_change" class="col-md-3 col-form-label text-md-right">ID of change : </label>

                            <div class="col-md-8">
                                <input id="id_of_change" type="text" class="form-control {{ $errors->has('id_of_change') ? ' is-invalid' : '' }}" name="id_of_change" value="{{ old('id_of_change') }}" required>
                                @if ($errors->has('id_of_change'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id_of_change') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End id_of_change -->

                        <!-- Start staff_id -->
                        <div class="form-group row">
                            <label for="staff_id" class="col-md-3 col-form-label text-md-right">Staff ID : </label>
                            <div class="col-md-8">
                                <select id="staff_id" type="text" class="form-control {{ $errors->has('staff_id') ? ' is-invalid' : '' }}" name="staff_id" required>
                                    <option>Click Search User name</option>
                                    <option>First User name</option>
                                </select>
                                @if ($errors->has('staff_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('staff_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End staff_id -->

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
                            <div class="col-sm-10 offset-md-2">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
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
    <!-- COUPONS SECTION START -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Change Notification Report</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID of staff who made the changes</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th>Date when changes took place</th>
                                <th>File from which the change was made</th>
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