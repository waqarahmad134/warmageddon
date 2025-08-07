@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Bonuses And Codes</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses And Codes</a></li>
                            <li class="breadcrumb-item active">Free Chips Add</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Add FREE CHIPS CREDIT</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start user_name -->
                        <div class="form-group row">
                            <label for="user_name" class="col-md-3 col-form-label text-md-right">User name : </label>

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

                        <!-- Start bonus_amount -->
                        <div class="form-group row">
                            <label for="bonus_amount" class="col-md-3 col-form-label text-md-right">Bonus Amount : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="bonus_amount" type="text" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                @if ($errors->has('bonus_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_amount -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-warning float-left mr-3">Check duplicate account</button>
                            </div>
                        </div>

                        <!-- Start unlock_bonus_time -->
                        <div class="form-group row">
                            <label for="unlock_bonus_time" class="col-md-3 col-form-label text-md-right">Unlock bonus time : </label>

                            <div class="col-md-8">
                                <input id="unlock_bonus_time" type="text" class="form-control {{ $errors->has('unlock_bonus_time') ? ' is-invalid' : '' }}" name="unlock_bonus_time" value="{{ old('unlock_bonus_time') }}" required>
                                <p class="input-tips">How many times BONUS AMOUNT must be wagered, to unlock bonus in account or (depending on bonus mode)</p>
                                <i style="color: red;">Please note that until the user will clear his rollover limit he cannot withdraw his funds.</i>
                                @if ($errors->has('unlock_bonus_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('unlock_bonus_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End unlock_bonus_time -->

                        <!-- Start total_amount -->
                        <div class="form-group row">
                            <label for="total_amount" class="col-md-3 col-form-label text-md-right">Total amount to withdraw : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="total_amount" type="text" class="form-control {{ $errors->has('total_amount') ? ' is-invalid' : '' }}" name="total_amount" value="{{ old('total_amount') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                <p class="input-tips">Total amount that the player must wager to withdraw</p>
                                @if ($errors->has('total_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End total_amount -->

                        <!-- Start bonus_mode -->
                        <div class="form-group row">
                            <label for="bonus_mode" class="col-md-3 col-form-label text-md-right">Bonus Mode : </label>
                            <div class="col-md-8">
                                <select id="bonus_mode" type="text" class="form-control {{ $errors->has('bonus_mode') ? ' is-invalid' : '' }}" name="bonus_mode" required>
                                    <option>Istant</option>
                                    <option>Active</option>
                                </select>
                                @if ($errors->has('bonus_mode'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bonus_mode') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_mode -->

                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Active</option>
                                    <option>In Active</option>
                                </select>
                                <i style="color: red;">The user will be automatically notified via email about his reward! See email template "freechips" for details</i>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection