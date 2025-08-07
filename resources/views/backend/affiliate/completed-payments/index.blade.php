@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Affiliate Panel</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate Panel</a></li>
                            <li class="breadcrumb-item active">Completed Payments</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Completed Payments</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="transaction_id" class="col-md-3 col-form-label text-md-right">Transaction ID : </label>

                            <div class="col-md-8">
                                <input id="transaction_id" type="text" class="form-control {{ $errors->has('transaction_id') ? ' is-invalid' : '' }}" name="transaction_id" value="{{ old('transaction_id') }}" required>
                                @if ($errors->has('transaction_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <!-- Start creadit_recive -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Cash In : </label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="creadit_recive_cash_in" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Credit received by admin</span>
                                </label>
                            </div>
                        </div>
                        <!-- End creadit_recive -->

                        <!-- Start creadit_recive_cash_out Oout -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Cash Out : </label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="creadit_recive_cash_out" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Credit Sent by admin</span>
                                </label>
                            </div>
                        </div>
                        <!-- End creadit_recive_cash_out -->

                        <!-- Start player_user_name -->
                        <div class="form-group row">
                            <label for="player_user_name" class="col-md-3 col-form-label text-md-right">Player User Name: </label>

                            <div class="col-md-8">
                                <select id="player_user_name" type="text" class="form-control {{ $errors->has('player_user_name') ? ' is-invalid' : '' }}" name="player_user_name" required>
                                    <option>Kamal hassan</option>
                                    <option>Demo user</option>
                                </select>
                                @if ($errors->has('player_user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_user_name -->

                        <!-- Start agent_user_name -->
                        <div class="form-group row">
                            <label for="agent_user_name" class="col-md-3 col-form-label text-md-right">Agent User Name: </label>

                            <div class="col-md-8">
                                <select id="agent_user_name" type="text" class="form-control {{ $errors->has('agent_user_name') ? ' is-invalid' : '' }}" name="agent_user_name" required>
                                    <option>Kamal hassan</option>
                                    <option>Demo user</option>
                                </select>
                                @if ($errors->has('agent_user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End agent_user_name -->


                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YID</button>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Sender</th>
                                <th>Reciver</th>
                                <th>Amount <br> (From staff perspective)</th>
                                <th>Transfer Tax <br> ((taxed to receiver))</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center">Managet</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>106</td>
                                    <td>Admin</td>
                                    <td>User Deleted</td>
                                    <td>- 50,000.000$</td>
                                    <td>0.000$ <br> (0%)</td>
                                    <td>2/15/19 18:00:14</td>
                                    <td>Completed</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
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