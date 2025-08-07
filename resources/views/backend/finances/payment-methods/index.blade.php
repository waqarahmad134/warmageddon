@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('style')
@endsection

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
                            <li class="breadcrumb-item active">Payment Methods</li>
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
                    <h4 class="float-left">Payment Methods</h4>
                    <div class="float-right">
                        <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                    </div>
                </div>
                <div class="card-body">
                    <!-- Start card_number -->
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <label for="card_number" class="col-form-label">Card Number : </label>
                            <div class="input-group">
                                <input id="card_number" type="text" class="form-control {{ $errors->has('card_number') ? ' is-invalid' : '' }}" name="card_number" value="{{ old('card_number') }}" required>
                                <span class="input-group-append">
                                   <button class="btn btn-secondary" type="button"><i class="fa fa-credit-card"></i></button>
                               </span>
                            </div>
                            @if ($errors->has('card_number'))
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('card_number') }}</strong>
                               </span>
                            @endif
                        </div>
                    </div>
                    <!-- End card_number -->

                    <!-- Start expiration_date -->
                    <div class="form-group row">
                        <div class="col-md-4 offset-md-2">
                            <label for="expiration_date" class="col-form-label">Expiration Date : </label>

                            <input id="expiration_date" type="text" class="form-control {{ $errors->has('expiration_date') ? ' is-invalid' : '' }}" name="expiration_date" value="MM / YY" required>
                            @if ($errors->has('expiration_date'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expiration_date') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="expiration_date" class="col-form-label">CV Code : </label>

                            <input id="expiration_date" type="text" class="form-control {{ $errors->has('expiration_date') ? ' is-invalid' : '' }}" name="expiration_date" value="CVC" required>
                            @if ($errors->has('expiration_date'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expiration_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- End expiration_date -->

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="#" class="btn btn-primary">Submit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection