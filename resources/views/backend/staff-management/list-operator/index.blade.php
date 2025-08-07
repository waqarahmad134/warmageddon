@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Staff Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Staff Management</a></li>
                            <li class="breadcrumb-item active">List Operator</li>
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
                    <h4>Transfer Funds to Agent from your Balance of 824,633,198.00</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start agent_username -->
                        <div class="form-group row">
                            <label for="agent_username" class="col-md-3 col-form-label text-md-right">Agent Username : </label>
                            <div class="col-md-8">
                                <select id="agent_username" type="text" class="form-control {{ $errors->has('agent_username') ? ' is-invalid' : '' }}" name="agent_username" required>
                                    <option>admin</option>
                                    <option>member</option>
                                </select>
                                @if ($errors->has('agent_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End agent_username -->

                        <!-- Start amount_transfer -->
                        <div class="form-group row">
                            <label for="amount_transfer" class="col-md-3 col-form-label text-md-right">Amount to transfer : </label>

                            <div class="col-md-8">
                                <input id="amount_transfer" type="text" class="form-control {{ $errors->has('amount_transfer') ? ' is-invalid' : '' }}" name="amount_transfer" value="{{ old('amount_transfer') }}" required>
                                @if ($errors->has('amount_transfer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount_transfer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount_transfer -->

                        <!-- Start cash_in -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="cash_in" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">CASH IN</span>
                                </label>
                            </div>
                        </div>
                        <!-- End cash_in -->

                        <!-- Start cash_out -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="cash_out" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">CASH OUT</span>
                                </label>
                            </div>
                        </div>
                        <!-- End cash_out -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Transfer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->


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

                        <!-- Start email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email : </label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End email -->

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

                        <!-- Start logged_in_staff -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="logged_in_staff" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show only logged in staff</span>
                                </label>
                            </div>
                        </div>
                        <!-- End logged_in_staff -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign (?) : </label>
                            <div class="col-md-8">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>=(Equal to)</option>
                                    <option>NO</option>
                                </select>
                                @if ($errors->has('comparisson_sign'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comparisson_sign') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End comparisson_sign -->

                        <!-- Start balance -->
                        <div class="form-group row">
                            <label for="balance" class="col-md-3 col-form-label text-md-right">Balance : </label>

                            <div class="col-md-8">
                                <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}" required>
                                @if ($errors->has('balance'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('balance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End balance -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <P class="input-tips">he search will show the earnings between the dates you will choose. If no data is selected for dates, then all earnings will be showed</P>
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
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>List Operator</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name/Email</th>
                                <th>Register Date</th>
                                <th>*Is logged in ?</th>
                                <th>Last log in IP/Date</th>
                                <th>Owner</th>
                                <th>Status</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($listOperator as $key => $item)
                                <tr>
                                    <td>10{{ $key+1 }}</td>
                                    <td>{{$item->user->profile->username}}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->user->logged_id?'yes':'No'}}</td>
                                    <td>
                                       {{$item->user->last_login_ip}}
                                        <br>
                                        {{$item->user->last_login_at}}
                                    </td>
                                    <td>try789</td>
                                    <td>{{$item->user->status == 1?'Enabled':'Disabled'}}</td>
                                    <td>{{$item->balance}}</td>
                                    <td style="min-width: 100px;">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
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
