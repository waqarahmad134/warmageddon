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
                            <li class="breadcrumb-item active">Transfer Funds to Agent</li>
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
@endsection