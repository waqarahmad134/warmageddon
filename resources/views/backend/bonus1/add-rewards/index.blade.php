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
                            <li class="breadcrumb-item active">Reward Code Add</li>
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
                    <h4>Add Reward Code</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start code -->
                        <div class="form-group row">
                            <label for="code" class="col-md-3 col-form-label text-md-right">Code : </label>

                            <div class="col-md-8">
                                <input id="code" type="text" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required>
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End code -->

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

                        <!-- Start expire_date -->
                        <div class="form-group row">
                            <label for="expire_date" class="col-md-3 col-form-label text-md-right">Expiry Date : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="expire_date" type="date" class="form-control datepicker {{ $errors->has('expire_date') ? ' is-invalid' : '' }}" name="expire_date" value="{{ old('expire_date') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">00:00:00</button>
                                    </span>
                                </div>
                                @if ($errors->has('expire_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expire_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End expire_date -->

                        <!-- Start type -->
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">Type : </label>
                            <div class="col-md-8">
                                <select id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                    <option>Credits</option>
                                    <option>Deposit</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End type -->

                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Unused</option>
                                    <option>Used</option>
                                </select>
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