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
                            <li class="breadcrumb-item active">Financial Events</li>
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
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <!-- Start mega_win -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="mega_win" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Mega-Win</span>
                                </label>
                            </div>
                            <!-- End mega_win -->

                            <!-- End big_win -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="big_win" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Big-Win</span>
                                </label>
                            </div>
                            <!-- End big_win -->

                            <!-- End jackpot -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="jackpot" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">JackPot</span>
                                </label>
                            </div>
                            <!-- End jackpot -->
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <!-- Start lottery -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="lottery" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Lottery</span>
                                </label>
                            </div>
                            <!-- End lottery -->

                            <!-- End prizes -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="prizes" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Prizes</span>
                                </label>
                            </div>
                            <!-- End prizes -->

                            <!-- End deposit -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="deposit" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Deposit</span>
                                </label>
                            </div>
                            <!-- End deposit -->
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <!-- Start withdrawal -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="withdrawal" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Withdrawal</span>
                                </label>
                            </div>
                            <!-- End withdrawal -->

                            <!-- End transfers -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="transfers" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Transfers</span>
                                </label>
                            </div>
                            <!-- End transfers -->

                            <!-- End affiliate_payments -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="affiliate_payments" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Affiliate Payments</span>
                                </label>
                            </div>
                            <!-- End affiliate_payments -->
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <!-- Start tournaments -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="tournaments" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Tournaments</span>
                                </label>
                            </div>
                            <!-- End tournaments -->

                            <!-- End sportsbook -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="sportsbook" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Sportsbook</span>
                                </label>
                            </div>
                            <!-- End sportsbook -->

                            <!-- End support_tickets -->
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="support_tickets" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Support tickets</span>
                                </label>
                            </div>
                            <!-- End support_tickets -->
                        </div>

                        <!-- Start support_messages -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="support_messages" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Support messages</span>
                                </label>
                            </div>
                        </div>
                        <!-- End support_messages -->

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
                    <h3>Financial Events</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Event type</th>
                                <th>Time of event</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($f_event as $key => $item)
                                @if ($item->roles()->pluck('name')->implode(' ')=='User')
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>guest</td>
                                    <td>200.00$</td>
                                    <td>2015-11-19 08:28:02</td>
                                    <td>No deposit bonus code used</td>
                                    <td class="text-center" style="min-width: 210px;">
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
                                    </td>
                                </tr>
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