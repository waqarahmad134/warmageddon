@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Finances</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Finances</a></li>
                            <li class="breadcrumb-item active">Credit Transfers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start transaction_id -->
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
                        <!-- End transaction_id -->

                        <!-- Start start_date -->
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start date : </label>

                            <div class="col-md-8">
                                <input id="start_date" type="date" class="form-control datepicker {{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required>
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
                                <input id="end_date" type="date" class="form-control datepicker {{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End end_date -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign : </label>

                            <div class="col-md-8">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>= (Equal to)</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('comparisson_sign'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comparisson_sign') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End comparisson_sign -->

                        <!-- Start amount -->
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">Amount : </label>

                            <div class="col-md-8">
                                <input id="amount" type="text" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount -->

                        <!-- Start player_username -->
                        <div class="form-group row">
                            <label for="player_username" class="col-md-3 col-form-label text-md-right">Player Username : </label>
                            <div class="col-md-8">
                                <select id="player_username" type="text" class="form-control {{ $errors->has('player_username') ? ' is-invalid' : '' }}" name="player_username" required>
                                    <option>Click to search user..</option>
                                    <option>Name 1</option>
                                </select>
                                @if ($errors->has('player_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_username -->

                        <!-- Start agent_username -->
                        <div class="form-group row">
                            <label for="agent_username" class="col-md-3 col-form-label text-md-right">Agent Username : </label>
                            <div class="col-md-8">
                                <select id="agent_username" type="text" class="form-control {{ $errors->has('agent_username') ? ' is-invalid' : '' }}" name="agent_username" required>
                                    <option>English</option>
                                    <option>Bangla</option>
                                </select>
                                @if ($errors->has('agent_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End agent_username -->

                        <!-- Start credit_received -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="credit_received" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Credit received by admin (CASH IN)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End credit_received -->

                        <!-- Start credit_sent -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="credit_sent" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Credit sent by admin (CASH OUT)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End credit_sent -->

                        <!-- Start payments_for_affiliates -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="payments_for_affiliates" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Payments towards affiliates</span>
                                </label>
                            </div>
                        </div>
                        <!-- End payments_for_affiliates -->

                        <!-- Start refunded_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="refunded_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Refunded gameplays</span>
                                </label>
                            </div>
                        </div>
                        <!-- End refunded_gameplays -->

                        <!-- Start exceeding_amount -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="exceeding_amount" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Exceeding amount (over 2500.0000$)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End exceeding_amount -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
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
                    <h3>USD Transfers</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Sender</th>
                                <th>Reciver</th>
                                <th>Amount <br> (from perspective of staff 'admin')</th>
                                <th>Transfer Tax <br> (Taxed to receiver)</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach ($credit as $key => $item) 
                           @if ($item->roles()->pluck('name')->implode(' ')=='User') 
                           @foreach ($item->bonus as $value)                             
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>admin</td>
                                    <td>{{$item->profile->username}}</td>
                                    <td>{{$value->add_bonus->b_amount}}$</td>
                                    <td>0.00$ (0%)</td>
                                    <td>{{$value->created_at}}</td>
                                    <td>Completed</td>
                                    <td>sb-cancel#47</td>
                                    <td class="text-center" style="min-width: 210px;">
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
                                    </td>
                                </tr>  
                                @endforeach  
                                @endif                        
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection