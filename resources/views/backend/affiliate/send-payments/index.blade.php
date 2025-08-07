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
                            <li class="breadcrumb-item active">Send Payments</li>
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
                    <h4>Send Payments</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start owner -->
                        <div class="form-group row">
                            <label for="owner" class="col-md-3 col-form-label text-md-right">Owner : </label>

                            <div class="col-md-8">
                                <input id="owner" type="text" class="form-control {{ $errors->has('owner') ? ' is-invalid' : '' }}" name="owner" value="{{ old('owner') }}" required>
                                @if ($errors->has('owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End owner -->

                        <!-- Start user_name -->
                        <div class="form-group row">
                            <label for="user_name" class="col-md-3 col-form-label text-md-right">User Name : </label>

                            <div class="col-md-8">
                                <input id="user_name" type="text" class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required>
                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- End user_name -->

                        <!-- Start user_email -->
                        <div class="form-group row">
                            <label for="user_email" class="col-md-3 col-form-label text-md-right">Email : </label>

                            <div class="col-md-8">
                                <input id="user_email" type="text" class="form-control {{ $errors->has('user_email') ? ' is-invalid' : '' }}" name="user_email" value="{{ old('user_email') }}" required>
                                @if ($errors->has('user_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End user_email -->


                        <!-- Start player_status -->
                        <div class="form-group row">
                            <label for="player_status" class="col-md-3 col-form-label text-md-right">Player Status: </label>

                            <div class="col-md-8">
                                <select id="player_status" type="text" class="form-control {{ $errors->has('player_status') ? ' is-invalid' : '' }}" name="player_status" required>
                                    <option>Active</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('player_status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_user_name -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YID</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <p class="input-tips">
                                    The search will show the earnings between the dates you will choose. If no data is selected for dates, then all earnings will be showed.
                                </p>
                                <i style="color: red;">USE (ASTERRISK) AS WILDACARD FOR SEARCH</i>
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
                    <h3>Active Affiliates</h3>
                    <p style="color: red;">NOTE: This page allows you to verify the revenue of each affiliate and decide wheter to pay them or not. By marking the checkbox for each affiliate and clicking on "Pay all affiliates marked above" from bottom right of this page. you agree to send to each affiliate the listed amount of credit with no-wagering requirement. The affiliates ca the decide to request a withdrawal or to gamble the credit received</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>User Name</th>
                                <th>Name/Email</th>
                                <th>Status</th>
                                <th>Duplicate account</th>
                                <th>Register Date</th>
                                <th class="hide">Last log in IP/Date</th>
                                <th class="hide">Current Balance</th>
                                <th class="hide">Affiliates No.</th>
                                <th class="hide">Active affiliates</th>
                                <th class="hide">Affiliates Revenue</th>
                                <th class="hide">All Payment Receive</th>
                                <th class="hide">Last Month Revenue</th>
                                <th class="hide">Last Payment dates</th>
                                <th>Remaining amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($aff_payment as $key => $item)
                                 
                                <tr>
                                    <td>10{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td style="color: green;">Enable</td>
                                    <td style="color: red;">Alert: Duplicate</td>
                                    <td>{{$item->user->created_at}}</td>
                                    <td class="hide">622.759.213.53 <br> 2/15/19 18:00:14</td>
                                    <td class="hide">1</td>
                                    <td class="hide">1/15</td>
                                    <td class="hide" style="color: green;">0.00$</td>
                                    <td class="hide" style="color: green;">1,000.00$</td>
                                    <td class="hide" style="color: green;">500.00$</td>
                                    <td class="hide" style="color: green;">00.00$</td>
                                    <td class="hide" style="color: red;">2/15/19 18:00:14</td>
                                    <td style="color: red;">00.00$</td>
                                    <td class="text-center">
                                        <a href="{{ route('send-payments.show', 1) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
                                    </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection